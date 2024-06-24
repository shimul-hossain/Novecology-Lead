<?php

namespace App\Http\Controllers;

use App\Models\BackOffice\AuditEnergetique;
use App\Models\BackOffice\AuditEnergetiqueThirdBlockInfo;
use App\Models\BackOffice\BandeauInformation;
use App\Models\BackOffice\CookiePolicy;
use App\Models\BackOffice\DroitOpposition;
use App\Models\BackOffice\History;
use App\Models\BackOffice\HistoryThirdBlockInfo;
use App\Models\BackOffice\LegalNotice;
use App\Models\BackOffice\NewBanner;
use App\Models\BackOffice\NewContact;
use App\Models\BackOffice\News;
use App\Models\BackOffice\NewsInfo;
use App\Models\BackOffice\Offer;
use App\Models\BackOffice\OfferCategory;
use App\Models\BackOffice\PrivacyPolicy;
use App\Models\BackOffice\ReferenceGalleryCategory;
use App\Models\BackOffice\ReferenceInfo;
use App\Models\BackOffice\Renovation;
use App\Models\BackOffice\RenovationBlockInfo;
use App\Models\BackOffice\ServiceFeature;
use App\Models\BackOffice\Support;
use App\Models\BackOffice\SupportBlockInfo;
use App\Models\BackOffice\Testimonial;
use App\Models\BackOffice\TestimonialInfo;
use App\Models\BackOffice\Value;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $banners = NewBanner::orderBy('order', 'asc')->get();
        $features = ServiceFeature::all();
        $supports = Support::all();
        $support_info = SupportBlockInfo::first();
        $renovations = Renovation::all();
        $renovation_info = RenovationBlockInfo::first();
        $offer_categories = OfferCategory::all();
        $testimonial_info = TestimonialInfo::first();
        $testimonials = Testimonial::latest()->take('5')->get();
        $news_info = NewsInfo::first();
        $news = News::latest()->take('5')->get();

        return view('frontend.new.index', compact('banners', 'features', 'supports', 'support_info', 'renovations', 'renovation_info', 'offer_categories', 'testimonials', 'testimonial_info', 'news', 'news_info'));
    }

    public function auditEnergetique(){
        $testimonials = Testimonial::latest()->take('5')->get();
        $testimonial_info = TestimonialInfo::first();
        $item = AuditEnergetique::first();
        $infos = AuditEnergetiqueThirdBlockInfo::all();
        return view('frontend.new.audit-energetique', compact('testimonials', 'testimonial_info', 'item', 'infos'));
    }

    public function estimerVosAides(){
        return view('frontend.new.estimer-vos-aides');
    }

    public function nosConseils(){
        $news_info = NewsInfo::first();
        $news = News::all();
        return view('frontend.new.nos-conseils', compact('news_info', 'news'));
    }

    public function nosConseilsDetails($id){
        $news = News::find($id);
        if($news){
            return view('frontend.new.nos-conseils-details', compact('news'));
        }else{
            return back();
        }
    }

    public function nosOffres(){
        $categories = OfferCategory::all();
        return view('frontend.new.nos-offres', compact('categories'));
    }

    public function nosFffresDetails($id){
        
        $testimonials = Testimonial::latest()->take('5')->get();
        $testimonial_info = TestimonialInfo::first();

        $offer = Offer::find($id);
        if($offer){
            return view("frontend.new.nos-offres-details", compact('offer', 'testimonials', 'testimonial_info'));
        }else{
            return back();
        }
    }

    public function nosReferences(){
        $info = ReferenceInfo::first();
        $categories = ReferenceGalleryCategory::all();
        return view('frontend.new.nos-references', compact('info', 'categories'));
    }

    public function nosValeurs(){
        $value = Value::first();
        return view('frontend.new.nos-valeurs', compact('value'));
    }

    public function notreHistoire(){
        $history = History::first();
        $history_infos = HistoryThirdBlockInfo::all();
        return view('frontend.new.notre-histoire', compact('history', 'history_infos'));
    }

    public function nousContacter(){
        $contact = NewContact::first();
        return view('frontend.new.nous-contacter', compact('contact'));
    }

    public function prendreRdv(){
        return view('frontend.new.prendre-rdv');
    }

    public function temoignagesClients(){
        $info = TestimonialInfo::first();
        $testimonials = Testimonial::latest()->get(); 
        return view('frontend.new.temoignages-clients', compact('info', 'testimonials'));
    }

    public function droitOpposition(){
        $item = DroitOpposition::first();
        return view('frontend.new.droit-opposition', compact('item'));
    }

    public function cookiePolicy(){
        $item = CookiePolicy::first();
        return view('frontend.new.cookie-policy', compact('item'));
    }

    public function legalNotice(){
        $item = LegalNotice::first();
        return view('frontend.new.legal-notice', compact('item'));
    }

    public function privacyPolicy(){
        $item = PrivacyPolicy::first();
        return view('frontend.new.privacy-policy', compact('item'));
    }
    public function bandeauInformation(){
        $item = BandeauInformation::first();
        return view('frontend.new.bandeau-information', compact('item'));
    }
}
