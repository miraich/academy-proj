<?php

namespace Tests\Unit;

use App\Interfaces\DownloadFileInterface;
use App\Services\DownloadFileService;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use PHPUnit\Framework\MockObject\Exception;
use Tests\TestCase;


class DownloadFileServiceTest extends TestCase
{
    private DownloadFileService $downloadFileService;

    /**
     * A basic unit test example.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->downloadFileService = new DownloadFileService();
    }

    /** @test */
    public function it_can_set_and_get_filename()
    {
        $this->downloadFileService->set_filename('test.txt');

        $this->assertEquals('test.txt', $this->downloadFileService->get_filename());
    }

    /** @test
     * @throws Exception
     */
    public function it_can_download_file_by_url(): void
    {
        $mockedUrl = 'test_url';
        $folderName = 'Test';

        $mock = $this->partialMock(DownloadFileInterface::class, function (MockInterface $mock) use ($mockedUrl, $folderName) {
            $mock->shouldReceive('download_file_by_url')->with($mockedUrl, $folderName)->once()->andReturn(true);
        });

        $result = $mock->download_file_by_url($mockedUrl, $folderName);

        $this->assertTrue($result);
    }
}
