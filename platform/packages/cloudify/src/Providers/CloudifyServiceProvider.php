<?php

namespace Botble\Cloudify\Providers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Cloudify\Http\Middleware\RedirectToSettingIfCurrentPageIsSystem;
use Botble\Cloudify\PanelSections\CloudifyPanelSection;
use Botble\Dashboard\Events\RenderingDashboardWidgets;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Media\Facades\RvMedia;
use Botble\Media\Models\MediaFile;
use Botble\Media\Models\MediaFolder;
use Composer\Autoload\ClassLoader;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;

class CloudifyServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('packages/cloudify')
            ->loadMigrations()
            ->loadAndPublishConfigurations(['cloudify', 'permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes(['web', 'api'])
            ->registerPanelSections()
            ->loadAndPublishViews()
            ->registerDashboardWidgets();

        if ($mediaSizes = $this->app['config']->get('packages.cloudify.cloudify.media_sizes')) {
            $mediaSizes = explode(',', $mediaSizes);

            foreach ($mediaSizes as $key => $mediaSize) {
                $mediaSize = explode('x', $mediaSize);

                if (count($mediaSize) < 2) {
                    continue;
                }

                RvMedia::addSize('size_' . ($key + 1), $mediaSize[0], $mediaSize[1]);
            }
        }

        if ($mediaAllowedExtensions = $this->app['config']->get('packages.cloudify.cloudify.media_allowed_extensions')) {
            $this->app['config']->set('core.media.media.allowed_mime_types', $mediaAllowedExtensions);
        }

        $this->app['events']->listen(RouteMatched::class, function (): void {
            $this->app[Router::class]->pushMiddlewareToGroup('web', RedirectToSettingIfCurrentPageIsSystem::class);
        });

        $this->configRateLimiterForApi();

        DashboardMenu::beforeRetrieving(function (): void {
            DashboardMenu::removeItem('cms-core-system')
                ->removeItem('cms-core-tools');
        });

        $this->app->register(GoogleCloudStorageServiceProvider::class);
        $this->app->register(GoogleDriveServiceProvider::class);

        $plugins = $this->getPluginInfo();

        $loader = new ClassLoader();

        foreach ($plugins['namespaces'] as $key => $namespace) {
            $loader->setPsr4($namespace, platform_path('plugins/' . $key . '/src'));
        }

        $loader->register();

        foreach ($plugins['providers'] as $provider) {
            if (! class_exists($provider)) {
                continue;
            }

            $this->app->register($provider);
        }
    }

    protected function registerPanelSections(): static
    {
        PanelSectionManager::default()
            ->beforeRendering(function (): void {
                PanelSectionManager::register(CloudifyPanelSection::class);
            })
            ->moveGroup('system', 'settings');

        return $this;
    }

    protected function registerDashboardWidgets(): static
    {
        $this->app['events']->listen(RenderingDashboardWidgets::class, function (): void {
            add_filter(DASHBOARD_FILTER_ADMIN_LIST, function (array $widgets, Collection $widgetSettings) {
                return (new DashboardWidgetInstance())
                    ->setType('stats')
                    ->setPermission('media.index')
                    ->setTitle(trans('packages/cloudify::cloudify.widget.total_media_folders'))
                    ->setKey('widget-total-media-folders')
                    ->setIcon('ti ti-box')
                    ->setColor('info')
                    ->setStatsTotal(MediaFolder::query()->count())
                    ->setRoute(route('media.index'))
                    ->setColumn('col-12 col-md-6 col-lg-3')
                    ->setPriority(800)
                    ->init($widgets, $widgetSettings);
            }, 800, 2);

            add_filter(DASHBOARD_FILTER_ADMIN_LIST, function (array $widgets, Collection $widgetSettings) {
                return (new DashboardWidgetInstance())
                    ->setType('stats')
                    ->setPermission('media.index')
                    ->setTitle(trans('packages/cloudify::cloudify.widget.total_media_files'))
                    ->setKey('widget-total-media-files')
                    ->setIcon('ti ti-file')
                    ->setColor('info')
                    ->setStatsTotal(MediaFile::query()->count())
                    ->setRoute(route('media.index'))
                    ->setColumn('col-12 col-md-6 col-lg-3')
                    ->setPriority(800)
                    ->init($widgets, $widgetSettings);
            }, 820, 2);

            add_filter(DASHBOARD_FILTER_ADMIN_LIST, function (array $widgets, Collection $widgetSettings) {
                return (new DashboardWidgetInstance())
                    ->setType('stats')
                    ->setPermission('media.index')
                    ->setTitle(trans('packages/cloudify::cloudify.widget.total_media_sizes'))
                    ->setKey('widget-total-media-sizes')
                    ->setIcon('ti ti-file')
                    ->setColor('info')
                    ->setStatsTotal(BaseHelper::humanFilesize(MediaFile::query()->sum('size')))
                    ->setRoute(route('media.index'))
                    ->setColumn('col-12 col-md-6 col-lg-3')
                    ->setPriority(800)
                    ->init($widgets, $widgetSettings);
            }, 820, 2);
        });

        return $this;
    }

    protected function configRateLimiterForApi(): void
    {
        RateLimiter::for('cloudify-api', function (Request $request) {
            return Limit::perMinute(
                config('packages.cloudify.cloudify.rate_limit_per_minute', 300)
            )->by($request->user()?->id ?: $request->ip());
        });
    }

    protected function getPluginInfo(): array
    {
        $namespaces = [];

        $providers = [];

        $plugins = BaseHelper::scanFolder(platform_path('plugins'));

        foreach ($plugins as $plugin) {
            if (empty($plugin) || ! File::isDirectory(platform_path('plugins/' . $plugin))) {
                continue;
            }

            $configFilePath = platform_path('plugins/' . $plugin . '/plugin.json');

            if (! File::exists($configFilePath)) {
                continue;
            }

            $content = BaseHelper::getFileData($configFilePath);
            if (! empty($content)) {
                if (Arr::has($content, 'namespace')) {
                    $namespaces[$plugin] = $content['namespace'];
                }

                $providers[] = $content['provider'];
            }
        }

        return compact('namespaces', 'providers');
    }
}
