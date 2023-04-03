<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use App\Models\BusinessData;
use App\Models\PersonalData;

use Illuminate\Support\Facades\Auth;

use App\Charts\DataChart;

use Carbon\Carbon;

use DB;

use notify;


class userController extends Controller
{

    public $imagePath = '/asset-resources/user_profile';

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
        $users = User::paginate(10);
        $pg = "all_users";
        return view('admin.user.all_users',compact('users','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $pg = "add_user";
        return view('admin.user.add_user',compact('pg'));
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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if ($request->hasFile('profile_img')) {
            
            $image = $request->file('profile_img');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;

        }else{

            $this->imagePath = "";

        }

        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->bio = $request->input('bio');
        $user->pic = $this->imagePath;
        $user->phone_number = $request->input('phone_number');
        $user->type = $request->input('user_type');
        $user->status = $request->input('user_status');

        // SAVE
        $user->save();

        notify()->success('You Have Added a User Successfully');

       return redirect("/admin/user");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);
        $pg = "edit_user";
        return view('admin.user.edit_user',compact('user','pg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        $pg = "edit_user";
        return view('admin.user.edit_user',compact('user','pg'));
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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::findorfail($id);
        
        if ($request->hasFile('profile_img')) {
            
            $image = $request->file('profile_img');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;
            $user->pic = $this->imagePath;

        }
        
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->bio = $request->input('bio');
        $user->phone_number = $request->input('phone_number');
        $user->type = $request->input('user_type');
        $user->status = $request->input('user_status');

        // SAVE
        $user->save();

        notify()->success('The user has been updated successfully.');

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
        $user = User::findorfail($id)->delete();
        notify()->success('Deleted Successfully.');
        return back();
    }

    public function profile()
    {
        $user = User::findorfail(auth()->user()->id);
        $pg = "profile";
        return view('admin.user.profile',compact('user','pg'));
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::findorfail(auth()->user()->id);
        
        if ($request->hasFile('profile_img')) {
            
            $image = $request->file('profile_img');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;
            $user->pic = $this->imagePath;

        }

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->phone_number = $request->input('phone_number');
       
        // SAVE
        $user->save();

        notify()->success('You Have  updated Your Profile successfully.');

       return back();
    }

    public function change_password()
    {
        $pg = "edit_user";
        return view('admin.user.change_password',compact('pg'));
    }


    

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'currentpassword' => 'required|min:8',
        ]);
        
        $email = auth()->user()->email;

        if (Auth::guard()->attempt(['email' => $email, 'password' => $request->currentpassword], $request->get('remember'))) {
            
            $id = auth()->user()->id;
            $user = User::find($id);
            $user->password = Hash::make($request->input('password'));
            // SAVE
            $user->save();

            notify()->success('You Have  updated Your Password successfully.');
            return back();

        }else{
            
            notify()->error('Incorrect Current Password, Please try again.');
            return back();
        }

    }

    public function dashbaord(){

        $month = date('m');

        $pg = "dashboard";
        $total_businesses = BusinessData::count();
        $total_personals = PersonalData::count();
        $total_users = User::count();
        $total_subscribers = $total_businesses + $total_personals;

        $graph_summary = [];

        $number_of_days = Carbon::now()->translatedFormat('d');
        // Don't forget to change my sql strict value to false.
        // app/Config/database.php

        $businessGraph = BusinessData::whereMonth('created_at', $month)
        ->selectRaw("Count(id) as total_businesses, DATE_FORMAT(created_at, '%b %d, %Y') as date, DATE_FORMAT(created_at, '%d') as day")
                            ->orderBy('created_at','asc')
                            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%b %d, %Y')"))
                            ->pluck('total_businesses', 'day');

        // dd($candidateGraph->keys());

        $personGraph = PersonalData::whereMonth('created_at', $month)->selectRaw("Count(id) as total_persons, DATE_FORMAT(created_at, '%b %d, %Y') as date , DATE_FORMAT(created_at, '%d') as day")
                                    ->orderBy('created_at','asc')
                                    ->groupBy(DB::raw("DATE_FORMAT(created_at, '%b %d, %Y')"))
                                    ->pluck('total_persons', 'day');

        //    dd($employerGraph->keys());

        for ($i=1; $i <= $number_of_days; $i++) { 

        $viewData = 0; 
        $personViewData = 0;
        $viewLabel = Carbon::now()->startOfMonth();

        foreach ($businessGraph->keys() as $key => $value) {

            if($value == $i){

                $viewData  = $businessGraph->values()[$key];
            }
        }


        foreach ($personGraph->keys() as $ky => $val) {

            if($val == $i){

                 $personViewData  = $personGraph->values()[$ky];

            }
        }


        if($i > 1){
            $numDay = $i - 1;
            $viewLabel = $viewLabel->addDays( $numDay );
        }


        array_push($graph_summary, [
            "graphLabel" => $viewLabel->translatedFormat('d M, Y '),
            "businessViewData" =>  $viewData,
            "personViewData" =>  $personViewData
        ]);

        }

        // dd($graph_summary);

        $graph_views_labels = [];
        $business_views_data = [];
        $person_views_data = [];

        foreach ($graph_summary as $key => $value) {

            $graph_views_labels[$key] = $value['graphLabel'];
            $business_views_data[$key] = $value['businessViewData'];
            $person_views_data[$key] = $value['personViewData'];

        }

        $chart = new DataChart;
        $chart->labels($graph_views_labels);
        
        $chart->dataset('Business Data', 'line', $business_views_data)
        ->color('#febe11')
        ->backgroundColor('#febe11');

        $chart->dataset('Person Data', 'line', $person_views_data)
        ->color('#141313')
        ->backgroundColor('#141313');;

        return view('admin.user.dashboard',compact(
            'pg',
            'total_businesses',
            'total_personals',
            'total_users',
            'total_subscribers',
            'chart'
        ));
    }

}
