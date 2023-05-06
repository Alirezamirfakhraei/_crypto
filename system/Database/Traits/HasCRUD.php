<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;

trait HasCRUD
{

    protected function fill()
    {
        $fillArray = array();
        foreach ($this->fillabe as $attribute) {
            if (isset($this->$attribute)) {
                $fillArray[] = $this->getAttributeName($attribute) . " = ? ";
                $this->inCastsAttributes($attribute) ?
                    $this->addValue($attribute, $this->castsEncodeValue($attribute, $this->$attribute))
                    : $this->addValue($attribute, $this->$attribute);
            }
        }
        return implode(' , ', $fillArray);
    }

    protected function saveMehtod()
    {
        $fillString = $this->fill();
        if (!isset($this->{$this->primaryKey})) {
            $this->setSql("INSERT INTO" . $this->getTableName() . "SET $fillString, "
                . $this->getAttributeName($this->createdAt) . "=Now()");
        }else{
            $this->setSql("UPDATE ". $this->getTableName() . "SET $fillString, "
                . $this->getAttributeName($this->updateAt) . "=Now()");
            $this->setWhere("AND" , $this->getAttributeName($this->primaryKey)." = ?");
            $this->addValue($this->primaryKey , $this->{$this->primaryKey});
        }
        $this->executeQuery();
    }


}