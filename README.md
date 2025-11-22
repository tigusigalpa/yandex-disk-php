# Yandex Disk PHP SDK

![Yandex Disk PHP SDK](https://github.com/user-attachments/assets/4d61aef4-2925-4eac-b863-63b7841fd8b3)

[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Yandex Disk API](https://img.shields.io/badge/API-Yandex%20Disk%20API-orange.svg)](https://yandex.ru/dev/disk-api/doc/ru/)
[![Laravel](https://img.shields.io/badge/Laravel-Compatible-ff2d20.svg)](https://laravel.com)

Комплексный PHP SDK для интеграции с [Yandex Disk API](https://yandex.ru/dev/disk-api/doc/ru/). Эта библиотека предоставляет чистый, интуитивный интерфейс для управления файлами и папками на Яндекс Диске с полным покрытием официального API.

## 📋 Справочник API

| Метод | Эндпоинт | Документация | Описание |
|--------|----------|---------------|-------------|
| `getAuthorizationUrl()` | - | [OAuth Guide](https://yandex.ru/dev/disk-api/doc/ru/concepts/quickstart) | Генерация URL авторизации OAuth |
| `getCapacity()` | `GET /` | [Disk Info](https://yandex.ru/dev/disk-api/doc/ru/reference/capacity) | Получение информации о диске |
| `getMeta()` | `GET /resources` | [Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/meta) | Получение метаданных ресурса |
| `addMeta()` | `PATCH /resources` | [Add Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/meta-add) | Добавление пользовательских метаданных |
| `getAllFiles()` | `GET /resources/files` | [All Files](https://yandex.ru/dev/disk-api/doc/ru/reference/all-files) | Получение плоского списка всех файлов |
| `getRecentUploads()` | `GET /resources/last-uploaded` | [Recent Uploads](https://yandex.ru/dev/disk-api/doc/ru/reference/recent-upload) | Получение недавно загруженных файлов |
| `getRecentPublished()` | `GET /resources/public` | [Published Files](https://yandex.ru/dev/disk-api/doc/ru/reference/recent-public) | Получение недавно опубликованных файлов |
| `createFolder()` | `PUT /resources` | [Create Folder](https://yandex.ru/dev/disk-api/doc/ru/reference/create-folder) | Создание папки |
| `uploadFile()` | `GET /resources/upload` | [Upload File](https://yandex.ru/dev/disk-api/doc/ru/reference/upload) | Загрузка файла |
| `uploadFromUrl()` | `POST /resources/upload` | [Upload from URL](https://yandex.ru/dev/disk-api/doc/ru/reference/upload-ext) | Загрузка файла из интернета |
| `downloadFile()` | `GET /resources/download` | [Download File](https://yandex.ru/dev/disk-api/doc/ru/reference/content) | Скачивание файла |
| `copy()` | `POST /resources/copy` | [Copy Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/copy) | Копирование файла/папки |
| `move()` | `POST /resources/move` | [Move Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/move) | Перемещение файла/папки |
| `delete()` | `DELETE /resources` | [Delete Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/delete) | Удаление файла/папки |
| `publish()` | `PUT /resources/publish` | [Publish Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/publish) | Публикация ресурса |
| `unpublish()` | `PUT /resources/unpublish` | [Unpublish Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/unpublish) | Отмена публикации ресурса |
| `getAvailablePublicSettings()` | `GET /public/resources/public-settings/available` | [Available Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-get-available) | Получение доступных публичных настроек |
| `getPublicSettings()` | `GET /public/resources/public-settings` | [Public Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-get) | Получение публичных настроек ресурса |
| `changePublicSettings()` | `PUT /resources/public` | [Change Settings](https://yandex.ru/dev/disk-api/doc/ru/reference/public-settings-change) | Изменение публичных настроек |
| `getPublicResourceMeta()` | `GET /public/resources` | [Public Metadata](https://yandex.ru/dev/disk-api/doc/ru/reference/public) | Получение метаданных публичного ресурса |
| `downloadPublicResource()` | `GET /public/resources/download` | [Download Public](https://yandex.ru/dev/disk-api/doc/ru/reference/public) | Скачивание публичного ресурса |
| `savePublicResource()` | `POST /public/resources/save` | [Save Public Resource](https://yandex.ru/dev/disk-api/doc/ru/reference/public) | Сохранение публичного ресурса |
| `getTrash()` | `GET /trash/resources` | [Trash List](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-delete) | Получение содержимого корзины |
| `restoreFromTrash()` | `PUT /trash/resources/restore` | [Restore from Trash](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-restore) | Восстановление из корзины |
| `clearTrash()` | `DELETE /trash/resources` | [Clear Trash](https://yandex.ru/dev/disk-api/doc/ru/reference/trash-delete) | Очистка корзины |
| `getOperationStatus()` | `GET /operations/{id}` | [Operation Status](https://yandex.ru/dev/disk-api/doc/ru/reference/operations) | Получение статуса операции |
| `getPublicResourcesOwnedByUser()` | `GET /public/resources/admin/public-resources` | [Owned Resources](https://yandex.ru/dev/disk-api/doc/ru/reference/public-owned-by-user) | Администратор: публичные ресурсы пользователя |
| `getPublicResourcesAccessedByUser()` | `GET /public/resources/admin/accessible-resources` | [Accessible Resources](https://yandex.ru/dev/disk-api/doc/ru/reference/public-accessed-by-user) | Администратор: доступные пользователю ресурсы |
| `unpublishUserResource()` | `PUT /public/resources/admin/unpublish` | [Admin Unpublish](https://yandex.ru/dev/disk-api/doc/ru/reference/unpublish-admin-phash) | Администратор: отмена публикации ресурса |

## 🔐 Получение OAuth-токена

Для работы с Yandex Disk API необходимо получить OAuth-токен. Следуйте этим шагам:

### 1. Создание приложения на Яндекс OAuth

1. Зайдите под своей учётной записью на Яндекс OAuth: https://oauth.yandex.ru/
2. Нажмите на кнопку "+ Создать"
3. Во всплывающем окне "Какое приложение хотите создать?" укажите "Для доступа к API или отладки" и нажмите "Перейти к созданию"
4. Заполните форму:
   - **Название сервиса**: Укажите название вашего приложения
   - **Почта для связи**: Ваш контактный email
   - **Доступ к данным**: Выберите необходимые права:
     - `cloud_api:disk.write` — Запись в любом месте на Диске
     - `cloud_api:disk.read` — Чтение всего Диска  
     - `cloud_api:disk.app_folder` — Доступ к папке приложения на Диске
     - `cloud_api:disk.info` — Доступ к информации о Диске

После создания приложения вам будут показаны:
- **ClientID** — понадобится для получения OAuth-токена
- **Client secret** — для работы с Яндекс Диском он не понадобится

### 2. Формирование ссылки авторизации

Используйте функцию `getAuthorizationUrl()` для генерации ссылки авторизации:

```php
use Tigusigalpa\YandexDisk\YandexDiskClient;

$clientId = 'ваш_client_id_из_настроек_приложения';
$authUrl = YandexDiskClient::getAuthorizationUrl($clientId);

echo "Перейдите по ссылке для авторизации:\n";
echo $authUrl;
// Вывод: https://oauth.yandex.ru/authorize?response_type=token&client_id=<ClientID>
```

Или сформируйте ссылку вручную:
```
https://oauth.yandex.ru/authorize?response_type=token&client_id=<ClientID>
```

### 3. Получение токена

1. Перейдите по сгенерированной ссылке
2. Авторизуйтесь в своём аккаунте Яндекса (если еще не авторизованы)
3. Разрешите доступ для вашего приложения
4. После подтверждения вы будете перенаправлены на страницу с токеном в URL
5. Скопируйте токен на странице, что-то вроде `y0__xCD2tUFGKDjOyD2-Myl...`

### 4. Использование токена

Полученный токен используйте при создании клиента:

```php
use Tigusigalpa\YandexDisk\YandexDiskClient;

$accessToken = 'ваш_oauth_токен';
$client = new YandexDiskClient($accessToken);

// Теперь можно использовать все методы API
$diskInfo = $client->getCapacity();
```

## Примеры использования

### Информация о диске

```php
// Получение информации о диске
$diskInfo = $client->getCapacity();
echo "Использовано: " . $diskInfo['used'] . " байт\n";
echo "Всего: " . $diskInfo['total_space'] . " байт\n";
echo "Свободно: " . ($diskInfo['total_space'] - $diskInfo['used']) . " байт\n";
```

### Работа с ресурсами

```php
use Tigusigalpa\YandexDisk\Models\{Resource, DiskInfo};

// Получение информации о диске
$diskData = $client->getCapacity();
$diskInfo = DiskInfo::fromArray($diskData);

echo "Всего: " . $diskInfo->getTotalSpace() . " байт\n";
echo "Использовано: " . $diskInfo->getUsedSpace() . " байт\n";
echo "Свободно: " . $diskInfo->getFreeSpace() . " байт\n";
echo "Использование: " . $diskInfo->getUsagePercentage() . "%\n";
echo "Корзина: " . $diskInfo->getTrashSize() . " байт\n";
echo "Платный: " . ($diskInfo->isPaid() ? 'Да' : 'Нет') . "\n";

// Получение метаданных ресурса
$meta = $client->getMeta('/disk/MyFile.txt');
$resource = Resource::fromArray($meta);

echo "Имя: " . $resource->getName() . "\n";
echo "Тип: " . $resource->getType() . "\n";        // 'file' или 'dir'
echo "Размер: " . $resource->getSize() . " байт\n";
echo "Создан: " . $resource->getCreated() . "\n";
echo "Изменён: " . $resource->getModified() . "\n";
echo "MIME тип: " . $resource->getMimeType() . "\n";
echo "MD5: " . $resource->getMd5() . "\n";
echo "SHA256: " . $resource->getSha256() . "\n";
```

### Операции с файлами

#### Загрузка файла

```php
// Загрузка файла
$result = $client->uploadFile(
    '/local/path/file.txt',
    '/disk/MyFolder/file.txt',
    true  // перезаписать существующий файл
);

echo "Статус: " . $result['status'] . "\n";  // 201 для успеха
echo "Успешно: " . ($result['success'] ? 'Да' : 'Нет') . "\n";
```

#### Скачивание файла

```php
// Скачивание файла
$success = $client->downloadFile(
    '/disk/MyFile.txt',
    '/local/path/downloaded.txt'
);

echo $success ? "Скачивание успешно\n" : "Скачивание не удалось\n";
```

#### Копирование файла

```php
// Копирование файла
$result = $client->copy(
    '/disk/original.txt',
    '/disk/copy.txt',
    true  // перезаписать, если существует
);

echo "Скопировано в: " . $result['path'] . "\n";
```

#### Перемещение файла

```php
// Перемещение файла
$result = $client->move(
    '/disk/old-location/file.txt',
    '/disk/new-location/file.txt',
    true  // перезаписать, если существует
);

echo "Перемещено в: " . $result['path'] . "\n";
```

#### Удаление файла

```php
// Удаление файла
$result = $client->delete(
    '/disk/file.txt',
    true  // окончательное удаление (false = в корзину)
);

echo "Удалено\n";
```

### Операции с папками

```php
// Создание папки
$result = $client->createFolder('/disk/MyNewFolder');
echo "Папка создана: " . $result['path'] . "\n";

// Создание вложенной структуры папок
$client->createFolder('/disk/Projects');
$client->createFolder('/disk/Projects/WebDev');
$client->createFolder('/disk/Projects/WebDev/Site1');
```

### Список файлов и папок

```php
// Получение всех файлов на диске
$allFiles = $client->getAllFiles(limit: 100, offset: 0);
echo "Всего файлов: " . $allFiles['total'] . "\n";

foreach ($allFiles['items'] as $file) {
    $resource = Resource::fromArray($file);
    echo "- " . $resource->getName() . " (" . $resource->getType() . ")\n";
}

// Получение недавно загруженных файлов
$recent = $client->getRecentUploads(limit: 10);
foreach ($recent['items'] as $file) {
    $resource = Resource::fromArray($file);
    echo "- " . $resource->getName() . "\n";
}

// Список файлов в директории
$dirMeta = $client->getMeta('/disk/MyFolder');
$directory = Resource::fromArray($dirMeta);

if ($directory->isDir()) {
    foreach ($directory->getItems() as $item) {
        echo "- " . $item->getName() . " (" . $item->getSize() . " байт)\n";
    }
    echo "Всего элементов: " . $directory->getTotalItems() . "\n";
}
```

### Управление метаданными

```php
// Добавление пользовательских метаданных
$result = $client->addMeta('/disk/file.txt', [
    'description' => 'Моё пользовательское описание',
    'author' => 'John Doe',
    'version' => '1.0.0'
]);

// Получение метаданных ресурса
$meta = $client->getMeta('/disk/file.txt');
$resource = ResourceResponse::fromArray($meta);

// Доступ к пользовательским свойствам
$customProps = $resource->toArray()['custom_properties'] ?? [];
```

### Управление публичным доступом

#### Публикация ресурса

```php
// Сделать файл публичным
$result = $client->publish('/disk/document.pdf');

echo "Публичный URL: " . $result['public_url'] . "\n";
// Вывод: https://yadi.sk/d/abc123...
```

#### Получение опубликованных файлов

```php
// Получение недавно опубликованных файлов
$published = $client->getRecentPublished(limit: 10);

foreach ($published['items'] as $file) {
    $resource = Resource::fromArray($file);
    
    if ($resource->isPublished()) {
        echo "- " . $resource->getName() . "\n";
        echo "  URL: " . $resource->getPublicUrl() . "\n";
        echo "  Ключ: " . $resource->getPublicKey() . "\n";
    }
}
```

#### Отмена публикации ресурса

```php
// Отозвать публичный доступ
$result = $client->unpublish('/disk/document.pdf');
```

#### Управление публичными настройками

```php
// Получение доступных публичных настроек
$available = $client->getAvailablePublicSettings();
print_r($available);

// Получение текущих публичных настроек ресурса
$settings = $client->getPublicSettings('/disk/document.pdf');
print_r($settings);

// Изменение публичных настроек
$client->changePublicSettings('/disk/document.pdf', [
    'access' => [
        'type' => 'public',
        'view' => true,
        'comment' => true,
        'edit' => false
    ]
]);
```

#### Работа с публичными ресурсами

```php
// Получение метаданных публичного ресурса
$publicMeta = $client->getPublicResourceMeta('https://yadi.sk/d/abc123...');
echo "Публичный файл: " . $publicMeta['name'] . "\n";

// Скачивание публичного ресурса
$client->downloadPublicResource('https://yadi.sk/d/abc123...', '/local/downloaded.pdf');

// Сохранение публичного ресурса на ваш диск
$saveResult = $client->savePublicResource(
    'https://yadi.sk/d/abc123...',
    'saved-document.pdf',
    '/disk/downloads/'
);
```

### Управление корзиной

```php
// Получение содержимого корзины
$trash = $client->getTrash('/', 50, 0);
foreach ($trash['items'] as $item) {
    echo "- " . $item['name'] . " (удалён: " . $item['deleted'] . ")\n";
}

// Восстановление файла из корзины
$restoreResult = $client->restoreFromTrash('/disk/document.pdf');
echo "Восстановлено: " . $restoreResult['name'] . "\n";

// Восстановление с новым именем
$client->restoreFromTrash('/disk/document.pdf', 'restored-document.pdf', false);

// Удаление конкретного файла из корзины
$client->clearTrash('/disk/document.pdf');

// Очистка всей корзины
$client->clearTrash();
```

### Загрузка из URL

```php
// Загрузка файла из интернет-URL
$uploadResult = $client->uploadFromUrl(
    'https://example.com/document.pdf',
    '/disk/downloads/document.pdf'
);

echo "Загрузка начата\n";

// Проверка статуса операции, если асинхронная
if (isset($uploadResult['href'])) {
    $operationId = basename($uploadResult['href']);
    $status = $client->getOperationStatus($operationId);
    
    echo "Статус: " . $status['status'] . "\n";
    echo "Завершено: " . ($status['status'] === 'success' ? 'Да' : 'Нет') . "\n";
}

// Загрузка без перенаправлений
$client->uploadFromUrl(
    'https://example.com/document.pdf',
    '/disk/downloads/document.pdf',
    true // отключить перенаправления
);
```

### Методы администратора организации

```php
// Получение публичных ресурсов, принадлежащих конкретному пользователю
$ownedResources = $client->getPublicResourcesOwnedByUser(
    'user-uid-123',
    'org-id-456',
    20,
    0
);

foreach ($ownedResources['items'] as $resource) {
    echo "- " . $resource['name'] . " (" . $resource['public_url'] . ")\n";
}

// Получение публичных ресурсов, доступных пользователю (включая групповой доступ)
$accessibleResources = $client->getPublicResourcesAccessedByUser(
    'user-uid-123',
    'org-id-456',
    true, // включить групповой доступ
    20
);

// Отмена публикации ресурса пользователя как администратор
$client->unpublishUserResource(
    'public-key-789',
    'user-uid-123',
    'org-id-456'
);
```

## 🚀 Интеграция с Laravel

### Установка

```bash
composer require tigusigalpa/yandex-disk-php
```

### Конфигурация

Опубликуйте конфигурационный файл:

```bash
php artisan vendor:publish --provider="Tigusigalpa\YandexDisk\YandexDiskServiceProvider"
```

Добавьте в ваш файл `.env`:

```env
YANDEX_DISK_ACCESS_TOKEN=ваш_oauth_токен
```

### Использование

```php
use Tigusigalpa\YandexDisk\Facades\YandexDisk;

// Использование фасада
$diskInfo = YandexDisk::getCapacity();

// Использование сервис-контейнера
$client = app('yandex-disk');
$client->uploadFile($localPath, $remotePath);
```

## 🔧 Обработка ошибок

SDK предоставляет комплексную обработку ошибок с пользовательскими исключениями:

```php
use Tigusigalpa\YandexDisk\Exceptions\YandexDiskException;

try {
    $client->uploadFile('/path/to/file.txt', '/disk/file.txt');
} catch (YandexDiskException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
    echo "Код ошибки: " . $e->getErrorCode() . "\n";
    
    // Получить полный ответ API, если доступен
    if ($e->getResponse()) {
        print_r($e->getResponse());
    }
}
```

## 📊 Покрытие API

| Категория | Реализовано | Всего | Процент |
|-----------|-------------|-------|---------|
| Информация о диске | ✅ 1 | 1 | 100% |
| Операции с файлами | ✅ 8 | 8 | 100% |
| Публичные ресурсы | ✅ 8 | 8 | 100% |
| Управление корзиной | ✅ 3 | 3 | 100% |
| Метаданные | ✅ 2 | 2 | 100% |
| Методы администратора | ✅ 3 | 3 | 100% |
| Операции | ✅ 1 | 1 | 100% |
| **Всего** | ✅ 26 | 26 | **100%** |

## 🤝 Участие в разработке

Вклады приветствуются! Не стесняйтесь отправлять Pull Request.

## 📄 Лицензия

Этот пакет лицензирован под MIT License. Подробности смотрите в файле [LICENSE](LICENSE).

## 🔗 Ссылки

- [Официальная документация Yandex Disk API](https://yandex.ru/dev/disk-api/doc/ru/)
- [Документация OAuth](https://yandex.ru/dev/id/doc/ru/)
- [Packagist](https://packagist.org/packages/tigusigalpa/yandex-disk-php)
- [Репозиторий GitHub](https://github.com/tigusigalpa/yandex-disk-php)

## 📞 Поддержка

Для проблем, вопросов или вкладов:
- Создайте issue на [GitHub](https://github.com/tigusigalpa/yandex-disk-php/issues)
- Проверьте [официальную документацию](https://yandex.ru/dev/disk-api/doc/ru/)
- Ознакомьтесь с [руководством по устранению неполадок](https://yandex.ru/dev/disk-api/doc/ru/concepts/troubleshooting)

---

**Сделано с ❤️ для PHP сообщества**

## Ресурсы

- [Документация Yandex Disk API](https://yandex.ru/dev/disk-api/doc/ru/)
- [Yandex OAuth](https://oauth.yandex.ru/)
- [Справочник API](https://yandex.ru/dev/disk-api/doc/ru/reference/)
- [Репозиторий GitHub](https://github.com/tigusigalpa/yandex-disk-php)
