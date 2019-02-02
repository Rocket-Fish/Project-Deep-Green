<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
* This controller is for front end spa stuff
*/

class PageController extends Controller
{

  public function index(){
    return view('spa');
  }

}
