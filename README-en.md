# Yandex Disk PHP SDK

![Yandex Disk PHP SDK](https://i.ibb.co/Q3wQkhRW/yandex-disk-php-hero-banner.png)

[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Yandex Disk API](https://img.shields.io/badge/API-Yandex%20Disk%20API-orange.svg)](https://yandex.ru/dev/disk-api/doc/ru/)
[![Laravel](https://img.shields.io/badge/Laravel-Compatible-ff2d20.svg)](https://laravel.com)

**🌐 Language:** English | [Русский](README.md)

A comprehensive PHP SDK for integrating with [Yandex Disk API](https://yandex.ru/dev/disk-api/doc/ru/). This library
provides a clean, intuitive interface for managing files and folders on Yandex Disk with full coverage of the official
API.

## 📋 API Reference

| Method                               | Endpoint                                           | Documentation                                                                                       | Description                         |
|--------------------------------------|----------------------------------------------------|-----------------------------------------------------------------------------------------------------|-------------------------------------|
| `getAuthorizationUrl()`              | -                                                  | [OAuth Guide](https://yandex.ru/dev/disk-api/doc/ru/concepts/quickstart)                            | Generate OAuth authorization URL    |
| `getCapacity()`                      | `GET /`                                            | [Disk Info](https://yandex.ru/dev/disk-api/doc/ru/reference/capacity)                               | Get disk information                |
| `getMeta()`                          | `GET /resources`                                   | [Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/meta)                                    | Get resource metadata               |
| `addMeta()`                          | `PATCH /resources`                                 | [Add Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/meta-add)                            | Add custom metadata                 |
| `getAllFiles()`                      | `GET /resources/files`                             | [All Files](https://yandex.ru/dev/disk-api/doc/ru/reference/all-files)                              | Get flat list of all files          |
| `getRecentUploads()`                 | `GET /resources/last-uploaded`                     | [Recent Uploads](https://yandex.ru/dev/disk-api/doc/ru/reference/recent-upload)                     | Get recently uploaded files         |
| `getRecentPublished()`               | `GET /resources/public`                            | [Published Files](https://yandex.ru/dev/disk-api/doc/ru/reference/recent-public)                    | Get recently published files        |
| `createFolder()`                     | `PUT /resources`                                   | [Create Folder](https://yandex.ru/dev/disk-api/doc/ru/reference/create-folder)                      | Create folder                       |
| `uploadFile()`                       | `GET /resources/upload`                            | [Upload File](https://yandex.ru/dev/disk-api/doc/ru/reference/upload)                               | Upload file                         |
| `uploadFromUrl()`                    | `POST /resources/upload`                           | [Upload from URL](https://yandex.ru/dev/disk-api/doc/ru/reference/upload-ext)                       | Upload file from internet           |
| `downloadFile()`                     | `GET /resources/download`                          | [Download File](https://yandex.ru/dev/disk-api/doc/ru/reference/content)                            | Download file                       |
| `copy()`                             | `POST /resources/copy`                             | [Copy Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/copy)                               | Copy file/folder                    |
| `move()`                             | `POST /resources/move`                             | [Move Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/move)                               | Move file/folder                    |
| `delete()`                           | `DELETE /resources`                                | [Delete Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/delete)                           | Delete file/folder                  |
| `publish()`                          | `PUT /resources/publish`                           | [Publish Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/publish)                         | Publish resource                    |
| `unpublish()`                        | `PUT /resources/unpublish`                         | [Unpublish Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/unpublish)                     | Unpublish resource                  |
| `getAvailablePublicSettings()`       | `GET /public/resources/public-settings/available`  | [Available Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-get-available) | Get available public settings       |
| `getPublicSettings()`                | `GET /public/resources/public-settings`            | [Public Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-get)              | Get resource public settings        |
| `changePublicSettings()`             | `PUT /resources/public`                            | [Change Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-change)           | Change public settings              |
| `getPublicResourceMeta()`            | `GET /public/resources`                            | [Public Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/public)                           | Get public resource metadata        |
| `downloadPublicResource()`           | `GET /public/resources/download`                   | [Download Public](https://yandex.ru/dev/disk-api/doc/ru/reference/public)                           | Download public resource            |
| `savePublicResource()`               | `POST /public/resources/save`                      | [Save Public Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/public)                      | Save public resource                |
| `getTrash()`                         | `GET /trash/resources`                             | [Trash List](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-delete)                          | Get trash contents                  |
| `restoreFromTrash()`                 | `PUT /trash/resources/restore`                     | [Restore from Trash](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-restore)                 | Restore from trash                  |
| `clearTrash()`                       | `DELETE /trash/resources`                          | [Clear Trash](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-delete)                         | Clear trash                         |
| `getOperationStatus()`               | `GET /operations/{id}`                             | [Operation Status](https://yandex.ru/dev/disk-api/doc/ru/reference/operations)                      | Get operation status                |
| `getPublicResourcesOwnedByUser()`    | `GET /public/resources/admin/public-resources`     | [Owned Resources](https://yandex.ru/dev/disk-api/doc/ru/reference/public-owned-by-user)             | Admin: user's public resources      |
| `getPublicResourcesAccessedByUser()` | `GET /public/resources/admin/accessible-resources` | [Accessible Resources](https://yandex.ru/dev/disk-api/doc/ru/reference/public-accessed-by-user)     | Admin: resources accessible to user |
| `unpublishUserResource()`            | `PUT /public/resources/admin/unpublish`            | [Admin Unpublish](https://yandex.ru/dev/disk-api/doc/ru/reference/unpublish-admin-phash)            | Admin: unpublish user resource      |

## 🔐 Obtaining OAuth Token

To work with Yandex Disk API, you need to obtain an OAuth token. Follow these steps:

### 1. Create Application on Yandex OAuth

1. Log in to your Yandex account at Yandex OAuth: https://oauth.yandex.ru/
2. Click on the "+ Create" button
3. In the popup "What application do you want to create?", select "For API access or debugging" and click "Go to
   creation"
4. Fill in the form:
    - **Service Name**: Specify your application name
    - **Contact Email**: Your contact email
    - **Data Access**: Select necessary permissions:
        - `cloud_api:disk.write` — Write anywhere on Disk
        - `cloud_api:disk.read` — Read entire Disk
        - `cloud_api:disk.app_folder` — Access to application folder on Disk
        - `cloud_api:disk.info` — Access to Disk information

After creating the application, you will be shown:

- **ClientID** — needed for obtaining OAuth token
- **Client secret** — not needed for Yandex Disk operations

### 2. Generate Authorization URL

Use the `getAuthorizationUrl()` function to generate the authorization URL:

```php
use Tigusigalpa\YandexDisk\YandexDiskClient;

$clientId = 'your_client_id_from_app_settings';
$authUrl = YandexDiskClient::getAuthorizationUrl($clientId);

echo "Go to the following URL for authorization:\n";
echo $authUrl;
// Output: https://oauth.yandex.ru/authorize?response_type=token&client_id=<ClientID>
```

Or form the URL manually:

```
https://oauth.yandex.ru/authorize?response_type=token&client_id=<ClientID>
```

### 3. Get Token

1. Go to the generated URL
2. Log in to your Yandex account (if not already logged in)
3. Allow access for your application
4. After confirmation, you will be redirected to a page with the token in the URL
5. Copy the token from the page, something like `y0__xCD2tUFGKDjOyD2-Myl...`

### 4. Using the Token

Use the obtained token when creating the client:

```php
use Tigusigalpa\YandexDisk\YandexDiskClient;

$accessToken = 'your_oauth_token';
$client = new YandexDiskClient($accessToken);

// Now you can use all API methods
$diskInfo = $client->getCapacity();
```

## Usage Examples

### Disk Information

```php
// Get disk information
$diskInfo = $client->getCapacity();
echo "Used: " . $diskInfo['used'] . " bytes\n";
echo "Total: " . $diskInfo['total_space'] . " bytes\n";
echo "Free: " . ($diskInfo['total_space'] - $diskInfo['used']) . " bytes\n";
```

### Working with Resources

```php
use Tigusigalpa\YandexDisk\Models\{Resource, DiskInfo};

// Get disk information
$diskData = $client->getCapacity();
$diskInfo = DiskInfo::fromArray($diskData);

echo "Total: " . $diskInfo->getTotalSpace() . " bytes\n";
echo "Used: " . $diskInfo->getUsedSpace() . " bytes\n";
echo "Free: " . $diskInfo->getFreeSpace() . " bytes\n";
echo "Usage: " . $diskInfo->getUsagePercentage() . "%\n";
echo "Trash: " . $diskInfo->getTrashSize() . " bytes\n";
echo "Paid: " . ($diskInfo->isPaid() ? 'Yes' : 'No') . "\n";

// Get resource metadata
$meta = $client->getMeta('/disk/MyFile.txt');
$resource = Resource::fromArray($meta);

echo "Name: " . $resource->getName() . "\n";
echo "Type: " . $resource->getType() . "\n";        // 'file' or 'dir'
echo "Size: " . $resource->getSize() . " bytes\n";
echo "Created: " . $resource->getCreated() . "\n";
echo "Modified: " . $resource->getModified() . "\n";
echo "MIME type: " . $resource->getMimeType() . "\n";
echo "MD5: " . $resource->getMd5() . "\n";
echo "SHA256: " . $resource->getSha256() . "\n";
```

### File Operations

#### Upload File

```php
// Upload file
$result = $client->uploadFile(
    '/local/path/file.txt',
    '/disk/MyFolder/file.txt',
    true  // overwrite existing file
);

echo "Status: " . $result['status'] . "\n";  // 201 for success
echo "Success: " . ($result['success'] ? 'Yes' : 'No') . "\n";
```

#### Download File

```php
// Download file
$success = $client->downloadFile(
    '/disk/MyFile.txt',
    '/local/path/downloaded.txt'
);

echo $success ? "Download successful\n" : "Download failed\n";
```

#### Copy File

```php
// Copy file
$result = $client->copy(
    '/disk/original.txt',
    '/disk/copy.txt',
    true  // overwrite if exists
);

echo "Copied to: " . $result['path'] . "\n";
```

#### Move File

```php
// Move file
$result = $client->move(
    '/disk/old-location/file.txt',
    '/disk/new-location/file.txt',
    true  // overwrite if exists
);

echo "Moved to: " . $result['path'] . "\n";
```

#### Delete File

```php
// Delete file
$result = $client->delete(
    '/disk/file.txt',
    true  // permanent delete (false = move to trash)
);

echo "Deleted\n";
```

### Folder Operations

```php
// Create folder
$result = $client->createFolder('/disk/MyNewFolder');
echo "Folder created: " . $result['path'] . "\n";

// Create nested folder structure
$client->createFolder('/disk/Projects');
$client->createFolder('/disk/Projects/WebDev');
$client->createFolder('/disk/Projects/WebDev/Site1');
```

### Listing Files and Folders

```php
// Get all files on disk
$allFiles = $client->getAllFiles(limit: 100, offset: 0);
echo "Total files: " . $allFiles['total'] . "\n";

foreach ($allFiles['items'] as $file) {
    $resource = Resource::fromArray($file);
    echo "- " . $resource->getName() . " (" . $resource->getType() . ")\n";
}

// Get recently uploaded files
$recent = $client->getRecentUploads(limit: 10);
foreach ($recent['items'] as $file) {
    $resource = Resource::fromArray($file);
    echo "- " . $resource->getName() . "\n";
}

// List files in directory
$dirMeta = $client->getMeta('/disk/MyFolder');
$directory = Resource::fromArray($dirMeta);

if ($directory->isDir()) {
    foreach ($directory->getItems() as $item) {
        echo "- " . $item->getName() . " (" . $item->getSize() . " bytes)\n";
    }
    echo "Total items: " . $directory->getTotalItems() . "\n";
}
```

### Metadata Management

```php
// Add custom metadata
$result = $client->addMeta('/disk/file.txt', [
    'description' => 'My custom description',
    'author' => 'John Doe',
    'version' => '1.0.0'
]);

// Get resource metadata
$meta = $client->getMeta('/disk/file.txt');
$resource = ResourceResponse::fromArray($meta);

// Access custom properties
$customProps = $resource->toArray()['custom_properties'] ?? [];
```

### Public Access Management

#### Publish a Resource

```php
// Make a file public
$result = $client->publish('/disk/document.pdf');

echo "Public URL: " . $result['public_url'] . "\n";
// Output: https://yadi.sk/d/abc123...
```

#### Get Published Files

```php
// Get recently published files
$published = $client->getRecentPublished(limit: 10);

foreach ($published['items'] as $file) {
    $resource = Resource::fromArray($file);
    
    if ($resource->isPublished()) {
        echo "- " . $resource->getName() . "\n";
        echo "  URL: " . $resource->getPublicUrl() . "\n";
        echo "  Key: " . $resource->getPublicKey() . "\n";
    }
}
```

#### Unpublish a Resource

```php
// Revoke public access
$result = $client->unpublish('/disk/document.pdf');
```

#### Manage Public Settings

```php
// Get available public settings
$available = $client->getAvailablePublicSettings();
print_r($available);

// Get current public settings for a resource
$settings = $client->getPublicSettings('/disk/document.pdf');
print_r($settings);

// Change public settings
$client->changePublicSettings('/disk/document.pdf', [
    'access' => [
        'type' => 'public',
        'view' => true,
        'comment' => true,
        'edit' => false
    ]
]);
```

#### Work with Public Resources

```php
// Get public resource metadata
$publicMeta = $client->getPublicResourceMeta('https://yadi.sk/d/abc123...');
echo "Public file: " . $publicMeta['name'] . "\n";

// Download public resource
$client->downloadPublicResource('https://yadi.sk/d/abc123...', '/local/downloaded.pdf');

// Save public resource to your disk
$saveResult = $client->savePublicResource(
    'https://yadi.sk/d/abc123...',
    'saved-document.pdf',
    '/disk/downloads/'
);
```

### Trash Management

```php
// Get trash contents
$trash = $client->getTrash('/', 50, 0);
foreach ($trash['items'] as $item) {
    echo "- " . $item['name'] . " (deleted: " . $item['deleted'] . ")\n";
}

// Restore file from trash
$restoreResult = $client->restoreFromTrash('/disk/document.pdf');
echo "Restored: " . $restoreResult['name'] . "\n";

// Restore with new name
$client->restoreFromTrash('/disk/document.pdf', 'restored-document.pdf', false);

// Clear specific file from trash
$client->clearTrash('/disk/document.pdf');

// Clear entire trash
$client->clearTrash();
```

### Upload from URL

```php
// Upload file from internet URL
$uploadResult = $client->uploadFromUrl(
    'https://example.com/document.pdf',
    '/disk/downloads/document.pdf'
);

echo "Upload started\n";

// Check operation status if async
if (isset($uploadResult['href'])) {
    $operationId = basename($uploadResult['href']);
    $status = $client->getOperationStatus($operationId);
    
    echo "Status: " . $status['status'] . "\n";
    echo "Completed: " . ($status['status'] === 'success' ? 'Yes' : 'No') . "\n";
}

// Upload without redirects
$client->uploadFromUrl(
    'https://example.com/document.pdf',
    '/disk/downloads/document.pdf',
    true // disable redirects
);
```

### Organization Admin Methods

```php
// Get public resources owned by specific user
$ownedResources = $client->getPublicResourcesOwnedByUser(
    'user-uid-123',
    'org-id-456',
    20,
    0
);

foreach ($ownedResources['items'] as $resource) {
    echo "- " . $resource['name'] . " (" . $resource['public_url'] . ")\n";
}

// Get public resources accessible by user (including group access)
$accessibleResources = $client->getPublicResourcesAccessedByUser(
    'user-uid-123',
    'org-id-456',
    true, // include group access
    20
);

// Unpublish user's resource as admin
$client->unpublishUserResource(
    'public-key-789',
    'user-uid-123',
    'org-id-456'
);
```

## 🚀 Laravel Integration

### Installation

```bash
composer require tigusigalpa/yandex-disk-php
```

### Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Tigusigalpa\YandexDisk\YandexDiskServiceProvider"
```

Add to your `.env` file:

```env
YANDEX_DISK_ACCESS_TOKEN=your_oauth_token
```

### Usage

```php
use Tigusigalpa\YandexDisk\Facades\YandexDisk;

// Using facade
$diskInfo = YandexDisk::getCapacity();

// Using service container
$client = app('yandex-disk');
$client->uploadFile($localPath, $remotePath);
```

## 🔧 Error Handling

The SDK provides comprehensive error handling with custom exceptions:

```php
use Tigusigalpa\YandexDisk\Exceptions\YandexDiskException;

try {
    $client->uploadFile('/path/to/file.txt', '/disk/file.txt');
} catch (YandexDiskException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Error Code: " . $e->getErrorCode() . "\n";
    
    // Get full API response if available
    if ($e->getResponse()) {
        print_r($e->getResponse());
    }
}
```

## 📊 API Coverage

| Category         | Covered | Total | Percentage |
|------------------|---------|-------|------------|
| Disk Information | ✅ 1     | 1     | 100%       |
| File Operations  | ✅ 8     | 8     | 100%       |
| Public Resources | ✅ 8     | 8     | 100%       |
| Trash Management | ✅ 3     | 3     | 100%       |
| Metadata         | ✅ 2     | 2     | 100%       |
| Admin Methods    | ✅ 3     | 3     | 100%       |
| Operations       | ✅ 1     | 1     | 100%       |
| **Total**        | ✅ 26    | 26    | **100%**   |

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## 🔗 Links

- [Official Yandex Disk API Documentation](https://yandex.ru/dev/disk-api/doc/ru/)
- [OAuth Documentation](https://yandex.ru/dev/id/doc/ru/)
- [Packagist](https://packagist.org/packages/tigusigalpa/yandex-disk-php)
- [GitHub Repository](https://github.com/tigusigalpa/yandex-disk-php)

## 📞 Support

For issues, questions, or contributions:

- Create an issue on [GitHub](https://github.com/tigusigalpa/yandex-disk-php/issues)
- Check the [official documentation](https://yandex.ru/dev/disk-api/doc/ru/)
- Review the [troubleshooting guide](https://yandex.ru/dev/disk-api/doc/ru/concepts/troubleshooting)

---

**Made with ❤️ for the PHP community**

## Resources

- [Yandex Disk API Documentation](https://yandex.ru/dev/disk-api/doc/ru/)
- [Yandex OAuth](https://oauth.yandex.ru/)
- [API Reference](https://yandex.ru/dev/disk-api/doc/ru/reference/)
- [GitHub Repository](https://github.com/tigusigalpa/yandex-disk-php)
