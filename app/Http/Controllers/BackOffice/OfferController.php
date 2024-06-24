<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\BackOffice\Offer;
use App\Models\BackOffice\OfferBannerService;
use App\Models\BackOffice\OfferCategory;
use App\Models\BackOffice\OfferFifthBlockInfo;
use App\Models\BackOffice\OfferSixthBlockInfo;
use App\Models\BackOffice\OfferThirdBlockInfo;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index(){
        $offers = Offer::all();
        return view('backoffice.offers.index', compact('offers'));
    }

    public function create(){
        $categories = OfferCategory::all();
        return view('backoffice.offers.create', compact('categories'));
    }
    public function store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'icon' => 'required|image',
            'feature_image' => 'required|image',
            'banner_image' => 'required|image',
            'title' => 'required',
            'subtitle' => 'required',
            'home_page_button_text' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'banner_button_text' => 'required', 
        ]); 
        // dd($request->all());
        $path = public_path('uploads/new/offer');
        $offer = new Offer();
        $offer->category_id = $request->category_id;
        $offer->title = $request->title;
        $offer->subtitle = $request->subtitle;
        $offer->home_page_button_text = $request->home_page_button_text;
        $offer->short_description = $request->short_description;
        $offer->long_description = $request->long_description;
        $offer->banner_button_text = $request->banner_button_text;
        $offer->banner_button_link = $request->banner_button_link;
        $offer->first_block_status = $request->first_block_status ? 'yes':'no'; 
        $offer->save();

        if($request->first_block_status){
            $offer->first_block_title = $request->first_block_title;
            $offer->first_block_desciption = $request->first_block_desciption;
            // $offer->first_block_button_text = $request->first_block_button_text;
            // $offer->first_block_button_link = $request->first_block_button_link;
            if($request->file('first_block_image')){
                $first_block_image = $request->file('first_block_image'); 
                $firstBlockName = 'first_block-'.$offer->id.rand(0000000000,9999999999).'.'.$first_block_image->extension();
                $first_block_image->move($path, $firstBlockName);
                $offer->first_block_image = $firstBlockName;
            }
        }
        $offer->second_block_status = $request->second_block_status ? 'yes':'no';
        if($request->second_block_status){
            $offer->second_block_title = $request->second_block_title;
            $offer->second_block_desciption = $request->second_block_desciption;
            // $offer->second_block_button_text = $request->second_block_button_text;
            // $offer->second_block_button_link = $request->second_block_button_link;
            if($request->file('second_block_image')){
                $second_block_image = $request->file('second_block_image'); 
                $secondBlockName = 'second_block-'.$offer->id.rand(0000000000,9999999999).'.'.$second_block_image->extension();
                $second_block_image->move($path, $secondBlockName);
                $offer->second_block_image = $secondBlockName;
            }
        }
        $offer->third_block_status = $request->third_block_status ? 'yes':'no';
        if($request->third_block_status){
            $offer->third_block_title = $request->third_block_title; 
            foreach($request->third__title as $key => $third_value){
                $third_block = OfferThirdBlockInfo::create([
                    'offer_id' => $offer->id,
                    'title' => $third_value,
                    'image' => 'image.jpg',
                    'description' => $request->third__description[$key] ?? '',
                ]);
                if($request->file('third__image')[$key]){
                    $image = $request->file('third__image')[$key]; 
                    $thirdImage = 'third__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $thirdImage);
                    $third_block->image = $thirdImage;
                    $third_block->save();
                }
            } 
        }
        $offer->fourth_block_status = $request->fourth_block_status ? 'yes':'no';
        if($request->fourth_block_status){
            $offer->fourth_block_title = $request->fourth_block_title;
            $offer->fourth_block_desciption = $request->fourth_block_desciption;
            // $offer->fourth_block_button_text = $request->fourth_block_button_text;
            // $offer->fourth_block_button_link = $request->fourth_block_button_link;
            if($request->file('fourth_block_image')){
                $fourth_block_image = $request->file('fourth_block_image'); 
                $fourthBlockName = 'fourth_block-'.$offer->id.rand(0000000000,9999999999).'.'.$fourth_block_image->extension();
                $fourth_block_image->move($path, $fourthBlockName);
                $offer->fourth_block_image = $fourthBlockName;
            }
        }

        $offer->fifth_block_status = $request->fifth_block_status ? 'yes':'no';
        if($request->fifth_block_status){
            $offer->fifth_block_title = $request->fifth_block_title; 
            $offer->fifth_block_description = $request->fifth_block_description; 
            foreach($request->fifth__title as $key => $fifth_value){
                $fifth_block = OfferFifthBlockInfo::create([
                    'offer_id' => $offer->id,
                    'title' => $fifth_value,
                    'image' => 'image.jpg',
                    'description' => $request->fifth__description[$key] ?? '',
                ]);
                if($request->file('fifth__image')[$key]){
                    $image = $request->file('fifth__image')[$key]; 
                    $fifthImage = 'fifth__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $fifthImage);
                    $fifth_block->image = $fifthImage;
                    $fifth_block->save();
                }
            } 
        }
        // dd($request->sixth__title);
        $offer->sixth_block_status = $request->sixth_block_status ? 'yes':'no';
        if($request->sixth_block_status){
            $offer->sixth_block_title = $request->sixth_block_title; 
            foreach($request->sixth__title as $key => $sixth_value){
                $sixth_block = OfferSixthBlockInfo::create([
                    'offer_id' => $offer->id,
                    'title' => $sixth_value,
                    'image' => 'image.jpg',
                    'description' => $request->sixth__description[$key] ?? '',
                ]);
                if($request->file('sixth__image')[$key]){
                    $image = $request->file('sixth__image')[$key]; 
                    $sixthImage = 'sixth__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $sixthImage);
                    $sixth_block->image = $sixthImage;
                    $sixth_block->save();
                }
            } 
        }


        $icon_image = $request->file('icon'); 
        $iconName = 'icon-'.$offer->id.rand(0000000000,9999999999).'.'.$icon_image->extension();
        $icon_image->move($path, $iconName);
        $offer->icon = $iconName;

        $feature_image = $request->file('feature_image'); 
        $featureName = 'feature-'.$offer->id.rand(0000000000,9999999999).'.'.$feature_image->extension();
        $feature_image->move($path, $featureName);
        $offer->feature_image = $featureName;

        $banner_image = $request->file('banner_image'); 
        $bannerName = 'banner-'.$offer->id.rand(0000000000,9999999999).'.'.$banner_image->extension();
        $banner_image->move($path, $bannerName);
        $offer->banner_image = $bannerName;
        
        $offer->save();
        if($request->banner_service){
            foreach ($request->banner_service as $service){
                OfferBannerService::create([
                    'offer_id' => $offer->id,
                    'name'     => $service,
                ]);
            }
        }

        return redirect()->route('backoffice.offer.index')->with('success', 'Créé avec succès');
    }

    public function edit($id){
        $categories = OfferCategory::all();
        $offer = Offer::find($id);
        if($offer){
            return view('backoffice.offers.edit', compact('categories', 'offer'));
        }else{
            return back();
        }
    }

    public function update(Request $request){
        $request->validate([
            'category_id' => 'required',
            'icon' => 'image',
            'feature_image' => 'image',
            'banner_image' => 'image',
            'title' => 'required',
            'subtitle' => 'required',
            'home_page_button_text' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'banner_button_text' => 'required', 
        ]);
        // dd($request->all());

        $path = public_path('uploads/new/offer');
        $offer = Offer::find($request->id);
        $offer->category_id = $request->category_id;
        $offer->title = $request->title;
        $offer->subtitle = $request->subtitle;
        $offer->home_page_button_text = $request->home_page_button_text;
        $offer->short_description = $request->short_description;
        $offer->long_description = $request->long_description;
        $offer->banner_button_text = $request->banner_button_text;
        $offer->banner_button_link = $request->banner_button_link;
        $offer->first_block_status = $request->first_block_status ? 'yes':'no';
        if($request->first_block_status){
            $offer->first_block_title = $request->first_block_title;
            $offer->first_block_desciption = $request->first_block_desciption;
            // $offer->first_block_button_text = $request->first_block_button_text;
            // $offer->first_block_button_link = $request->first_block_button_link;
            if($request->file('first_block_image')){
                $first_block_image = $request->file('first_block_image'); 
                $firstBlockName = 'first_block-'.$offer->id.rand(0000000000,9999999999).'.'.$first_block_image->extension();
                $first_block_image->move($path, $firstBlockName);
                $offer->first_block_image = $firstBlockName;
            }
        }
        $offer->second_block_status = $request->second_block_status ? 'yes':'no';
        if($request->second_block_status){
            $offer->second_block_title = $request->second_block_title;
            $offer->second_block_desciption = $request->second_block_desciption;
            // $offer->second_block_button_text = $request->second_block_button_text;
            // $offer->second_block_button_link = $request->second_block_button_link;
            if($request->file('second_block_image')){
                $second_block_image = $request->file('second_block_image'); 
                $secondBlockName = 'second_block-'.$offer->id.rand(0000000000,9999999999).'.'.$second_block_image->extension();
                $second_block_image->move($path, $secondBlockName);
                $offer->second_block_image = $secondBlockName;
            }
        }
        $offer->third_block_status = $request->third_block_status ? 'yes':'no';
        if($request->third_block_status){
            $offer->third_block_title = $request->third_block_title; 
            if($request->x_third_block_id){
                OfferThirdBlockInfo::where('offer_id', $offer->id)->whereNotIn('id', $request->x_third_block_id)->get()->each->delete();
            }
            foreach($request->third__title as $key => $third_value){
                $third_block = OfferThirdBlockInfo::where('offer_id', $offer->id)->where('id', $key)->first();
                if($third_block){
                    $third_block->update([
                        'title' => $third_value, 
                        'description' => $request->third__description[$key] ?? '',
                    ]);
                }else{
                    $third_block = OfferThirdBlockInfo::create([
                        'offer_id' => $offer->id,
                        'title' => $third_value,
                        'image' => 'image.jpg',
                        'description' => $request->third__description[$key] ?? '',
                    ]);
                } 
                if(isset($request->file('third__image')[$key])){
                    $image = $request->file('third__image')[$key]; 
                    $thirdImage = 'third__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $thirdImage);
                    $third_block->image = $thirdImage;
                    $third_block->save();
                }
            } 
        }

        $offer->fourth_block_status = $request->fourth_block_status ? 'yes':'no';
        if($request->fourth_block_status){
            $offer->fourth_block_title = $request->fourth_block_title;
            $offer->fourth_block_desciption = $request->fourth_block_desciption;
            // $offer->fourth_block_button_text = $request->fourth_block_button_text;
            // $offer->fourth_block_button_link = $request->fourth_block_button_link;
            if($request->file('fourth_block_image')){
                $fourth_block_image = $request->file('fourth_block_image'); 
                $fourthBlockName = 'fourth_block-'.$offer->id.rand(0000000000,9999999999).'.'.$fourth_block_image->extension();
                $fourth_block_image->move($path, $fourthBlockName);
                $offer->fourth_block_image = $fourthBlockName;
            }
        }

        $offer->fifth_block_status = $request->fifth_block_status ? 'yes':'no';
        if($request->fifth_block_status){
            $offer->fifth_block_title = $request->fifth_block_title; 
            $offer->fifth_block_description = $request->fifth_block_description; 
            if($request->x_fifth_block_id){
                OfferFifthBlockInfo::where('offer_id', $offer->id)->whereNotIn('id', $request->x_fifth_block_id)->get()->each->delete();
            }
            foreach($request->fifth__title as $key => $fifth_value){
                $fifth_block = OfferFifthBlockInfo::where('offer_id', $offer->id)->where('id', $key)->first();
                if($fifth_block){
                    $fifth_block->update([
                        'title' => $fifth_value, 
                        'description' => $request->fifth__description[$key] ?? '',
                    ]);
                }else{
                    $fifth_block = OfferFifthBlockInfo::create([
                        'offer_id' => $offer->id,
                        'title' => $fifth_value,
                        'image' => 'image.jpg',
                        'description' => $request->fifth__description[$key] ?? '',
                    ]);
                } 
                if(isset($request->file('fifth__image')[$key])){
                    $image = $request->file('fifth__image')[$key]; 
                    $fifthImage = 'fifth__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $fifthImage);
                    $fifth_block->image = $fifthImage;
                    $fifth_block->save();
                }
            } 
        }
        $offer->sixth_block_status = $request->sixth_block_status ? 'yes':'no';
        if($request->sixth_block_status){
            $offer->sixth_block_title = $request->sixth_block_title; 
            if($request->x_sixth_block_id){
                OffersixthBlockInfo::where('offer_id', $offer->id)->whereNotIn('id', $request->x_sixth_block_id)->get()->each->delete();
            }
            foreach($request->sixth__title as $key => $sixth_value){
                $sixth_block = OffersixthBlockInfo::where('offer_id', $offer->id)->where('id', $key)->first();
                if($sixth_block){
                    $sixth_block->update([
                        'title' => $sixth_value, 
                        'description' => $request->sixth__description[$key] ?? '',
                    ]);
                }else{
                    $sixth_block = OffersixthBlockInfo::create([
                        'offer_id' => $offer->id,
                        'title' => $sixth_value,
                        'image' => 'image.jpg',
                        'description' => $request->sixth__description[$key] ?? '',
                    ]);
                } 
                if(isset($request->file('sixth__image')[$key])){
                    $image = $request->file('sixth__image')[$key]; 
                    $sixthImage = 'sixth__image-'.$offer->id.rand(0000000000,9999999999).'.'.$image->extension();
                    $image->move($path, $sixthImage);
                    $sixth_block->image = $sixthImage;
                    $sixth_block->save();
                }
            } 
        }
         $offer->save();

        if($request->file('icon')){
            $icon_image = $request->file('icon'); 
            $iconName = 'icon-'.$offer->id.rand(0000000000,9999999999).'.'.$icon_image->extension();
            $icon_image->move($path, $iconName);
            $offer->icon = $iconName;
        }

        if($request->file('feature_image')){
            $feature_image = $request->file('feature_image'); 
            $featureName = 'feature-'.$offer->id.rand(0000000000,9999999999).'.'.$feature_image->extension();
            $feature_image->move($path, $featureName);
            $offer->feature_image = $featureName;
        }
        if($request->file('banner_image')){
            $banner_image = $request->file('banner_image'); 
            $bannerName = 'banner-'.$offer->id.rand(0000000000,9999999999).'.'.$banner_image->extension();
            $banner_image->move($path, $bannerName);
            $offer->banner_image = $bannerName;
        }
        
        $offer->save();
        if($request->x_service_id){
            OfferBannerService::where('offer_id', $offer->id)->whereNotIn('id', $request->x_service_id)->get()->each->delete();
        }
        if($request->banner_service){
            foreach ($request->banner_service as $key => $service){
                $x_service = OfferBannerService::where('offer_id', $offer->id)->where('id', $key)->first();
                if($x_service){
                    $x_service->update([
                        'name'     => $service,
                    ]);
                }else{
                    OfferBannerService::create([
                        'offer_id' => $offer->id,
                        'name'     => $service,
                    ]);
                }
            }
        }

        return redirect()->route('backoffice.offer.index')->with('success', 'Mis à jour avec succés');
    }

    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if($offer){
            $offer->bannerService->each->delete();
            $offer->thirdBlockInfo->each->delete();
            $offer->fifthBlockInfo->each->delete();
            $offer->sixthBlockInfo->each->delete();
            $offer->delete();
        }

        return back()->with('success', 'Supprimé avec succès');
    }


    public function category(){
        $categories = OfferCategory::all();
        return view('backoffice.offers.category', compact('categories'));
    }

    public function categoryStore(Request $request){
        $request->validate([
            'title' => 'required',
            'logo' => 'required|image',
        ]);
        $category = OfferCategory::create($request->except('_token'));
        
        $logo = $request->file('logo');
        $logoName = $category->id.rand(0000000000,9999999999).'-logo.'.$logo->extension();
        $logo->move(public_path('uploads/new/offer'), $logoName);
        $category->logo = $logoName;
        $category->save(); 

        return back()->with('success', 'Créé avec succès');
    }

    public function categoryUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'logo' => 'image',
        ]);
        $category = OfferCategory::find($request->id);
        $category->update($request->except('_token'));
        
        if($request->file('logo')){
            $logo = $request->file('logo');
            $logoName = $category->id.rand(0000000000,9999999999).'-logo.'.$logo->extension();
            $logo->move(public_path('uploads/new/offer'), $logoName);
            $category->logo = $logoName;
            $category->save(); 
        }

        return back()->with('success', 'Mis à jour avec succés');
    }
    public function categoryDelete(Request $request){
        
        $category = OfferCategory::find($request->id); 

        if($category){
            $category->delete();
        }
        
         
        return back()->with('success', 'Supprimé avec succès');
    }
}
