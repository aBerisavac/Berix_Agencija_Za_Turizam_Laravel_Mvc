<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function contact(Request $request){
        $errors = [];

        $message= $request->get('contact-message');

        if(session()->has('user') && $request->get('contact-email')==""){
            $email = session()->get('user')->email;
        } elseif($request->get('contact-email')==""){
            $email = 'anonymous';
        }
        else{

            $email=$request->get('contact-email');
            $reEmail = "/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
            if(!preg_match($reEmail, $email)) array_push($errors, "Email format is not valid");

        }

        $reMessage = "/^[\w .,!?:;]{2,200}$/";
        if(!preg_match($reMessage, $message)) array_push($errors, "Your message is too short or too long, or you have used forbidden characters.");

        if(count($errors)==0){

            $contactMessage = new ContactMessage();
            $contactMessage->email=$email;
            $contactMessage->message=$message;
            $contactMessage->save();

            return redirect()->route('index')->with('contactIsSuccessfull', true);
        }else{
            return redirect()->route('index')->with('contactErrors', $errors);
        }
    }

    public function select($table){
        $table="App\Models\\".$table;
        $table=app($table);
        $table=$table->get();
        return ['table'=>$table];
    }

    public function selectSearch($table, $column, $searchTerm){
        $table="App\Models\\".$table;
        $table=app($table);
        $table=$table->where($column, "LIKE", "%".$searchTerm."%")->get();
        return ['table'=>$table];
    }

    public function delete($table, $id){

        try{
            $table="App\Models\\".$table;
            $table=app($table);
            $table->find($id)->delete();


            $table="App\Models\\".$table;
            $table=app($table);
            $table=$table->get();

            return ['table'=>$table];
        }
        catch(\Exception $exception){
            return $exception;
        }
    }

    public function admin(){
        return view('pages.admin', $this->data);
    }
}
