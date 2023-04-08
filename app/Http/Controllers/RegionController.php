<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::paginate(10);
        $pg = "person";
        return view('admin.region.all',compact('regions','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = "person";
        return view('admin.region.add',compact('pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = Region::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $region = new Region;
        $region->name = $request->name;
        $region->slug =  $slug;
        $region->description = $request->description;

        $region->save();

        notify()->success('You Have Added a Region Successfully');

        return redirect("/admin/region");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pg = "person";
        $region = Region::findorfail($id);
        return view('admin.region.edit',compact('pg','region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pg = "person";
        $region = Region::findorfail($id);
        return view('admin.region.edit',compact('pg','region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $results = Region::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $region = Region::find($id);
        $region->name = $request->name;
        $region->slug =  $slug;
        $region->description = $request->description;

        $region->save();

        notify()->success('You Have Updated Region Data Successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id)->delete();
        notify()->success('Record Deleted Successfully');
        return back();
    }
}
