<?php

namespace App\Http\Controllers\Api\v1;

use Auth;
use App\User;
use App\Entities\Person;
use App\Entities\MediumType;
use App\Helpers\Functions;
use App\Helpers\SubjectHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Http\Requests\Person\PersonCreateRequest;
use App\Http\Requests\Person\PersonUpdateRequest;
use Yajra\Datatables\Datatables;

// https://github.com/yajra/laravel-datatables

class PersonController extends Controller
{
    private $personService;
    public function __construct(PersonService $personService) {
        $this->personService = $personService;
    }

    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $people = Person::all();
        return response()->json($people);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PersonCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonCreateRequest $request) {
        $person = $this->personService->create($request->getPerson());
        return response()->json($person);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  App\Entities\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person) {
        return response()->json($person);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PersonUpdateRequest  $request
     * @param  App\Entities\Person $person
     * @return \Illuminate\Http\Response
     */
    public function update(PersonUpdateRequest $request, Person $person) {
        $this->personService->update($person,$request->getPerson());
        return response()->json($person);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Entities\Person $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person) {
        $this->personService->destroy($person);
        return response()->json(array());
    }
    
    /**
     * Expose data to the DataTables.net module
     *
     */
    public function datatables() {
        $people = Person::all();
        return Datatables::of($people)->make(true);
    }
}
