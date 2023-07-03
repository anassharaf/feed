<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Services\DataPreparationService;
use Respect\Validation\Validator;
use Tests\TestCase;

class DataPreparationTest extends TestCase
{
    public $xml, $preparationService, $dataSample;
    protected function setUp(): void
    {
        parent::setUp();
        copy(__DIR__ . '/../../data/feed.xml', __DIR__ . '/../data/feed.xml');
        $filePath = __DIR__ . '/../data/feed.xml';
        $this->xml = simplexml_load_file($filePath);
        $this->preparationService = new DataPreparationService(new Validator());
        // Clear any existing logs
        file_put_contents(storage_path('logs/laravel.log'),'');
    }

    public function testItPrepareDataToBePushedToDataBaseAndReturnArray()
    {
        $data = $this->preparationService->prepareItemData($this->xml->item);
        self::assertIsArray($data);
    }


    public function testFirstRecordInDataBaseEqualsFirstItemInFile()
    {
        $data = $this->preparationService->prepareItemData($this->xml->item);
        $item_db = Item::find(1)->toArray();
        self::assertEquals($item_db,$data);
    }

    public function testNotEqualsFirstDataBaseRecordWithSecondItemInFile()
    {
        $data = $this->preparationService->prepareItemData($this->xml->item[2]);
        $item_db = Item::find(1)->toArray();
        self::assertNotEquals($item_db,$data);
    }
}
