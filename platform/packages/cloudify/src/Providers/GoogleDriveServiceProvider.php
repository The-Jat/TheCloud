<?php

namespace Botble\Cloudify\Providers;

use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Cloudify\Storage\GoogleDriveStorageAdapter;
use Botble\Media\Facades\RvMedia;
use Botble\Setting\Forms\MediaSettingForm;

class GoogleDriveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleDriveStorageAdapter::class);
    }

    public function boot(): void
    {
        if (setting('media_driver_google_drive', false)) {
            $this->app->make(GoogleDriveStorageAdapter::class)->configureStorage();
        }

        add_filter('core_media_drivers', function (array $drivers) {
            return [
                ...$drivers,
                'google_drive' => 'Google Drive',
            ];
        });

        add_filter('cms_media_settings_validation_rules', function (array $rules) {
            $rules['media_google_drive_client_id'] = ['nullable', 'string', 'required_if:media_driver,google_drive'];
            $rules['media_google_drive_client_secret'] = ['nullable', 'string', 'required_if:media_driver,google_drive'];
            $rules['media_google_drive_refresh_token'] = ['nullable', 'string', 'required_if:media_driver,google_drive'];

            return $rules;
        });

        MediaSettingForm::extend(function (MediaSettingForm $form) {
            $mediaDriver = RvMedia::getMediaDriver();

            $form
                ->addBefore(
                    'close_media_drivers',
                    'media_google_drive',
                    HtmlField::class,
                    HtmlFieldOption::make()
                    ->content('<fieldset class="form-fieldset" data-bb-collapse="true" data-bb-trigger="[name=media_driver]" data-bb-value="google_drive" style="display: ' . ($mediaDriver == 'google_drive' ? 'block' : 'none') . '">')
                )
                ->addBefore('close_media_drivers', 'media_google_drive_client_id', TextField::class, [
                    'label' => trans('packages/cloudify::cloudify.setting.google_drive.client_id'),
                    'value' => setting('media_google_drive_client_id'),
                    'attr' => [
                        'placeholder' => trans('packages/cloudify::cloudify.setting.google_drive.client_id_placeholder'),
                    ],
                ])
                ->addBefore('close_media_drivers', 'media_google_drive_client_secret', TextField::class, [
                    'label' => trans('packages/cloudify::cloudify.setting.google_drive.client_secret'),
                    'value' => setting('media_google_drive_client_secret'),
                    'attr' => [
                        'placeholder' => trans('packages/cloudify::cloudify.setting.google_drive.client_secret_placeholder'),
                    ],
                ])
                ->addBefore('close_media_drivers', 'media_google_drive_refresh_token', TextField::class, [
                    'label' => trans('packages/cloudify::cloudify.setting.google_drive.refresh_token'),
                    'value' => setting('media_google_drive_refresh_token'),
                    'attr' => [
                        'placeholder' => trans('packages/cloudify::cloudify.setting.google_drive.refresh_token_placeholder'),
                    ],
                ])
                ->addBefore('close_media_drivers', 'media_google_drive_folder_id', TextField::class, [
                    'label' => trans('packages/cloudify::cloudify.setting.google_drive.folder_id'),
                    'value' => setting('media_google_drive_folder_id', 'root'),
                    'attr' => [
                        'placeholder' => trans('packages/cloudify::cloudify.setting.google_drive.folder_id_placeholder'),
                    ],
                ])
                ->addBefore(
                    'close_media_drivers',
                    'media_google_drive_close',
                    HtmlField::class,
                    HtmlFieldOption::make()
                        ->content('</fieldset>')
                );
        });
    }
}
