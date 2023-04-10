<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Constituency;

use App\Models\Branch;

class BranchController extends Controller
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
        $branches = Branch::with('constituency')->paginate(30);
        $pg = "branch";
        return view('admin.branch.all',compact('branches','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = "branch";
        $constituencies = Constituency::get();
        return view('admin.branch.add',compact('constituencies','pg'));
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
            'constituency_id' => ['required', 'string'],

        ]);

        $results = Branch::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $branch = new Branch;
        $branch->name = $request->name;
        $branch->slug =  $slug;
        $branch->constituency_id =   $request->constituency_id;

        $branch->save();

        notify()->success('You Have Added a Record Successfully');

        return redirect("/admin/branch");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pg = "branch";
        $branch = Branch::findorfail($id);
        $constituencies = Constituency::limit(30)->get();
        return view('admin.branch.edit',compact('pg','constituencies','branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pg = "branch";
        $branch = Branch::findorfail($id);
        $constituencies = Constituency::limit(30)->get();
        return view('admin.branch.edit',compact('pg','constituencies','branch'));
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
            'constituency_id' => ['required', 'string'],

        ]);

        $results = Branch::where('name', '=', $request->name)->orderBy('created_at', 'desc')->limit("5")->get();
        $slug = checker_slug($request->name, $results, null);

        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->slug =  $slug;
        $branch->constituency_id = $request->constituency_id;

        $branch->save();

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
        $branch = Branch::find($id)->delete();
        notify()->success('Record Deleted Successfully');
        return back();
    }
}
