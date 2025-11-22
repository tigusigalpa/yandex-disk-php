<?php

namespace Tigusigalpa\YandexDisk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getCapacity()
 * @method static array getMeta(string $path, array $params = [])
 * @method static array addMeta(string $path, array $customProperties)
 * @method static array getAllFiles(int $limit = 100, int $offset = 0)
 * @method static array getRecentUploads(int $limit = 10, int $offset = 0)
 * @method static array getRecentPublished(int $limit = 10, int $offset = 0)
 * @method static array createFolder(string $path)
 * @method static array uploadFile(string $localFilePath, string $remotePath, bool $overwrite = true)
 * @method static bool downloadFile(string $remotePath, string $localPath)
 * @method static array copy(string $fromPath, string $toPath, bool $overwrite = true)
 * @method static array move(string $fromPath, string $toPath, bool $overwrite = true)
 * @method static array delete(string $path, bool $permanently = true)
 * @method static array publish(string $path)
 * @method static array unpublish(string $path)
 * @method static array getPublicResourceMeta(string $publicKey, array $params = [])
 * @method static bool downloadPublicResource(string $publicKey, string $localPath, ?string $path = null)
 * @method static array savePublicResource(string $publicKey, ?string $name = null, ?string $path = null)
 * @method static array getAvailablePublicSettings()
 * @method static array changePublicSettings(string $path, array $settings)
 * @method static array uploadFromUrl(string $url, string $remotePath, bool $disableRedirects = false)
 * @method static array getOperationStatus(string $operationId)
 * @method static array getTrash(string $path = '/', int $limit = 20, int $offset = 0)
 * @method static array restoreFromTrash(string $path, ?string $name = null, bool $overwrite = false)
 * @method static array clearTrash(?string $path = null)
 *
 * @see \Tigusigalpa\YandexDisk\YandexDiskClient
 */
class YandexDisk extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'yandex-disk';
    }
}
