<?php

namespace Tigusigalpa\YandexDisk\Models;

class Operation
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
     * Get operation status (in-progress, success, failed)
     */
    public function getStatus(): ?string
    {
        return $this->data['status'] ?? null;
    }

    /**
     * Check if operation is in progress
     */
    public function isInProgress(): bool
    {
        return $this->getStatus() === 'in-progress';
    }

    /**
     * Check if operation is successful
     */
    public function isSuccess(): bool
    {
        return $this->getStatus() === 'success';
    }

    /**
     * Check if operation has failed
     */
    public function isFailed(): bool
    {
        return $this->getStatus() === 'failed';
    }

    /**
     * Get operation type
     */
    public function getType(): ?string
    {
        return $this->data['type'] ?? null;
    }

    /**
     * Get operation href
     */
    public function getHref(): ?string
    {
        return $this->data['href'] ?? null;
    }

    /**
     * Get operation method
     */
    public function getMethod(): ?string
    {
        return $this->data['method'] ?? null;
    }

    /**
     * Get operation templated flag
     */
    public function isTemplated(): bool
    {
        return $this->data['templated'] ?? false;
    }

    /**
     * Convert to array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
