<?php

namespace App\Http\Controllers;

use App\Models\NavMenuItem;

class HomeController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view("pages.index", $this->data);
    }

    public function author(){
        return view("pages.author", $this->data);
    }

    public function show($id){
        $id=(int)$id;
        foreach($this->data['destinations'] as $destination){
            if ($destination->id==$id){
                return ['destination'=>$destination];
                }
        }
    }
}
