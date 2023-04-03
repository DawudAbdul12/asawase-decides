<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

use App\Models\BlogCategory;

use Mtownsend\ReadTime\ReadTime;

class blogController extends Controller
{

    public $imagePath = '/asset-resources/blog-images';
    public $thumbnailPath = '/asset-resources/blog-images';

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
        $blogs = Blog::paginate(10);
        $pg = "all_blogs";
        return view('admin.blog.all_blogs',compact('blogs','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "add_blog";
        return view('admin.blog.add_blog',compact('parentCategories','pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
            // SLUG
            // To check whether two pieces of content with the same title.
                $results = Blog::WHERE('title', $request->input('title'))->get();
                $slug = checker_slug($request->input('title'),$results ,$old_slug = null);
            // END OF SLUG

            // IMAGE PROCESSOR
                if ($request->hasFile('banner')) {
                        
                    $image = $request->file('banner');
                    $image_name = $slug.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path($this->imagePath);
                    $image->move($destinationPath, $image_name);
                    $this->imagePath = $this->imagePath."/".$image_name;
        
                }else{

                    $this->imagePath = "";
                }


                if ($request->hasFile('thumbnail')) {
                        
                    $image = $request->file('thumbnail');
                    $image_name = $slug.'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path($this->thumbnailPath);
                    $image->move($destinationPath, $image_name);
                    $this->thumbnailPath = $this->thumbnailPath."/".$image_name;
        
                }else{

                    $this->thumbnailPath = "";
                }
        
           // END  IMAGE PROCESSOR
            
            //BING PARAM

                $blog = new Blog;
                $blog->title = $request->input('title');
                $blog->slug =  $slug;
                $blog->type = $request->input('type');
                $blog->video = $request->input('video');
                $blog->content = $request->input('content');
                $blog->banner =  $this->imagePath;
                $blog->thumbnail =  $this->thumbnailPath;
                $blog->tag = $request->input('tag');
                $blog->visibility = $request->input('visibility');
                $blog->publish = $request->input('publish');
                $blog->featured = $request->input('featured');
                $blog->top_article = $request->input('top_article');
                $blog->author = $request->input('author');
                $blog->read_time = (new ReadTime($request->input('content')))->get();

            //END BING PARAM

            // SAVE
                $blog->save();
                $blog->categories()->sync($request->input('category'));

                notify()->success('You Have Added a New Blog Successfully.');
               
                return redirect("/admin/blog");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::where('id','=',$id)->with('categories')->first();
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "edit_blog";
        return view('admin.blog.edit_blog',compact('blog','parentCategories','pg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id','=',$id)->with('categories')->first();
        //dd($blog);
        $parentCategories = BlogCategory::Where("parent",'=','0')->with('subCategories')->get();
        $pg = "edit_blog";
        return view('admin.blog.edit_blog',compact('blog','parentCategories','pg'));
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
            $blog = Blog::find($id);
        // SLUG
            // To check whether two pieces of content with the same title.
            $results = Blog::WHERE('title', $request->input('title'))->get();
            $slug = checker_slug($request->input('title'), $results ,$blog->slug);
        // END OF SLUG

        // IMAGE PROCESSOR
            if ($request->hasFile('banner')) {
                    
                $image = $request->file('banner');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->imagePath);
                $image->move($destinationPath, $image_name);
                $this->imagePath = $this->imagePath."/".$image_name;

                $blog->banner = $this->imagePath;
    
            }


            if ($request->hasFile('thumbnail')) {
                    
                $image = $request->file('thumbnail');
                $image_name = $slug.'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path($this->thumbnailPath);
                $image->move($destinationPath, $image_name);
                $this->thumbnailPath = $this->thumbnailPath."/".$image_name;

                $blog->thumbnail = $this->thumbnailPath;
    
            }

       // END  IMAGE PROCESSOR
        
        //BING PARAM
            $blog->title = $request->input('title');
            $blog->slug =  $slug;
            $blog->type = $request->input('type');
            $blog->video = $request->input('video');
            $blog->content = $request->input('content');
            $blog->tag = $request->input('tag');
            $blog->visibility = $request->input('visibility');
            $blog->publish = $request->input('publish');
            $blog->featured = $request->input('featured');
            $blog->top_article = $request->input('top_article');
            $blog->author = $request->input('author');
            $blog->read_time = (new ReadTime($request->input('content')))->get();
            
        //END BING PARAM

        // SAVE
            $blog->save();
            $blog->categories()->sync($request->input('category'));

            notify()->success('You Have Updated a Blog Successfully.');
           
            return redirect('/admin/blog/'.$blog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return back();
    }
}
