<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Team;

use Session;

class TeamsController extends Controller
{

	public function __construct() 
	{
	  $this->middleware('auth');
	}
    
	public function index()
	{

		// $teams = Team::orderBy('school_name', 'asc')->filter(request(['schoolname'])->paginate(5);

		$teams = Team::orderBy('school_name', 'asc')->paginate(24);

		// $sortedteams = Team::where('school_name', 'like', 'c%')->get();

		// return $sortedteams;

		return view('teams.index', compact('teams'));

	}



	public function show(Team $team)
	{

		return view('teams.show', compact('team'));
		
	}



	public function create()
	{

		

		return view('teams.create');

	}



	public function store(Team $team)
	{

		$this->validate(request(), [
        	'school_name' 			=> 	'required|unique:teams',
        	'abbreviated_name'		=>	'required'
    	]);

		Team::create([

			'school_name'			=>	request('school_name'),
			'mascot'				=>	request('mascot'),
			'abbreviated_name'		=>	request('abbreviated_name'),
			'state'					=>	request('state'),
			'city'					=>	request('city'),
			'region_baseball'		=>	request('region_baseball'),
			'district_baseball'		=>	request('district_baseball'),
			'region_basketball'		=>	request('region_basketball'),
			'district_basketball'	=>	request('district_basketball'),
			'class_football'		=>	request('class_football'),
			'district_football'		=>	request('district_football'),
			'region_soccer'			=>	request('region_soccer'),
			'district_soccer'		=>	request('district_soccer'),
			'region_softball'		=>	request('region_softball'),
			'district_softball'		=>	request('district_softball'),
			'region_volleyball'		=>	request('region_volleyball'),
			'district_volleyball'	=>	request('district_volleyball')

		]);

		Session::flash('success', 'Team Added');

		return redirect('/teams');

	}



	public function edit(Team $team)
	{

		return view('teams.edit', compact('team'));

	}



	public function update(Request $request, Team $team)
	{

		$team->update($request->all());

		Session::flash('success', 'Team Updated');

		return redirect('teams');

	}



	public function delete(Team $team)
	{

		$team = Team::find($team);

		$team->delete();

		return redirect('/teams');

	}







	public function imageUpload($id)
    {

    	$team = Team::find($id);

    	return view('teams.imageupload', compact('team'));
    }

    /**
    * Manage Post Request
    *
    * @return void
    */
    public function imageUploadPost(Request $request, Team $team, $id)
    {
    	$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

    	$theImageName = $request->file('image')->getClientOriginalName();
        //$imageName = time().'.'.$request->image->getClientOriginalExtension();
        // $request->image->resize(300, 300);
        $request->image->move(public_path('/images/team-logos/'), $theImageName);
        // Image::make($logo)->resize(300, 300)->save( public_path('/images/team-logos/' . $theImageName ) );

        $team = Team::find($id);

        $team->logo = $theImageName;

        $team->save();

    	return back()
    		->with('success','Image Uploaded successfully. ' .$theImageName )
    		->with('path',$theImageName);
    }



    public function apiteam(Team $team)
	{

		return $team;

	}



}
