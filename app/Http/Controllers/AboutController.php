<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\About\SendMailRequest;

class AboutController extends Controller
{
    public function index() {
				$breadcrumb = array(
						'Home'      =>  route('home.index'),
						'About'   =>  null
				);
        return view('about',compact('breadcrumb'));
    }
    
    public function send_mail(SendMailRequest $request) {
        if(Auth::check()){
            //$request->getMessage();
            $request->session()->flash('mailsuccess');
            return redirect()->route('about.mailsuccess');
        } else {
            return redirect()->guest('login');
        }
    }
    
    public function mail_success() {
        if(empty(session('mailsuccess'))){
            return redirect()->route('home.index');
        } else {
    				$breadcrumb = array(
    						'Home'         =>  route('home.index'),
    						'Message sent' =>  null
    				);
            return view('mailsuccess',compact('breadcrumb'));
        }
    }
}
