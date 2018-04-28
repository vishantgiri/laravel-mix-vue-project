<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersDetails;
use App\Http\Resources\UsersDetails as UsersDetailsResource;

class UsersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get articles
        $UsersDetails = UsersDetails::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of articles as a resource
        return UsersDetailsResource::collection($UsersDetails);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 
	 
        $UsersDetails = $request->input('id') ? UsersDetails::findOrFail($request->input('id')) : new UsersDetails;

        $UsersDetails->id = $request->input('id');
        $UsersDetails->name = $request->input('name');
        $UsersDetails->phone = $request->input('phone');
	    $UsersDetails->email = $request->input('email');
		$UsersDetails->gender = $request->input('gender');
	    $UsersDetails->dateofBirth = $request->input('dateofBirth');
	    $UsersDetails->biography = $request->input('biography');
		//$UsersDetails->profilepicture = $request->input('profilepicture');
		if(!empty($request->file('image'))){
			$path = $request->file('image')->store('images');
			$UsersDetails->profilepicture = $path;
		}
		
		
		if($UsersDetails->save()) {
            return new UsersDetailsResource($UsersDetails);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get article
        $UsersDetails = UsersDetails::findOrFail($id);

        // Return single article as a resource
        return new UsersDetailsResource($UsersDetails);
    }
	
	/**
     * upload .
     *
     * @param  int  $up
     * @return \Illuminate\Http\Response
     */
	 
    public function upload(Request $request)
    {
        $path = $request->file('image')->store('images');

        return $path;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get article
        $UsersDetails = UsersDetails::findOrFail($id);

        if($UsersDetails->delete()) {
            return new UsersDetailsResource($UsersDetails);
        }    
    }
}
