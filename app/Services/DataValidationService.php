<?php

namespace App\Services;

use Respect\Validation\Validator;

class DataValidationService
{
    private $validator;

    public function __construct()
    {
        $this->validator= new Validator();
    }

    public function validateItemData(array $data): void
    {
        //Validating The data to match the DB Table
        $this->validator::key('entity_id', $this->validator::notEmpty()->intType())
            ->key('category_name', $this->validator::notEmpty()->stringType())
            ->key('sku', $this->validator::notEmpty()->stringType())
            ->key('name', $this->validator::notEmpty()->stringType())
            ->key('description', $this->validator::stringType())
            ->key('shortdesc', $this->validator::stringType())
            ->key('price', $this->validator::notEmpty()->floatType())
            ->key('link', $this->validator::notEmpty()->stringType())
            ->key('image', $this->validator::notEmpty()->stringType())
            ->key('brand', $this->validator::stringType())
            ->key('rating', $this->validator::intType())
            ->key('caffeine_type', $this->validator::stringType())
            ->key('count', $this->validator::intType())
            ->key('flavored', $this->validator::stringType())
            ->key('seasonal', $this->validator::stringType())
            ->key('instock', $this->validator::notEmpty()->stringType())
            ->key('facebook', $this->validator::intType())
            ->key('is_kcup', $this->validator::intType())
            ->assert($data);
    }
}
