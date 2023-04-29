<?php

namespace System\Database\Traits;

use System\Database\ORM\Model;

trait HasAttributes
{
    private function registerAttribute($object, string $attribute, $value)
    {
        $this->inCastsAttributes($attribute) ? $object->$attribute = $this->castsDecodeValue($attribute, $value) : $object->$attribute = $value;

    }

    private function inCastsAttributes()
    {

    }

    private function castsDecodeValue(string $attribute, $value)
    {
        
    }

}