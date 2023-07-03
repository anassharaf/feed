<?php

namespace App\Interfaces;

use App\Models\Item;

interface ItemInterface
{
    // Define the method for storing data
    public function store(array $data): Item;
}
