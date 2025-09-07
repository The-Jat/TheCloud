<?php

namespace Botble\Cloudify\Storage;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Masbug\Flysystem\GoogleDriveAdapter;
use RuntimeException;

class GoogleDriveStorageAdapter
{
    protected Client $client;

    protected Drive $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(setting('media_google_drive_client_id'));
        $this->client->setClientSecret(setting('media_google_drive_client_secret'));
        $this->client->refreshToken(setting('media_google_drive_refresh_token'));

        $this->service = new Drive($this->client);
    }

    public function getAdapter(): GoogleDriveAdapter
    {
        $folderId = setting('media_google_drive_folder_id', 'root');

        $options = [
            'teamDriveSupport' => true,
            'useTrash' => true,
        ];

        return new GoogleDriveAdapter($this->service, $folderId, $options);
    }

    public function configureStorage(): void
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Google Drive is not properly configured.');
        }

        Storage::extend('google', function () {
            $adapter = $this->getAdapter();

            return new Filesystem($adapter);
        });
    }

    public function isConfigured(): bool
    {
        return setting('media_google_drive_client_id') &&
            setting('media_google_drive_client_secret') &&
            setting('media_google_drive_refresh_token');
    }
}
