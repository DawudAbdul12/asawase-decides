<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FAQ;

use App\Models\FAQCountry;


class FAQCountryController extends Controller
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
        $faqCountries = FAQCountry::with('faq')->paginate(30);
        $pg = "all_faq_country";
        return view('admin.faq-country.all_faq_countries',compact('faqCountries','pg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqs = FAQ::all();
        $pg = "add_faq_country";
        return view('admin.faq-country.add_faq_country',compact('faqs','pg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $faq = new FAQCountry;
        $faq->country = $request->input('country');
        $faq->content = $request->input('content');
        $faq->visibility = $request->input('visibility');
        $faq->faq_id = $request->input('faq_id');
        $faq->save();

        notify()->success('You Have Added a New FAQ Successfully.');
        
        return redirect("/admin/faq/country");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faqCountry = FAQCountry::where('id','=',$id)->with('faq')->first();
        $faqs = FAQ::all();
        $pg = "edit_faq_country";
        return view('admin.faq-country.edit_faq_country',compact('faqCountry','faqs','pg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faqCountry = FAQCountry::where('id','=',$id)->with('faq')->first();
        $faqs = FAQ::all();
        $pg = "edit_faq_country";
        return view('admin.faq-country.edit_faq_country',compact('faqCountry','faqs','pg'));
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
        $faq = FAQCountry::find($id);
        $faq->country = $request->input('country');
        $faq->content = $request->input('content');
        $faq->visibility = $request->input('visibility');
        $faq->faq_id = $request->input('faq_id');

        $faq->save();

        notify()->success('You Have Updated a FAQ Successfully.');
       
        return redirect('/admin/faq/country/'.$faq->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQCountry::find($id)->delete();
        notify()->success('Deleted Successfully.');
        return back();
    }
}
