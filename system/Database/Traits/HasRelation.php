<?php

namespace System\Database\Traits;

trait HasRelation
{
    public function hasOne($table, $foreignKey, $otherKey, $otherKeyValue)
    {
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN" . $this->getTableName()
            . "AS `b` on `a`.`{$otherKey}=`b`.`{$foreignKey}");
        $this->setWhere('AND', "`a`.`{$otherKey}` = ? ");
        $this->table = 'b';
        $this->addValue($otherKey, $otherKeyValue);
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }
}




?>