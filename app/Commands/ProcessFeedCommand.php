<?php

namespace App\Commands;

use App\Services\XmlProcessingService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;

class ProcessFeedCommand extends Command
{
    public function __construct(private XmlProcessingService $xmlProcessor)
    {
        parent::__construct();
    }

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'process:feed {path=demo}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Process the XML feed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Define the path to the XML file
        $filePath =
            $this->argument('path') == 'demo' ?
            base_path('data/feed.xml') :
            $this->argument('path');

        // Read and process the XML file
        try {
            $xml = simplexml_load_file($filePath);
        }catch (\Exception $e){
            Log::error('File Not Found Or Corrupted!: '. $e->getMessage());
            $this->error('File Not Found Or Corrupted!: '. $e->getMessage());
            // Kill Execution
            die();
        }

        try {
            // Parsing the Xml File and Feeding DB
            $failedItems = $this->xmlProcessor->processXmlItems($xml)->getFailedItems();
            // Log the Failed Validation Items
            Log::error(
                'Failed To Validate '. $failedItems->count() . ' Items: '
                .json_encode($failedItems->toArray(),JSON_PRETTY_PRINT)
            );
        } catch (\Exception $exception){
            Log::error('Failed to Process and Feed the data!: '.$exception->getMessage());
            $this->error('Failed to Process and Feed the data!: '.$exception->getMessage());
        }
        
        // Output success message to the console
        $this->info('Feed processed successfully.');
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
