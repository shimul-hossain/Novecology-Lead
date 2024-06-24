<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\AdviceAndGrants;
use App\Models\AdviceDetail;
use App\Models\AdviceFaq;
use App\Models\AdviceReason;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\ContactUs;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\GrantCategory;
use App\Models\OurService;
use App\Models\OurSocieteLogo;
use App\Models\OurSociety;
use App\Models\OurSolution;
use App\Models\OurSolutionDetails;
use App\Models\Pages;
use App\Models\SimulateProject;
use App\Models\SolutionResons;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $ourSolution = OurSolution::latest()->get();
        $advices = AdviceAndGrants::latest()->get();
        $travauxs = BaremeTravauxTag::all();
        return view('frontend.index',compact('advices','ourSolution','advices', 'travauxs'));
    }

    public function testimonial(){
        return view('frontend.testimonial');
    }


    public function ourSolutionDetails($id)
    {
        $solutions = OurSolution::find($id);
        $details   = OurSolutionDetails::where('solution_id',$id)->get();
        $ourSolution = OurSolution::get();
        $oursolutionReason = SolutionResons::where('our_solutions_id',$id)->get();
        return view('frontend.our_solution_details',compact('solutions','details','ourSolution','oursolutionReason'));

    }

    public function ourSolution(){

        $ourSolution_particular = OurSolution::where('category', 'Particular')->latest()->get();
        $ourSolution_professional = OurSolution::where('category', 'Professional')->latest()->get();
        return view('frontend.our_solution',compact('ourSolution_particular','ourSolution_professional'));

    }

    public function adviceGrants(){

        $advices = AdviceAndGrants::get();
        $categories = GrantCategory::latest()->get();
        return view('frontend.advice_&_grants',compact('advices','categories'));

    }

    public function adviceDetails($id){

        $detail = AdviceAndGrants::find($id);
        $adviceFaq = AdviceFaq::where('advice_id',$id)->get();
        $advices = AdviceAndGrants::get();
        return view('frontend.advice_&_grants_details',compact('detail','advices','adviceFaq'));

    }



    //Our Solution Section
    public function ourSociety(){

        $ourSociety = OurSociety::orderBy('created_at','ASC')->get();

        $logo = OurSocieteLogo::first();

        return view('frontend.our_society',compact('ourSociety','logo'));

    }


    //contact

    public function contact(Request $request){
        $request->validate([
            'first_name'  => 'required',
            'second_name' => 'required',
            'email'       => 'required',
            'phone'       => 'required',
            'postal_code' => 'required',
        ],[
            'first_name.required'   => __('First name is required'),
            'second_name.required'  => __('Second name is required'),
            'email.required'        => __('Email is required'),
            'phone.required'        => __('Phone is required'),
            'postal_code.required'  => __('Postal code is required'),
        ]);

        $data = Contact::create($request->except('_token') + ['created_at' => Carbon::now()]);

        return back()->with('success', __('Send Email Successesfully'));
    }

    //simulate project
    public function simulateProject(Request $request){
        $request->validate([
            'first_name'  => 'required',
            'second_name' => 'required',
            'email'       => 'required',
            'phone'       => 'required',
            'address'     => 'required',
            'postal_code' => 'required',
        ],[
            'first_name.required'   => __('First name is required'),
            'second_name.required'  => __('Second name is required'),
            'email.required'        => __('Email is required'),
            'phone.required'        => __('Phone is required'),
            'address.required'      => __('Address is required'),
            'postal_code.required'  => __('Postal code is required'),
        ]);

        $data = SimulateProject::create($request->except('_token') + ['created_at' => Carbon::now()]);

        return redirect()->route('frontend.home')->with('success', __('Send Email Successesfully'));
    }


    //our service
    public function ourService()
    {
        $ourService = OurService::latest()->get();

        return view('frontend.our-service',compact('ourService'));
    }

    //our service
    public function ourContact()
    {

        $contactUs = ContactUs::first();

        return view('frontend.contact',compact('contactUs'));
    }



    //Custom Pages
    public function morePage($slug)
    {
       $page = Pages::where('slug',$slug)->firstOrFail();

      return view('frontend.extra_page',compact('page'));
    }

    public function userDeactive(){
        return view('admin.deactive');
    }


}
