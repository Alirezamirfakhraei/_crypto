<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;


trait HasQueryBuilder
{

    private $sql = '';
    private $orderBY = [];
    private $limit = [];
    private $values = [];
    private $bindValues = [];
    protected $where = [];


    protected function setSql($query)
    {
        $this->sql = $query;
    }

    protected function getSql($query)
    {
        $this->sql = $query;
    }

    protected function resetSql()
    {
        $this->sql = '';
    }

    protected function setWhere($operator, $condition)
    {
        $array = ['operator' => $operator, 'condition' => $condition];
        $this->where[] = $array;
    }

    protected function resetWhere()
    {
        $this->where = '';
    }

    protected function setOrderBy($name , $expression)
    {
        $this->orderBY[] = $name . ' ' . $expression;
    }

    protected function resetOrderBy()
    {
        $this->where = [];
    }

    protected function setLimti($from , $number)
    {
        $this->limit['from'] = (int) $from;
        $this->limit['number'] = (int) $number;

    }

    protected function resetLimti()
    {
        unset($this->limit['from']);
        unset($this->limit['number']);
    }

    protected function addValue($attribute , $value)
    {
        $this->values[$attribute] = $value;
        $this->bindValues[] = $value;
    }

    protected function removeValues()
    {
        $this->values = [];
        $this->bindValues = [];
    }

    protected function resetQuery()
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimti();
        $this->removeValues();
    }


}