<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

use App\Models\BlogCategory;

use App\Models\FAQ;

use App\Models\FAQCategory;

use App\Models\Testimonial;

use App\Models\Career;

use App\Models\Page;

use Newsletter;

class pagesController extends Controller
{

    public function index_page(){

        $faqs = FAQ::where('visibility','=','Public')
                ->where('publish','<',\Carbon\Carbon::now())
                ->where('featured','=','Yes')
                ->limit(5)->latest()->get();

        $testimonials = Testimonial::where('visibility','=','Public')
                        ->where('publish','<',\Carbon\Carbon::now())
                        ->where('featured','=','Yes')
                        ->limit(6)->latest()->get();

        return view('pages.index',compact('faqs','testimonials'));
    }

    public function about_page(){

        return view('pages.about');
    }

    public function blog_page(){

        $slug = 'all';

        $categories = BlogCategory::Where("parent",'=','0')
                            ->where('publish','=','Yes')
                            ->with('subCategories')
                            ->get();

        // $featuredBlogs = Blog::where('visibility','=','Public')
        //                 ->where('publish','<',\Carbon\Carbon::now())
        //                 ->where('featured','=','Yes')
        //                 ->with('categories')
        //                 ->limit(3)->latest()->get();
        

        $blogs = Blog::where('visibility','=','Public')
                ->where('publish','<',\Carbon\Carbon::now())
                ->with('categories')
                ->latest()
                ->paginate(25);

        return view('pages.blog',compact('categories','blogs','slug'));
    }


    public function blog_category_page($slug){

        $activeCategory = BlogCategory::Where("slug",'=',$slug)
                                     ->firstorfail();

        $subCategoriesIds = filterIdsObj($activeCategory,'subCategories');

        $categories = BlogCategory::Where("parent",'=','0')
                                ->where('publish','=','Yes')
                                ->with('subCategories')
                                ->get();

        $blogs = Blog::where('visibility','=','Public')
                ->where('publish','<',\Carbon\Carbon::now())
                ->with('categories')
                ->whereHas('categories', function ($query) use ($subCategoriesIds) {
                    $query->whereIN('blog_category_id', $subCategoriesIds);
                })
                ->latest()
                ->paginate(25);

        return view('pages.blog',compact('categories','blogs','slug'));
    }


    public function career_page(){

        $careers = Career::where('visibility','=','Public')
                        ->where('publish','<',\Carbon\Carbon::now())
                        ->where('close_date','>=',\Carbon\Carbon::now())
                        ->paginate('12');
        return view('pages.careers',compact('careers'));
    }


    public function single_career_page($id){

        $career = Career::where('visibility','=','Public')
                        ->where('publish','<',\Carbon\Carbon::now())
                        ->where('close_date','>=',\Carbon\Carbon::now())
                        ->where('id','=', $id)
                        ->firstorfail();
                        
        return view('pages.single-career',compact('career'));
    }


    public function feature_page(){

        return view('pages.features');
    }

    public function support_page(){

        $faqCategories = FAQCategory::where('publish','=','Yes')
                        ->get();

        return view('pages.faqs',compact('faqCategories'));
    }


    public function support_category_page($slug){

        $faqCategory = FAQCategory::WHERE('slug','=',$slug)
                ->with('faqs')
                ->firstorfail();
      

        $faqCategories = FAQCategory::where('publish','=','Yes')
                      ->get();
        
        return view('pages.single-faq',compact('faqCategory','faqCategories'));
    }


    public function support_search_page(){

        $keyword = "";

        if(isset($_GET['keyword'])){

            $keyword = $_GET['keyword'];

            $faqs = FAQ::WHERE('title','like', '%'.$keyword.'%')
                    ->orWHERE('content','like', '%'.$keyword.'%')
                    ->get();
         } else {


            $faqs = FAQ::paginate(50);

         }
        
        $faqCategories = FAQCategory::where('publish','=','Yes')
                    ->get();
        
        return view('pages.search-faq',compact('faqs','faqCategories','keyword'));

        
    }

  

    public function single_blog_page($slug){

        $blog = Blog::WHERE('slug','=',$slug)
                ->with('categories')
                ->firstorfail();

        $relatedBlog = Blog::where('visibility','=','Public')
                        ->where('publish','<',\Carbon\Carbon::now())
                        ->where('slug','!=',$slug)
                        ->with('categories')
                        ->limit('3')
                        ->latest()
                        ->get();

        return view('pages.single-blog',compact('blog','relatedBlog'));
    }

    public function single_page($slug){

        $page_record = Page::where('visibility','=','Public')
                        ->where('publish','<',\Carbon\Carbon::now())
                        ->where('slug','=',$slug)
                        ->firstorfail();
        

        return view('pages.page',compact('page_record'));
    }

    public function send_money_page(){

        return view('pages.send-money');
    }

    public function request_money_page(){

        return view('pages.request-money');
    }

    public function multicurrency_account_page(){

        return view('pages.multicurrency-account');
    }

    public function kyshi_cards_page(){

        return view('pages.kyshi-cards');
    }

    public function reward_deals_page(){

        return view('pages.reward-deals');
    }

    public function terms_of_service(){

        return view('pages.terms-of-service');
    }

    public function privacy_policy(){

        return view('pages.privacy-policy');
    }

    public function cookie_policy(){

        return view('pages.cookie-policy');
    }

    public function solid_dashboard(){

        return view('pages.solid-dashboard');
    }
    
    public function solid_privacy_policy(){

        return view('pages.solid-privacy-policy');
    }

    public function solid_terms_of_service(){

        return view('pages.solid-terms-of-service');
    }


    public function store_subscribe(Request $request)
    {
        if ( ! Newsletter::isSubscribed($request->email) ) {
            Newsletter::subscribe($request->email);
        }

        return "success";
    }

}