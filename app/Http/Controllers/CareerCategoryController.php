<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CareerCategory;

class CareerCategoryController extends Controller
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
        //
        $categories = CareerCategory::all();
        $pg = "career-category";
        return view('admin.career.category.add_categories',
        compact('categories','pg')
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CareerCategory::all();
        $pg = "career-category";
        return view('admin.career.category.add_categories',
        compact('categories','pg')
        );
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
                'title' => ['required', 'string', 'max:255'],
                'publish' => ['required', 'string'],
            ]);

            $results = CareerCategory::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results , $old_slug = null);

            $category = new CareerCategory();
            $category->title = $request->input('title');
            $category->slug = $slug;
            $category->publish = $request->input('publish');
            $category->content = $request->input('content');

            // SAVE
            $category->save();

            notify()->success('You Have Successfully Added a New Category');

            return redirect("/admin/career/category");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $category = CareerCategory::find($id);
        $categories = CareerCategory::all();
        $pg = "career-category";
        return view('admin.career.category.edit_category',
        compact('category','categories','pg')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CareerCategory::find($id);
        $categories = CareerCategory::all();
        $pg = "career-category";
        return view('admin.career.category.edit_category',
        compact('category','categories','pg')
        );
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
            'title' => ['required', 'string', 'max:255'],
            'publish' => ['required', 'string'],
        ]);

        $category =  CareerCategory::find($id);
        $results = CareerCategory::WHERE('title', $request->input('title'))->get();
        $slug = checker_slug($request->input('title'),$results , $category->slug );
    
        $category->title = $request->input('title');
        $category->slug = $slug;
        $category->publish = $request->input('publish');
        $category->content = $request->input('content');
       
        // SAVE
        $category->save();

        notify()->success('You Have Successfully Updated the Category');

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
        $category = CareerCategory::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return redirect("/admin/career/category");
    }
}
