<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{   
    //Tela Gerenciadora de Menus: Home
    public function manager(){
        return view('home');
    }
}