<?php

namespace App\Services;

use Respect\Validation\Validator;
use SimpleXMLElement;

class DataPreparationService
{
    public function prepareItemData(SimpleXMLElement $item): array
    {
        // Prepare the data as an associative array
        $data = [
            'entity_id' => (int) $item->entity_id,
            'category_name' => (string) $item->CategoryName,
            'sku' => (string) $item->sku,
            'name' => (string) $item->name,
            'description' => (string) $item->description,
            'shortdesc' => (string) $item->shortdesc,
            'price' => (float) $item->price,
            'link' => (string) $item->link,
            'image' => (string) $item->image,
            'brand' => (string) $item->Brand,
            'rating' => (int) $item->Rating,
            'caffeine_type' => (string) $item->CaffeineType,
            'count' => (int) $item->Count,
            'flavored' => (string) $item->Flavored,
            'seasonal' => (string) $item->Seasonal,
            'instock' => (string) $item->Instock,
            'facebook' => (int) $item->Facebook,
            'is_kcup' => (int) $item->IsKCup,
        ];

        // Return the prepared item data
        return $data;
    }
}
