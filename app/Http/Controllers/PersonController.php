<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Entities\Person;
use App\Entities\MediumType;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Http\Requests\Person\PersonCreateRequest;
use App\Http\Requests\Person\PersonUpdateRequest;

class PersonController extends Controller
{
    private $personService;
    public function __construct(PersonService $personService){
        $this->personService = $personService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($count = 20, $page = 1)
    {
				$breadcrumb = array(
						'Home'      =>  route('home.index'),
						'People'    =>  null
				);
        $total  = Person::count();
        $people = Person::orderby('first_name')
                        ->orderby('last_name')
                        ->skip(($page - 1) * $count)
                        ->take($count)
                        ->get();
        $routeName = 'person.page';
        return view('person/list',compact('breadcrumb','people','count','page','total','routeName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $breadcrumb = array(
                'Home'    =>  route('home.index'),
                'People' =>  route('person.index'),
                'Add new person'  => null
            );
            $medium_types = MediumType::all();
            return view('person/create',compact('breadcrumb','medium_types'));
        } else {
            // first login to view this page
            return redirect()->guest('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonCreateRequest $request)
    {
        $person = $this->personService->create($request->getPerson());
        $request->session()->flash('add_another','Add another person');
        return redirect()->route('person.show',[
            'person' => $person->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        $breadcrumb = array(
            'Home'                                           =>  route('home.index'),
            'People'                                         =>  route('person.index'),
             $person->first_name . " " . $person->last_name  => null
        );
        $add_another = session('add_another');
        return view('person/show',compact('person','breadcrumb','add_another'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        $breadcrumb = array(
            'Home'                                           =>  route('home.index'),
            'People'                                         =>  route('person.index'),
             $person->first_name . " " . $person->last_name  =>  route('person.show',$person),
            'Edit'                                           =>  null
        );
        $medium_types = MediumType::all();
        return view('person/edit', compact('person','breadcrumb','medium_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonUpdateRequest $request, Person $person)
    {
        $this->personService->update($person,$request->getPerson());
        return redirect()->route('person.show',compact('person'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $this->personService->destroy($person);
        return redirect()->route('person.index');
    }
}
