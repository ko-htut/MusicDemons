<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;

class ProfileController extends Controller
{
    private $profileService;
    public function __construct(ProfileService $profileService){
        $this->profileService = $profileService;
    }

    public function index() {
        if(Auth::check()){
    				$breadcrumb = array(
    						'Home'      =>  route('home.index'),
    						'Profile'   =>  null
    				);
            $user = Auth::user();
            return view('auth/profile',compact('breadcrumb','user'));
        } else {
            // first login to view this page
            return redirect()->guest('login');
        }
    }
    
    public function store(ProfileUpdateRequest $request){
        if(Auth::check()){
            $this->profileService->update($request->getUser());
            return redirect()->route('home.index');
        } else {
            // first login to view this page
            return redirect()->route('login');
        }
    }
    
    public function likes() {
        $breadcrumb = array(
            'Home'      =>  route('home.index'),
            'Likes'     =>  null
        );
        return view('likes', compact('breadcrumb'));
    }
}
