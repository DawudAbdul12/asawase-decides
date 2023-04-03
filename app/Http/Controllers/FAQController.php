<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FAQ;

use App\Models\FAQCategory;

class FAQController extends Controller
{
    public $thumbnailPath = '/asset-fag/thumbnail-images';


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

        $keyword = "";

        if(isset($_GET['keyword'])){

            $keyword = $_GET['keyword'];

            $faqs = FAQ::WHERE('title','like', '%'.$keyword.'%')
                    ->orWHERE('content','like', '%'.$keyword.'%')
                    ->paginate(50);
         } else {


            $faqs = FAQ::paginate(30);

         }
        
        $pg = "all_faqs";
        return view('admin.faq.all_faqs',compact('faqs','pg','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = FAQCategory::all();
        $pg = "add_faq";
        return view('admin.faq.add_faq',compact('categories','pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
            $results = FAQ::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title') ,$results ,$old_slug = null);

            if ($request->hasFile('thumbnail')) {
                    
                $image = $request->file('thumbnail');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->thumbnailPath);
                $image->move($destinationPath, $image_name);
                $this->thumbnailPath = $this->thumbnailPath."/".$image_name;
    
            }
        
            $faq = new FAQ;
            $faq->title = $request->input('title');
            $faq->slug =  $slug;
            $faq->content = $request->input('content');
            $faq->tag = $request->input('tag');
            $faq->visibility = $request->input('visibility');
            $faq->publish = $request->input('publish');
            $faq->featured = $request->input('featured');
            $faq->thumbnail = $this->thumbnailPath;

            $faq->save();
            $faq->categories()->syncWithoutDetaching($request->input('category'));

            notify()->success('You Have Added a New FAQ Successfully.');
            
                return redirect("/admin/faq");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = FAQ::where('id','=',$id)->with('categories')->first();
        $categories = FAQCategory::all();
        $pg = "edit_faq";
        return view('admin.faq.edit_faq',compact('faq','categories','pg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = FAQ::where('id','=',$id)->with('categories')->first();
        $categories = FAQCategory::all();
        $pg = "edit_faq";
        return view('admin.faq.edit_faq',compact('faq','categories','pg'));
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
            $faq = FAQ::find($id);

            $results = FAQ::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results, $faq->slug);

            if ($request->hasFile('thumbnail')) {
                    
                $image = $request->file('thumbnail');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->thumbnailPath);
                $image->move($destinationPath, $image_name);
                $this->thumbnailPath = $this->thumbnailPath."/".$image_name;

                $faq->thumbnail = $this->thumbnailPath;
    
            }

            $faq->title = $request->input('title');
            $faq->slug =  $slug;
            $faq->content = $request->input('content');
            $faq->tag = $request->input('tag');
            $faq->visibility = $request->input('visibility');
            $faq->publish = $request->input('publish');
            $faq->featured = $request->input('featured');

            $faq->save();

            $faq->categories()->syncWithoutDetaching($request->input('category'));

            notify()->success('You Have Updated a FAQ Successfully.');
           
            return redirect('/admin/faq/'.$faq->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQ::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return back();
    }
}
