<?php

namespace Tests\Unit;

use App\Services\DataValidationService;
use PHPUnit\Framework\TestCase;
use Respect\Validation\Exceptions\ValidatorException;

class ValidatorTest extends TestCase
{
    public $validator, $dataSample;
    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new DataValidationService();
    }

    public function testItValidatesData()
    {
        $this->dataSample = [
            'entity_id' => 1,
            'category_name' => 'category',
            'sku' => 'sku',
            'name' => 'Item',
            'description' => 'desc',
            'shortdesc' => 'short desc',
            'price' => 10.5,
            'link' => 'link.aa',
            'image' => 'image',
            'brand' => 'brand',
            'rating' => 3,
            'caffeine_type' => 'type',
            'count' => 50,
            'flavored' => 'yes',
            'seasonal' => 'winter',
            'instock' => 'in stock',
            'facebook' => 1,
            'is_kcup' => 0,
        ];
        try {
            $this->validator->validateItemData($this->dataSample);
        } catch (\Exception $e){
            $this->fail();
        }
        self::assertTrue(true);
    }

    public function testItThrowsExceptionOnDataValidationFailure()
    {
        $this->dataSample = [
            'entity_id' => 'this should be integer',
            'category_name' => 'category',
            'sku' => 'sku',
            'name' => 'Item',
            'description' => 'desc',
            'shortdesc' => 'short desc',
            'price' => 10.5,
            'link' => 'link.aa',
            'image' => 'image',
            'brand' => 'brand',
            'rating' => 3,
            'caffeine_type' => 'type',
            'count' => 50,
            'flavored' => 'yes',
            'seasonal' => 'winter',
            'instock' => 'in stock',
            'facebook' => 1,
            'is_kcup' => 0,
        ];
        $this->expectException(ValidatorException::class);
        $this->validator->validateItemData($this->dataSample);
    }
}
