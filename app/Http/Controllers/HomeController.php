<?php

namespace App\Http\Controllers;

use System\Database\DBBuilder\DBBuilder;

class HomeController extends Controller
{

    public function index(){
        echo 'sdfsdf';
    }

    public function create(){
        echo "create method in HomeController";
    }
    public function store(){
        echo "store method in HomeController";
    }
    public function edit($id){
        echo "edit method in HomeController";
    }
    public function update($id){
        echo "update method in HomeController";
    }
    public function destroy($id){
        echo "destroy method in HomeController";
    }

}