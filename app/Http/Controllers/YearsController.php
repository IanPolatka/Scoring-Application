<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Year;

class YearsController extends Controller
{

	public function __construct() 
    {
      $this->middleware('auth', ['only' => [ 'create', 'edit', 'delete' ]]);
    }
    
	public function index()
	{

		$years = Year::orderBy('year', 'asc')->get();;

		return view('years.index', compact('years'));

	}



	public function showall()
	{

		$years = Year::orderBy('year', 'asc')->get();;

		return $years;

	}



	public function show(Year $year)
	{

		return view('years.show', compact('year'));

	}



	public function create()
	{

		return view('years.create');

	}



	public function store(Year $year)
	{

		Year::create(request(['year']));


		return redirect('/years');

	}



	public function edit(Year $year)
	{

		return view('years.edit', compact('year'));

	}



	public function update(Request $request, Year $year)
	{

		$year->update($request->all());

		return redirect('/years');

	}



	public function delete(Year $year)
	{

		$year = Year::find($year);

		$year->delete();

		return redirect('/years');

	}




	public function apishowall()
	{

		$years = Year::orderBy('year', 'asc')->get();;

		return $years;

	}

	public function apishow($id)
	{

		$year = Year::find($id);

		return $year;

	}

	public function apistore(Year $year)
	{

		Year::create(request(['year']));


		return redirect('/years');

	}



	public function apiupdate(Request $request, Year $year)
	{

		$year->update($request->all());
		return response()->json($year, 200);

	}

}
