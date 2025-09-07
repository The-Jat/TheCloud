<?php

use Botble\Base\Facades\AdminHelper;
use Botble\Cloudify\Http\Controllers\ApiKeyController;
use Botble\Cloudify\Http\Controllers\Settings\ApiSettingController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function (): void {
    Route::name('cloudify.')->group(function (): void {
        Route::group(['prefix' => 'cloudify/api-keys', 'as' => 'api-keys.'], function (): void {
            Route::resource('', ApiKeyController::class)->parameters(['' => 'key']);
        });

        Route::group(['prefix' => 'settings/cloudify', 'permission' => 'cloudify.api-settings.index'], function (): void {
            Route::get('api', [ApiSettingController::class, 'index'])->name('settings.api.index');
            Route::put('api', [ApiSettingController::class, 'update'])->name('settings.api.update');
        });
    });
});
