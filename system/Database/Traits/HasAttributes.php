<?php

namespace System\Database\Traits;

use System\Database\ORM\Model;

trait HasAttributes
{
    private function registerAttribute($object, string $attribute, $value)
    {
        $this->inCastsAttributes($attribute) ? $object->$attribute = $this->castsDecodeValue($attribute, $value) : $object->$attribute = $value;

    }

    protected function arrayToAttribute(array $array, $object = null)
    {
        if (!$object) {
            $className = get_called_class();
            $object = new $className;
        }
        foreach ($array as $attribute => $value) {
            if ($this->inHiddenAttribute($attribute))
                continue;
            $this->registerAttribute($attribute, $object, $value);
        }
        return $object;
    }

    private function arrayToObjects(array $array)
    {
        $collection = [];
        foreach ($array as $value) {
            $object = $this->arrayToAttribute($value);
            $collection[] = $object;
        }
        $this->colloction = $collection;
    }

    private function inHiddenAttribute($attribute)
    {
        return in_array($attribute, $this->hidden);
    }

    private function inCastsAttributes($attribute)
    {
        return in_array($attribute, array_keys($this->casts));
    }

    private function castsEncodeValue(string $attributeKey, $value)
    {
        if ($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object') {
            return serialize($value);
        }
        return $value;
    }

    private function castsDecodeValue(string $attributeKey, $value)
    {
        if ($this->casts[$attributeKey] == 'array' || $this->casts[$attributeKey] == 'object') {
            return unserialize($value);
        }
        return $value;
    }

    private function arrayToCastEncodeValue($values)
    {
        $newArray = [];
        foreach ($values as $attribute => $value) {
            $this->inCastsAttributes($attribute) == true ? $newArray[$attribute] =
                $this->castsEncodeValue($attribute, $value) : $newArray[$attribute] = $value;
        }
        return $newArray;
    }

}