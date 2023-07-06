<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class GenralComtroller extends Controller
{
    public function changeLanguage($local){
        try{
            if(array_key_exists($local, config('local.languages'))){
                Session::put('locale',$local);
                App::setLocale($local);
                return redirect()->back();

            }
            return redirect()->back();}
            catch(\Exception $exception){

                return dd($exception);
            }



    }
}
