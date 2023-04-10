<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Membership;

class MembershipController extends Controller
{

    public $imagePath = '/asset-resources/member';

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
        $members = Membership::with('branch')->paginate(30);
        $pg = "member";
        return view('admin.member.all',compact('members','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = "member";
        $branches = Branch::limit(30)->get();
        return view('admin.member.add',compact( 'branches','pg'));
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

            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'gender' => ['required', 'string'],

        ]);

        if ($request->hasFile('profile_pic')) {
            
            $image = $request->file('profile_pic');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;

        }else{

            $this->imagePath = "";

        }

        $member = new Membership();
        $member->fname = $request->fname;
        $member->sname =  $request->sname;
        $member->lname =   $request->lname;

        $member->gender = $request->gender;
        $member->address =  $request->address;
        $member->location =   $request->location;

        $member->phone_number = $request->phone_number;
        $member->email =  $request->email;
        $member->dob =   $request->dob;

        $member->occupation = $request->occupation;
        $member->education =  $request->education;

        $member->profile_pic =   $this->imagePath;

        $member->status = $request->status;
        $member->note =  $request->note;
        $member->branch_id =   $request->branch_id;

        $member->save();

        notify()->success('You Have Added a Record Successfully');

        return redirect("/admin/member");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pg = "member";
        $member = Membership::with('branch')->findorfail($id);
        $branches = Branch::limit(200)->get();
        return view('admin.member.edit',compact('pg','member','branches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pg = "member";
        $member = Membership::with('branch')->findorfail($id);
        $branches = Branch::limit(200)->get();
        return view('admin.member.edit',compact('pg','member','branches'));
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

            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'gender' => ['required', 'string'],

        ]);

        $member = Membership::find($id);

        if ($request->hasFile('profile_pic')) {
            
            $image = $request->file('profile_pic');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;

            $member->profile_pic = $this->imagePath;

        }

        $member->fname = $request->fname;
        $member->sname =  $request->sname;
        $member->lname =   $request->lname;

        $member->gender = $request->gender;
        $member->address =  $request->address;
        $member->location =   $request->location;

        $member->phone_number = $request->phone_number;
        $member->email =  $request->email;
        $member->dob =   $request->dob;

        $member->occupation = $request->occupation;
        $member->education =  $request->education;

        $member->status = $request->status;
        $member->note =  $request->note;
        $member->branch_id =   $request->branch_id;

        $member->save();

        notify()->success('You Have Updated a Record Successfully');

        return redirect("/admin/member");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Membership::find($id)->delete();
        notify()->success('Record Deleted Successfully');
        return back();
    }
}
