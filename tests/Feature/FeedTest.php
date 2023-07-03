<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class FeedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Clear any existing logs
        file_put_contents(storage_path('logs/laravel.log'),'');
    }
    public function testFeedingDataBaseWithoutErrors()
    {
        // Run the command using Artisan facade
        Artisan::call('process:feed');

        // Get the output of the command
        $output = Artisan::output();

        // Assert success Message in Console
        $this->assertStringContainsString('Feed processed successfully.', $output);
    }

    public function testPassingFilePath()
    {
        // Run the command using Artisan facade
        Artisan::call('process:feed' ,[ 'path' =>  base_path('/tests/data/feed.xml')]);
        // Get the output of the command
        $output = Artisan::output();

        // Assert success Message in Console
        $this->assertStringContainsString('Feed processed successfully.', $output);
    }
}
