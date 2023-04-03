<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogCategory;

class blogCategoryController extends Controller
{
    public $imagePath = '/asset-resources/blog-Category-images';
    
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
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "category";
        return view('admin.blog.category.add_categories',
        compact('parentCategories','pg')
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "category";
        return view('admin.blog.category.add_categories',
        compact('parentCategories','pg')
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
                'parent' => ['required', 'integer'],
                'publish' => ['required', 'string'],
            ]);

            $results = Blogcategory::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results, $old_slug = null);
            
            if ($request->hasFile('img')) {
                
                $image = $request->file('img');
                $image_name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->imagePath);
                $image->move($destinationPath, $image_name);
                $this->imagePath = $this->imagePath."/".$image_name;

            }else{

                $this->imagePath = "";

            }

            $blogCategory = new BlogCategory();
            $blogCategory->title = $request->input('title');
            $blogCategory->slug = $slug;
            $blogCategory->parent = $request->input('parent');
            $blogCategory->publish = $request->input('publish');
            $blogCategory->content = $request->input('content');
            $blogCategory->image = $this->imagePath;

            // SAVE
            $blogCategory->save();

            notify()->success('You Have Successfully Added a New Category');

            return redirect("/admin/blog/category");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $category = BlogCategory::find($id);
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "category";
        return view('admin.blog.category.edit_category',
        compact('category','parentCategories','pg')
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
        $category = BlogCategory::find($id);
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "category";
        return view('admin.blog.category.edit_category',
        compact('category','parentCategories','pg')
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
            'parent' => ['required', 'integer'],
            'publish' => ['required', 'string'],
        ]);

        $blogCategory =  BlogCategory::find($id);
        $results = Blogcategory::WHERE('title', $request->input('title'))->get();
        $slug = checker_slug($request->input('title'), $results, $blogCategory->slug);
        
        if ($request->hasFile('img')) {
            
            $image = $request->file('img');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($this->imagePath);
            $image->move($destinationPath, $image_name);
            $this->imagePath = $this->imagePath."/".$image_name;

        }else{

            $this->imagePath = "";

        }

        $blogCategory->title = $request->input('title');
        $blogCategory->slug = $slug;
        $blogCategory->parent = $request->input('parent');
        $blogCategory->publish = $request->input('publish');
        $blogCategory->content = $request->input('content');
        $blogCategory->image = $this->imagePath;

        // SAVE
        $blogCategory->save();

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
        $category = BlogCategory::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return redirect("/admin/blog/category");
    }
}
