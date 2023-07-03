<?php

namespace App\Repositories;

use App\Interfaces\ItemInterface;
use App\Models\Item;

class ItemRepository implements ItemInterface
{
    public function store(array $data): Item
    {
        // Create a new item in the database using the provided data
        return Item::create($data);
    }
}
