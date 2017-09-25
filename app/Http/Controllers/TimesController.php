<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Time;

class TimesController extends Controller
{

	public function __construct() 
	{
	  $this->middleware('auth');
	}
    
	public function index()
	{

		$times = Time::orderBy('id', 'asc')->get();

		return view('times.index', compact('times'));

	}



	public function show(Time $time)
	{

		return view('times.show', compact('time'));

	}



	public function create()
	{

		return view('times.create');

	}



	public function store(Time $time)
	{

		Time::create(request(['time']));


		return redirect('/times');

	}



	public function edit(Time $time)
	{

		return view('times.edit', compact('time'));

	}



	public function update(Request $request, Time $time)
	{

		$time->update($request->all());

		return redirect('/times');

	}



	public function delete(Time $time)
	{

		$time = Time::find($time);

		$time->delete();

		return redirect('/times');

	}

}
