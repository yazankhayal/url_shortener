<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\URL;

class HomePageController extends Controller
{
    public function index(){
        $items = null;
        if(Auth::user()){
            $items = URL::where("user_id",Auth::user()->id)->orderby("created_at","desc")->get();
        }
        return view('index',compact('items'));
    }
}
