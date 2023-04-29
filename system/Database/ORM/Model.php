<?php

namespace System\Database\ORM;

use System\Database\Traits\HasCRUD;
use System\Database\Traits\HasAttributes;
use System\Database\Traits\HasQueryBuilder;
use System\Database\Traits\HasMethodCaller;
use System\Database\Traits\HasRelation;
use System\Database\Traits\HasSoftDelete;

abstract class Model
{
    use HasCrud,HasAttributes,HasQueryBuilder,HasMethodCaller,HasRelation,HasSoftDelete ;

    protected $table;
    protected $fillabe = [];
    protected $hidden = [];
    protected $casts = [];
    protected $primaryKey = 'id';
    protected $createdAt = 'createdAt';
    protected $updateAt = 'updateAt';
    protected $deleteAt = null;
    protected $colloction = [];


}