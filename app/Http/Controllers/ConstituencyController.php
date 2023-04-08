<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Constituency;

use App\Models\Region;

class ConstituencyController extends Controller
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
        $constituencies = Constituency::paginate(30);
        $pg = "conctituency";
        return view('admin.constituency.all',compact('constituencies','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = "region";
        $regions = Region::limit(30)->get();
        return view('admin.constituency.add',compact( 'regions','pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'name' => ['required', 'string'],
            'region' => ['required', 'string'],

        ]);

        $results = Constituency::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $constituency = new Constituency;
        $constituency->name = $request->name;
        $constituency->slug =  $slug;
        $constituency->region_id =   $request->region;

        $constituency->save();

        notify()->success('You Have Added a Record Successfully');

        return redirect("/admin/constituency");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pg = "constituency";
        $constituency = Constituency::findorfail($id);
        $regions = Region::limit(30)->get();
        return view('admin.constituency.edit',compact('pg','constituency','regions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pg = "constituency";
        $constituency = Constituency::findorfail($id);
        $regions = Region::limit(30)->get();
        return view('admin.constituency.edit',compact('pg','constituency','regions'));
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
        $this->validate($request, [

            'name' => ['required', 'string'],
            'region' => ['required', 'string'],

        ]);

        $results = Constituency::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $constituency = Constituency::find($id);
        $constituency->name = $request->name;
        $constituency->slug =  $slug;
        $constituency->region_id =   $request->region;

        $constituency->save();

        notify()->success('You Have Updated a Record Successfully');

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
        $constituency = Constituency::find($id)->delete();
        notify()->success('Record Deleted Successfully');
        return back();
    }
}
