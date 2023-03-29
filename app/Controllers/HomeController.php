<?php

namespace App\Controllers;

use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {

       $contactModel = new Contact();

       return $contactModel->query("SELECT * FROM cat_roles")->get();
        
        return $this->view('home',[
            'title'=>'Home',
            'description'=>'Esta es la página Home'
        ]);
    }

}
