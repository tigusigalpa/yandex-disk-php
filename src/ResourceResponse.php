<?php

namespace Tigusigalpa\YandexDisk;

class ResourceResponse
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

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function getPath(): ?string
    {
        return $this->data['path'] ?? null;
    }

    public function getType(): ?string
    {
        return $this->data['type'] ?? null;
    }

    public function getSize(): ?int
    {
        return $this->data['size'] ?? null;
    }

    public function getCreated(): ?string
    {
        return $this->data['created'] ?? null;
    }

    public function getModified(): ?string
    {
        return $this->data['modified'] ?? null;
    }

    public function getPublicUrl(): ?string
    {
        return $this->data['public_url'] ?? null;
    }

    public function isPublished(): bool
    {
        return $this->data['is_publicly_shared'] ?? false;
    }

    public function isDir(): bool
    {
        return ($this->data['type'] ?? null) === 'dir';
    }

    public function isFile(): bool
    {
        return ($this->data['type'] ?? null) === 'file';
    }

    public function getMimeType(): ?string
    {
        return $this->data['mime_type'] ?? null;
    }

    public function getItems(): array
    {
        return $this->data['_embedded']['items'] ?? [];
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
