<?php

namespace Tigusigalpa\YandexDisk\Tests;

use PHPUnit\Framework\TestCase;
use Tigusigalpa\YandexDisk\ResourceResponse;
use Tigusigalpa\YandexDisk\YandexDiskClient;

class YandexDiskClientTest extends TestCase
{
    private YandexDiskClient $client;

    public function testClientInstantiation(): void
    {
        $this->assertInstanceOf(YandexDiskClient::class, $this->client);
    }

    public function testResourceResponseFromArray(): void
    {
        $data = [
            'name' => 'test.txt',
            'path' => '/disk/test.txt',
            'type' => 'file',
            'size' => 1024,
            'created' => '2024-01-01T00:00:00+00:00',
            'modified' => '2024-01-01T00:00:00+00:00',
            'mime_type' => 'text/plain',
            'is_publicly_shared' => false,
        ];

        $response = ResourceResponse::fromArray($data);

        $this->assertEquals('test.txt', $response->getName());
        $this->assertEquals('/disk/test.txt', $response->getPath());
        $this->assertEquals('file', $response->getType());
        $this->assertEquals(1024, $response->getSize());
        $this->assertTrue($response->isFile());
        $this->assertFalse($response->isDir());
        $this->assertFalse($response->isPublished());
        $this->assertEquals('text/plain', $response->getMimeType());
    }

    public function testResourceResponseIsDir(): void
    {
        $data = [
            'name' => 'folder',
            'type' => 'dir',
            'path' => '/disk/folder',
        ];

        $response = ResourceResponse::fromArray($data);

        $this->assertTrue($response->isDir());
        $this->assertFalse($response->isFile());
    }

    public function testResourceResponsePublicUrl(): void
    {
        $data = [
            'name' => 'public.txt',
            'type' => 'file',
            'public_url' => 'https://yadi.sk/d/abc123',
            'is_publicly_shared' => true,
        ];

        $response = ResourceResponse::fromArray($data);

        $this->assertTrue($response->isPublished());
        $this->assertEquals('https://yadi.sk/d/abc123', $response->getPublicUrl());
    }

    public function testResourceResponseToArray(): void
    {
        $data = [
            'name' => 'test.txt',
            'type' => 'file',
        ];

        $response = ResourceResponse::fromArray($data);

        $this->assertEquals($data, $response->toArray());
    }

    protected function setUp(): void
    {
        // Using a dummy token for testing
        $this->client = new YandexDiskClient('dummy_token');
    }
}
