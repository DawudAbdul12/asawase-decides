<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;


class pageController extends Controller
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
        $pages = Page::paginate(30);
        $pg = "all_pages";
        return view('admin.pages.all_pages',compact('pages','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pg = "add_page";
        return view('admin.pages.add_page',compact('pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
            $results = Page::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title') ,$results , $old_slug = null);
        
            $page = new Page;
            $page->title = $request->input('title');
            $page->slug = $slug;
            $page->content = $request->input('content');
            $page->tag = $request->input('tag');
            $page->visibility = $request->input('visibility');
            $page->publish = $request->input('publish');

            $page->save();

            notify()->success('You Have Added a New Page Successfully.');
            
            return redirect("/admin/page");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        $pg = "edit_page";
        return view('admin.pages.edit_page',compact('page','pg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $pg = "edit_page";
        return view('admin.pages.edit_page',compact('page','pg'));
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

            $page = Page::find($id);

            $results = Page::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results, $page->slug);
            
            $page->title = $request->input('title');
            $page->slug = $slug;
            $page->content = $request->input('content');
            $page->tag = $request->input('tag');
            $page->visibility = $request->input('visibility');
            $page->publish = $request->input('publish');

            $page->save();

            notify()->success("You Have Updated a Page Successfully.");
           
            return redirect('/admin/page/'.$page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return back();
    }
}
