<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Entities\MediumType;
use App\Services\MediumTypeService;
use App\Http\Requests\MediumType\MediumTypeCreateRequest;
use App\Http\Requests\MediumType\MediumTypeUpdateRequest;

class MediumTypesController extends Controller
{
    private $mediumTypeService;
    public function __construct(MediumTypeService $mediumTypeService) {
        $this->mediumTypeService = $mediumTypeService;
    }
    
    public function index(){
        $breadcrumb = array(
            'Home'        =>  route('home.index'),
            'Media-types' =>  null
        );
        $media_types = MediumType::all();
        return view('mediumtypes/list',compact('breadcrumb','media_types'));
    }
    
    public function create(){
        if(Auth::check()){
            $breadcrumb = array(
                'Home'                =>  route('home.index'),
                'Media-types'         =>  route('mediumtypes.index'),
                'Add new media-type'  =>  null
            );
            return view('mediumtypes/create',compact('breadcrumb'));
        } else {
            return redirect()->guest('login');
        }
    }
    
    public function store(MediumTypeCreateRequest $request){
        $mediumType = $this->mediumTypeService->create($request->getMediumType());
        $request->session()->flash('add_another','Add another artist');
        return redirect()->route('mediumtypes.show',[
            'mediumType' => $mediumType->id
        ]);
    }
    
    public function show(MediumType $mediumtype){
        $breadcrumb = array(
            'Home'                    =>  route('home.index'),
            'Media-types'             =>  route('mediumtypes.index'),
            $mediumtype->description  =>  null
        );
        $add_another = session('add_another');
        return view('mediumtypes/show',compact('mediumtype','breadcrumb','add_another'));
    }
    
    public function edit(MediumType $mediumtype){
        $breadcrumb = array(
            'Home'                    =>  route('home.index'),
            'Media-types'             =>  route('mediumtypes.index'),
            $mediumtype->description  =>  route('mediumtypes.show', ['mediumtype' => $mediumtype]),
            'Edit'                    =>  null
        );
        return view('mediumtypes/edit',compact('mediumtype','breadcrumb'));
    }
    
    public function update(MediumTypeUpdateRequest $request, MediumType $mediumtype){
        $this->mediumTypeService->update($mediumtype, $request->getMediumType());
        return redirect()->route('mediumtypes.show',compact('mediumtype'));
    }
    
    public function destroy(MediumType $mediumtype){
        $this->mediumTypeService->destroy($mediumtype);
        return redirect()->route('mediumtypes.index');
    }
}
