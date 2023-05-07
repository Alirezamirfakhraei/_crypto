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
        } else {
            $this->setSql("UPDATE " . $this->getTableName() . "SET $fillString, "
                . $this->getAttributeName($this->updateAt) . "=Now()");
            $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");
            $this->addValue($this->primaryKey, $this->{$this->primaryKey});
        }
        $this->executeQuery();
        $this->resetsql();


        if (!isset($this->{$this->primaryKey})) {
            $object = $this->findMethod(DBConnection::newInsertID());
            $defaultVars = get_class_vars(get_called_class());
            $allVars = get_object_vars($object);
            $differentVars = array_diff(array_keys($defaultVars), array_keys($allVars));
            foreach ($differentVars as $attribute) {
                $this->inCastsAttributes($attribute) ? $this->registerAttribute($this, $attribute, $this->castsEncodeValue($attribute, $object->$attribute))
                    : $this->registerAttribute($this, $attribute, $object->$attribute);
            }
        }
    }

    protected function deleteMethod($id = null)
    {
        $object = $this;
        $this->resetQuery();
        if ($id) {
            $object = $this->findMethod($id);
            $this->resetQuery();
        }
        $object->setSql("DELETE FROM " . $object->getTableName());
        $object->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ? ");
        $object->addValue($object->primaryKey, $object->{$object->primaryKey});
        return $object->executeQuery();
    }


}