<?php

namespace App\Services;

use App\Interfaces\ItemInterface;
use Illuminate\Database\Eloquent\Collection;
use SimpleXMLElement;

class XmlProcessingService
{
    private $failedItems;
    public function __construct(
        private ItemInterface $itemInterface,
        private DataPreparationService $preparation,
        private DataValidationService $dataValidation
    ) {
        $this->failedItems = Collection::empty();
    }

    public function processXmlItems(SimpleXMLElement $xml): XmlProcessingService
    {
        foreach ($xml->item as $item) {
            try {
                // Prepare the item data
                $data = $this->preparation->prepareItemData($item);
                // Validate the Data
                $this->dataValidation->validateItemData($data);
                // Store the data
                $this->itemInterface->store($data);
            } catch (\Exception $exception){
                $messages = $exception->getMessages();
                // Failed Item data To Array
                $failedItem = [
                    'message' => reset($messages),
                    'entity_id'=>(int) $item->entity_id,
                    'name'=>(string) $item->name
                ];
                // Add the Item To Failed Collection
                $this->failedItems->add($failedItem);
            }
        }

        // return collection of failed items
        return $this;
    }

    public function getFailedItems(): Collection
    {
        return $this->failedItems;
    }
}
