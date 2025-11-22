<?php

namespace Tigusigalpa\YandexDisk\Models;

class Resource
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
     * Get resource name
     */
    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    /**
     * Get resource path
     */
    public function getPath(): ?string
    {
        return $this->data['path'] ?? null;
    }

    /**
     * Get resource type (file or dir)
     */
    public function getType(): ?string
    {
        return $this->data['type'] ?? null;
    }

    /**
     * Get resource size in bytes
     */
    public function getSize(): ?int
    {
        return $this->data['size'] ?? null;
    }

    /**
     * Get creation date
     */
    public function getCreated(): ?string
    {
        return $this->data['created'] ?? null;
    }

    /**
     * Get last modification date
     */
    public function getModified(): ?string
    {
        return $this->data['modified'] ?? null;
    }

    /**
     * Get public URL if resource is published
     */
    public function getPublicUrl(): ?string
    {
        return $this->data['public_url'] ?? null;
    }

    /**
     * Get public key if resource is published
     */
    public function getPublicKey(): ?string
    {
        return $this->data['public_key'] ?? null;
    }

    /**
     * Check if resource is publicly shared
     */
    public function isPublished(): bool
    {
        return !empty($this->data['public_url']) || !empty($this->data['public_key']);
    }

    /**
     * Check if resource is a directory
     */
    public function isDir(): bool
    {
        return ($this->data['type'] ?? null) === 'dir';
    }

    /**
     * Check if resource is a file
     */
    public function isFile(): bool
    {
        return ($this->data['type'] ?? null) === 'file';
    }

    /**
     * Get MIME type (for files)
     */
    public function getMimeType(): ?string
    {
        return $this->data['mime_type'] ?? null;
    }

    /**
     * Get media type
     */
    public function getMediaType(): ?string
    {
        return $this->data['media_type'] ?? null;
    }

    /**
     * Get preview URL
     */
    public function getPreview(): ?string
    {
        return $this->data['preview'] ?? null;
    }

    /**
     * Get file download URL
     */
    public function getFile(): ?string
    {
        return $this->data['file'] ?? null;
    }

    /**
     * Get MD5 hash
     */
    public function getMd5(): ?string
    {
        return $this->data['md5'] ?? null;
    }

    /**
     * Get SHA256 hash
     */
    public function getSha256(): ?string
    {
        return $this->data['sha256'] ?? null;
    }

    /**
     * Get custom properties
     */
    public function getCustomProperties(): array
    {
        return $this->data['custom_properties'] ?? [];
    }

    /**
     * Get items in directory (if resource is a directory)
     */
    public function getItems(): array
    {
        $items = $this->data['_embedded']['items'] ?? [];
        return array_map(fn($item) => self::fromArray($item), $items);
    }

    /**
     * Get total number of items (for directories)
     */
    public function getTotalItems(): int
    {
        return $this->data['_embedded']['total'] ?? 0;
    }

    /**
     * Get resource ID
     */
    public function getResourceId(): ?string
    {
        return $this->data['resource_id'] ?? null;
    }

    /**
     * Check if resource has comments enabled
     */
    public function hasComments(): bool
    {
        return ($this->data['comment_ids']['public_resource'] ?? null) !== null;
    }

    /**
     * Get owner information
     */
    public function getOwner(): array
    {
        return $this->data['owner'] ?? [];
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
