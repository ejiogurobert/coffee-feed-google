<?php

namespace App\Traits;


trait XmlSpreadsheetTrait
{
    public function getXmlDataToArray($array)
    {
        $data = [];
        // info(json_encode($array));
        $header = $this->getSheetHeader();

        foreach ($array as $item) {
            // info(json_encode($item));
            $data[] = [
                $item['entity_id'] ?? '',
                $this->convertDataToString($item['CategoryName']),
                $item['sku'] ?? '',
                $this->convertDataToString($item['name']),
                $this->convertDataToString($item['description']),
                $this->convertDataToString($item['shortdesc']),
                $this->convertDataToString($item['price']),
                $item['link'] ?? '',
                $item['image'] ?? '',
                $this->convertDataToString($item['Brand']),
                $item['Rating'] ?? '',
                $this->convertDataToString($item['CaffeineType']),
                $item['Count'] ?? '',
                $item['Flavored'] ?? '',
                $item['Seasonal'] ?? '',
                $item['Instock'] ?? '',
                $item['Facebook'] ?? '',
                $item['Iskup'] ?? '',
            ];
        }
        array_unshift($data, $header);


        return $data;
    }

    private function convertDataToString($array)
    {
        return is_array($array) ? implode(',', $array) : $array;
    }

    public function getSheetHeader()
    {
        return [
            'entity', 'CategoryName', 'sku', 'name', 'description', 'shortdesc', 'price', 'link', 'image', 'Brand',
            'Ratings', 'CaffeineType', 'Count', 'Flavored', 'Seasonal', 'Instock', 'Facebook', 'Iskup'
        ];
    }
}
