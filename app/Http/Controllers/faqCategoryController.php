<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FAQCategory;

class faqCategoryController extends Controller
{

    public $imagePath = '/asset-resources/faq-category-images';
    
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
        $categories = FAQCategory::all();
        $pg = "faqcategory";
        return view('admin.faq.category.add_categories',
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
        $categories = FAQCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "faqcategory";
        return view('admin.faq.category.add_categories',
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

            $results = FAQCategory::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results , $old_slug = null);


            if ($request->hasFile('icon')) {
                        
                $image = $request->file('icon');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->imagePath);
                $image->move($destinationPath, $image_name);
                $this->imagePath = $this->imagePath."/".$image_name;
    
            }else{

                $this->imagePath = "";
            }
            

            $category = new FAQCategory();
            $category->title = $request->input('title');
            $category->slug = $slug;
            $category->publish = $request->input('publish');
            $category->content = $request->input('content');
            $category->icon = $this->imagePath;

            // SAVE
            $category->save();

            notify()->success('You Have Successfully Added a New Category');

            return redirect("/admin/faq/category");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $category = FAQCategory::find($id);
        $categories = FAQCategory::all();
        $pg = "faqcategory";
        return view('admin.faq.category.edit_category',
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
        $category = FAQCategory::find($id);
        $categories = FAQCategory::all();
        $pg = "faqcategory";
        return view('admin.faq.category.edit_category',
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

        $category =  FAQCategory::find($id);
        $results = FAQCategory::WHERE('title', $request->input('title'))->get();
        $slug = checker_slug($request->input('title'),$results , $category->slug );

        if ($request->hasFile('icon')) {
                        
            $image = $request->file('icon');
            $image_name = $slug.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;

            $category->icon = $this->imagePath;

        }else{

            $this->imagePath = "";
        }
    
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
        $category = FAQCategory::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return redirect("/admin/faq/category");
    }
}
