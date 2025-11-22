<?php

namespace Tigusigalpa\YandexDisk\Models;

class DiskInfo
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Get total disk space in bytes
     */
    public function getTotalSpace(): int
    {
        return $this->data['total_space'] ?? 0;
    }

    /**
     * Get used disk space in bytes
     */
    public function getUsedSpace(): int
    {
        return $this->data['used_space'] ?? 0;
    }

    /**
     * Get free disk space in bytes
     */
    public function getFreeSpace(): int
    {
        return $this->getTotalSpace() - $this->getUsedSpace();
    }

    /**
     * Get trash size in bytes
     */
    public function getTrashSize(): int
    {
        return $this->data['trash_size'] ?? 0;
    }

    /**
     * Check if unlimited autoupload is enabled
     */
    public function isUnlimitedAutouploadEnabled(): bool
    {
        return $this->data['unlimited_autoupload_enabled'] ?? false;
    }

    /**
     * Get max file size for upload in bytes
     */
    public function getMaxFileSize(): int
    {
        return $this->data['max_file_size'] ?? 0;
    }

    /**
     * Get paid max file size in bytes
     */
    public function getPaidMaxFileSize(): int
    {
        return $this->data['paid_max_file_size'] ?? 0;
    }

    /**
     * Get system folders
     */
    public function getSystemFolders(): array
    {
        return $this->data['system_folders'] ?? [];
    }

    /**
     * Get user information
     */
    public function getUser(): array
    {
        return $this->data['user'] ?? [];
    }

    /**
     * Check if user is paid
     */
    public function isPaid(): bool
    {
        return ($this->data['is_paid'] ?? false) === true;
    }

    /**
     * Get disk usage percentage
     */
    public function getUsagePercentage(): float
    {
        $total = $this->getTotalSpace();
        if ($total === 0) {
            return 0.0;
        }
        return round(($this->getUsedSpace() / $total) * 100, 2);
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
