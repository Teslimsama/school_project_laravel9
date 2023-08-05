<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class blankPageController extends Controller
{
    public function LetsGo(){

    return view('blank');
}
}
