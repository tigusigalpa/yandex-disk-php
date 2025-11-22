<?php

namespace Tigusigalpa\YandexDisk;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Tigusigalpa\YandexDisk\Exceptions\YandexDiskException;

/**
 * Yandex Disk API Client
 *
 * A comprehensive PHP client for interacting with Yandex Disk API.
 * This class provides methods for file management, folder operations,
 * public resource handling, trash management, and organization admin features.
 *
 * @package Tigusigalpa\YandexDisk
 * @author  Tigusigalpa
 * @version 1.0.0
 * @link    https://yandex.ru/dev/disk-api/doc/ru/
 */
class YandexDiskClient
{
    private const API_BASE_URL = 'https://cloud-api.yandex.net/v1/disk';

    /**
     * HTTP client for making API requests
     */
    private GuzzleClient $client;

    /**
     * OAuth access token for Yandex Disk API authentication
     */
    private string $accessToken;

    /**
     * YandexDiskClient constructor.
     *
     * @param string $accessToken OAuth access token for Yandex Disk API
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->client = new GuzzleClient([
            'verify' => false,
            'timeout' => 30,
        ]);
    }

    /**
     * Generate OAuth authorization URL for Yandex Disk.
     *
     * @param string $clientID Client ID from Yandex OAuth application
     * @return string Complete authorization URL
     */
    public static function getAuthorizationUrl(string $clientID): string
    {
        return 'https://oauth.yandex.ru/authorize?'.http_build_query([
                'response_type' => 'token',
                'client_id' => $clientID,
            ]);
    }

    /**
     * Get user disk information
     *
     * @return array Disk capacity and usage information
     * @throws YandexDiskException If API request fails
     */
    public function getCapacity(): array
    {
        return $this->request('GET', '/');
    }

    /**
     * Make HTTP request to Yandex Disk API
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE, PATCH)
     * @param string $endpoint API endpoint path
     * @param array $options Request options (query, json, headers, etc.)
     * @return array API response data
     * @throws YandexDiskException If API request fails
     */
    private function request(string $method, string $endpoint, array $options = []): array
    {
        try {
            $url = self::API_BASE_URL.$endpoint;

            $options['headers'] = array_merge(
                $options['headers'] ?? [],
                [
                    'Authorization' => "OAuth {$this->accessToken}",
                    'Accept' => 'application/json',
                ]
            );

            $response = $this->client->request($method, $url, $options);
            $body = $response->getBody()->getContents();

            if (empty($body)) {
                return ['status' => $response->getStatusCode()];
            }

            return json_decode($body, true) ?? [];
        } catch (GuzzleException $e) {
            $statusCode = $e->getCode();
            $response = null;

            if ($e->hasResponse()) {
                $body = $e->getResponse()->getBody()->getContents();
                $response = json_decode($body, true);
            }

            throw new YandexDiskException(
                $e->getMessage(),
                $statusCode,
                $response
            );
        }
    }

    /**
     * Get metadata for a resource
     *
     * @param string $path Path to the resource (e.g., '/disk/folder/file.txt')
     * @param array $params Additional query parameters (limit, offset, sort, etc.)
     * @return array Resource metadata information
     * @throws YandexDiskException If resource not found or API request fails
     */
    public function getMeta(string $path, array $params = []): array
    {
        $queryParams = array_merge(['path' => $path], $params);
        return $this->request('GET', '/resources', ['query' => $queryParams]);
    }

    /**
     * Add custom metadata for a resource
     *
     * @param string $path Path to the resource (e.g., '/disk/folder/file.txt')
     * @param array $customProperties Custom properties to add to the resource
     * @return array Updated resource metadata
     * @throws YandexDiskException If resource not found or API request fails
     */
    public function addMeta(string $path, array $customProperties): array
    {
        return $this->request('PATCH', '/resources', [
            'json' => [
                'path' => $path,
                'custom_properties' => $customProperties,
            ],
        ]);
    }

    /**
     * Get list of all files on disk
     *
     * @param int $limit Maximum number of items to return (default: 100)
     * @param int $offset Number of items to skip (default: 0)
     * @return array List of all files with pagination info
     * @throws YandexDiskException If API request fails
     */
    public function getAllFiles(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/resources/files', [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }

    /**
     * Get list of recently uploaded files
     *
     * @param int $limit Maximum number of items to return (default: 10)
     * @param int $offset Number of items to skip (default: 0)
     * @return array List of recently uploaded files
     * @throws YandexDiskException If API request fails
     */
    public function getRecentUploads(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/resources/last-uploaded', [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }

    /**
     * Get list of recently published files
     *
     * @param int $limit Maximum number of items to return (default: 10)
     * @param int $offset Number of items to skip (default: 0)
     * @return array List of recently published files
     * @throws YandexDiskException If API request fails
     */
    public function getRecentPublished(int $limit = 10, int $offset = 0): array
    {
        return $this->request('GET', '/resources/public', [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }

    /**
     * Create a folder on Yandex Disk
     *
     * @param string $path Path for the new folder (e.g., '/disk/NewFolder')
     * @return array Created folder information
     * @throws YandexDiskException If folder creation fails or path is invalid
     */
    public function createFolder(string $path): array
    {
        return $this->request('PUT', '/resources', [
            'query' => ['path' => $path],
        ]);
    }

    /**
     * Upload a file to Yandex Disk
     *
     * @param string $localFilePath Path to the local file to upload
     * @param string $remotePath Destination path on Yandex Disk (e.g., '/disk/folder/file.txt')
     * @param bool $overwrite Whether to overwrite existing file (default: true)
     * @return array Upload result with status and success flag
     * @throws YandexDiskException If local file not found, upload fails, or API request fails
     */
    public function uploadFile(string $localFilePath, string $remotePath, bool $overwrite = true): array
    {
        if (!file_exists($localFilePath)) {
            throw new YandexDiskException("Local file not found: {$localFilePath}");
        }

        // Get upload URL
        $uploadUrlResponse = $this->request('GET', '/resources/upload', [
            'query' => [
                'path' => $remotePath,
                'overwrite' => $overwrite ? 'true' : 'false',
            ],
        ]);

        if (!isset($uploadUrlResponse['href'])) {
            throw new YandexDiskException("Failed to get upload URL");
        }

        // Upload file to the provided URL
        $fileContent = file_get_contents($localFilePath);
        if ($fileContent === false) {
            throw new YandexDiskException("Failed to read local file: {$localFilePath}");
        }

        try {
            $response = $this->client->request('PUT', $uploadUrlResponse['href'], [
                'body' => $fileContent,
                'headers' => [
                    'Authorization' => "OAuth {$this->accessToken}",
                ],
            ]);

            return [
                'status' => $response->getStatusCode(),
                'success' => $response->getStatusCode() === 201,
            ];
        } catch (GuzzleException $e) {
            throw new YandexDiskException("Upload failed: ".$e->getMessage(), $e->getCode());
        }
    }

    /**
     * Download a file from Yandex Disk
     *
     * @param string $remotePath Path to the file on Yandex Disk (e.g., '/disk/folder/file.txt')
     * @param string $localPath Local path where the file should be saved
     * @return bool True if download was successful, false otherwise
     * @throws YandexDiskException If file not found, download fails, or API request fails
     */
    public function downloadFile(string $remotePath, string $localPath): bool
    {
        $downloadUrlResponse = $this->request('GET', '/resources/download', [
            'query' => ['path' => $remotePath],
        ]);

        if (!isset($downloadUrlResponse['href'])) {
            throw new YandexDiskException("Failed to get download URL for: {$remotePath}");
        }

        try {
            $response = $this->client->request('GET', $downloadUrlResponse['href'], [
                'headers' => [
                    'Authorization' => "OAuth {$this->accessToken}",
                ],
            ]);

            $content = $response->getBody()->getContents();
            return file_put_contents($localPath, $content) !== false;
        } catch (GuzzleException $e) {
            throw new YandexDiskException("Download failed: ".$e->getMessage(), $e->getCode());
        }
    }

    /**
     * Copy a file or folder to a new location
     *
     * @param string $fromPath Source path (e.g., '/disk/source/file.txt')
     * @param string $toPath Destination path (e.g., '/disk/destination/file.txt')
     * @param bool $overwrite Whether to overwrite existing file/folder (default: true)
     * @return array Copy operation result
     * @throws YandexDiskException If source not found, destination invalid, or API request fails
     */
    public function copy(string $fromPath, string $toPath, bool $overwrite = true): array
    {
        return $this->request('POST', '/resources/copy', [
            'query' => [
                'from' => $fromPath,
                'path' => $toPath,
                'overwrite' => $overwrite ? 'true' : 'false',
            ],
        ]);
    }

    /**
     * Move a file or folder to a new location
     *
     * @param string $fromPath Source path (e.g., '/disk/source/file.txt')
     * @param string $toPath Destination path (e.g., '/disk/destination/file.txt')
     * @param bool $overwrite Whether to overwrite existing file/folder (default: true)
     * @return array Move operation result
     * @throws YandexDiskException If source not found, destination invalid, or API request fails
     */
    public function move(string $fromPath, string $toPath, bool $overwrite = true): array
    {
        return $this->request('POST', '/resources/move', [
            'query' => [
                'from' => $fromPath,
                'path' => $toPath,
                'overwrite' => $overwrite ? 'true' : 'false',
            ],
        ]);
    }

    /**
     * Delete a file or folder
     *
     * @param string $path Path to the resource to delete (e.g., '/disk/folder/file.txt')
     * @param bool $permanently Whether to permanently delete (true) or move to trash (false) (default: true)
     * @return array Delete operation result
     * @throws YandexDiskException If resource not found or API request fails
     */
    public function delete(string $path, bool $permanently = true): array
    {
        return $this->request('DELETE', '/resources', [
            'query' => [
                'path' => $path,
                'permanently' => $permanently ? 'true' : 'false',
            ],
        ]);
    }

    /**
     * Publish a resource (make it publicly accessible)
     *
     * @param string $path Path to the resource to publish (e.g., '/disk/folder/file.txt')
     * @return array Published resource information with public URL
     * @throws YandexDiskException If resource not found or API request fails
     */
    public function publish(string $path): array
    {
        return $this->request('PUT', '/resources/publish', [
            'query' => ['path' => $path],
        ]);
    }

    /**
     * Unpublish a resource (revoke public access)
     *
     * @param string $path Path to the resource to unpublish (e.g., '/disk/folder/file.txt')
     * @return array Unpublish operation result
     * @throws YandexDiskException If resource not found or API request fails
     */
    public function unpublish(string $path): array
    {
        return $this->request('PUT', '/resources/unpublish', [
            'query' => ['path' => $path],
        ]);
    }

    /**
     * Get metadata for a public resource
     *
     * @param string $publicKey Public key or URL of the resource
     * @param array $params Additional query parameters (path, offset, limit, etc.)
     * @return array Public resource metadata information
     * @throws YandexDiskException If public resource not found or API request fails
     */
    public function getPublicResourceMeta(string $publicKey, array $params = []): array
    {
        $queryParams = array_merge(['public_key' => $publicKey], $params);
        return $this->request('GET', '/public/resources', ['query' => $queryParams]);
    }

    /**
     * Download a public resource
     *
     * @param string $publicKey Public key or URL of the resource
     * @param string $localPath Local path where the file should be saved
     * @param string|null $path Optional path within the public resource (for folders)
     * @return bool True if download was successful, false otherwise
     * @throws YandexDiskException If public resource not found, download fails, or API request fails
     */
    public function downloadPublicResource(string $publicKey, string $localPath, ?string $path = null): bool
    {
        $queryParams = ['public_key' => $publicKey];
        if ($path) {
            $queryParams['path'] = $path;
        }

        $downloadUrlResponse = $this->request('GET', '/public/resources/download', [
            'query' => $queryParams,
        ]);

        if (!isset($downloadUrlResponse['href'])) {
            throw new YandexDiskException("Failed to get download URL for public resource");
        }

        try {
            $response = $this->client->request('GET', $downloadUrlResponse['href']);
            $content = $response->getBody()->getContents();
            return file_put_contents($localPath, $content) !== false;
        } catch (GuzzleException $e) {
            throw new YandexDiskException("Download failed: ".$e->getMessage(), $e->getCode());
        }
    }

    /**
     * Save a public resource to your Disk
     *
     * @param string $publicKey Public key or URL of the resource
     * @param string|null $name Optional custom name for the saved resource
     * @param string|null $path Optional destination path on your Disk
     * @return array Save operation result
     * @throws YandexDiskException If public resource not found or API request fails
     */
    public function savePublicResource(string $publicKey, ?string $name = null, ?string $path = null): array
    {
        $queryParams = ['public_key' => $publicKey];
        if ($name) {
            $queryParams['name'] = $name;
        }
        if ($path) {
            $queryParams['path'] = $path;
        }

        return $this->request('POST', '/public/resources/save', ['query' => $queryParams]);
    }

    /**
     * Get available public access settings
     *
     * @return array Available public access settings configuration
     * @throws YandexDiskException If API request fails
     */
    public function getAvailablePublicSettings(): array
    {
        return $this->request('GET', '/public/resources/public-settings/available');
    }

    /**
     * Get all public access settings for a resource
     *
     * @param string $path Path to the resource (e.g., '/disk/folder/file.txt')
     * @param bool $allowAddressAccess Whether to include address access information (default: false)
     * @return array Current public access settings for the resource
     * @throws YandexDiskException If resource not found or API request fails
     * @link https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-get
     */
    public function getPublicSettings(string $path, bool $allowAddressAccess = false): array
    {
        $queryParams = ['path' => $path];
        if ($allowAddressAccess) {
            $queryParams['allow_address_access'] = 'true';
        }

        return $this->request('GET', '/public/resources/public-settings', [
            'query' => $queryParams,
        ]);
    }

    /**
     * Change public access settings for a resource
     *
     * @param string $path Path to the resource (e.g., '/disk/folder/file.txt')
     * @param array $settings New public access settings configuration
     * @return array Updated public access settings
     * @throws YandexDiskException If resource not found, settings invalid, or API request fails
     * @link https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-change
     */
    public function changePublicSettings(string $path, array $settings): array
    {
        return $this->request('PUT', '/resources/public', [
            'query' => ['path' => $path],
            'json' => $settings,
        ]);
    }

    /**
     * Save a file from internet to Yandex Disk
     *
     * @param string $url URL of the file to download
     * @param string $remotePath Destination path on Yandex Disk (e.g., '/disk/folder/file.txt')
     * @param bool $disableRedirects Whether to disable HTTP redirects (default: false)
     * @return array Upload operation result with operation status
     * @throws YandexDiskException If URL is invalid, upload fails, or API request fails
     */
    public function uploadFromUrl(string $url, string $remotePath, bool $disableRedirects = false): array
    {
        $queryParams = [
            'url' => $url,
            'path' => $remotePath,
        ];

        if ($disableRedirects) {
            $queryParams['disable_redirects'] = 'true';
        }

        return $this->request('POST', '/resources/upload', ['query' => $queryParams]);
    }

    /**
     * Get status of an asynchronous operation
     *
     * @param string $operationId ID of the operation to check
     * @return array Operation status information
     * @throws YandexDiskException If operation not found or API request fails
     */
    public function getOperationStatus(string $operationId): array
    {
        return $this->request('GET', "/operations/{$operationId}");
    }

    /**
     * Get list of files in trash
     *
     * @param string $path Path in trash to list (default: '/')
     * @param int $limit Maximum number of items to return (default: 20)
     * @param int $offset Number of items to skip (default: 0)
     * @return array List of items in trash with pagination info
     * @throws YandexDiskException If API request fails
     */
    public function getTrash(string $path = '/', int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/trash/resources', [
            'query' => [
                'path' => $path,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }

    /**
     * Restore a resource from trash
     *
     * @param string $path Path to the resource in trash (e.g., 'trash:/file.txt')
     * @param string|null $name Optional new name for the restored resource
     * @param bool $overwrite Whether to overwrite existing resource (default: false)
     * @return array Restore operation result
     * @throws YandexDiskException If resource not found, restore fails, or API request fails
     */
    public function restoreFromTrash(string $path, ?string $name = null, bool $overwrite = false): array
    {
        $queryParams = ['path' => $path];

        if ($name) {
            $queryParams['name'] = $name;
        }
        if ($overwrite) {
            $queryParams['overwrite'] = 'true';
        }

        return $this->request('PUT', '/trash/resources/restore', ['query' => $queryParams]);
    }

    /**
     * Permanently delete a resource from trash
     *
     * @param string|null $path Specific path in trash to delete, or null for all trash (default: null)
     * @return array Clear trash operation result
     * @throws YandexDiskException If API request fails
     */
    public function clearTrash(?string $path = null): array
    {
        $options = [];
        if ($path) {
            $options['query'] = ['path' => $path];
        }

        return $this->request('DELETE', '/trash/resources', $options);
    }

    /**
     * Get public resources owned by user (Organization admin method)
     *
     * @param string $userId User ID whose public resources to retrieve
     * @param string $orgId Organization ID for admin context
     * @param int $limit Maximum number of items to return (default: 20)
     * @param int $offset Number of items to skip (default: 0)
     * @return array List of public resources owned by the user
     * @throws YandexDiskException If user not found, insufficient permissions, or API request fails
     * @link https://yandex.ru/dev/disk-api/doc/ru/reference/public-owned-by-user
     */
    public function getPublicResourcesOwnedByUser(string $userId, string $orgId, int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/public/resources/admin/public-resources', [
            'query' => [
                'user_id' => $userId,
                'org_id' => $orgId,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }

    /**
     * Get public resources accessible by user (Organization admin method)
     *
     * @param string $userId User ID whose accessible public resources to retrieve
     * @param string $orgId Organization ID for admin context
     * @param bool $includeGroupAccess Whether to include resources accessible via group membership (default: false)
     * @param int $limit Maximum number of items to return (default: 20)
     * @param string|null $iterationKey Optional iteration key for pagination
     * @return array List of public resources accessible by the user
     * @throws YandexDiskException If user not found, insufficient permissions, or API request fails
     * @link https://yandex.ru/dev/disk-api/doc/ru/reference/public-accessed-by-user
     */
    public function getPublicResourcesAccessedByUser(string $userId, string $orgId, bool $includeGroupAccess = false, int $limit = 20, ?string $iterationKey = null): array
    {
        $queryParams = [
            'user_id' => $userId,
            'org_id' => $orgId,
            'limit' => $limit,
        ];

        if ($includeGroupAccess) {
            $queryParams['include_group_access'] = 'true';
        }

        if ($iterationKey) {
            $queryParams['iteration_key'] = $iterationKey;
        }

        return $this->request('GET', '/public/resources/admin/accessible-resources', [
            'query' => $queryParams,
        ]);
    }

    /**
     * Unpublish user's public resource (Organization admin method)
     *
     * @param string $publicKey Public key of the resource to unpublish
     * @param string $userId User ID who owns the resource
     * @param string $orgId Organization ID for admin context
     * @return array Unpublish operation result
     * @throws YandexDiskException If resource not found, insufficient permissions, or API request fails
     * @link https://yandex.ru/dev/disk-api/doc/ru/reference/unpublish-admin-phash
     */
    public function unpublishUserResource(string $publicKey, string $userId, string $orgId): array
    {
        return $this->request('PUT', '/public/resources/admin/unpublish', [
            'query' => [
                'public_key' => $publicKey,
                'user_id' => $userId,
                'org_id' => $orgId,
            ],
        ]);
    }
}
