<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllPagesController extends Controller
{
    public function aboutus(){
        return view('pages.aboutus');
    }
    
    public function term_condition(){
        return view('pages.term_condition');
    }
    public function privacy_policy(){
        return view('pages.privacy_policy');
    }

}
