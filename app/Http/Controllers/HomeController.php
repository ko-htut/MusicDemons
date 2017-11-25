<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /*$user = Auth::user();
        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('www-data@lyricdb.tk', 'LyricDB');
            $m->to($user->email, $user->name)->subject('Reminder!');
        });*/
        //mail("pieterjandeclippel@msn.com", "Subject", "Hello!");
    
        $breadcrumb = array(
            'Home'      =>  null
        );
        return view('home', compact('breadcrumb'));
    }
}
