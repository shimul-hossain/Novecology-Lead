<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\Benefit;
use App\Models\CRM\Category;
use App\Models\CRM\Product;
use App\Models\CRM\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productStore(Request $request){
        $request->validate([
            // 'acermi_file' => 'file',
            // 'certita_file' => 'file',
            // 'notice_file' => 'file',
            'data_file' => 'file',
        ]); 

        $product = Product::create($request->except(['_token', 'baremes', 'tags', 'prestation_id', 'projet_status', 'stock_status']));

        $product->projet_status = $request->projet_status ? 'yes':'no';
        $product->stock_status = $request->stock_status ? 'yes':'no'; 

        if($request->baremes){
            $selected = '';
            $count = count($request->baremes);
            foreach($request->baremes as $key => $baremes)
            {
                $selected .= $baremes. ($count != $key+1 ? ',':'');
            }
            $product->baremes = $selected;
        }
        $product->getTags()->attach($request->tags);
        $product->prestations()->attach($request->prestation_id);
        $path = public_path('uploads/products');
        // if($request->file('acermi_file')){
        //     $file1 = $request->file('acermi_file');
        //     $fileName1 = $product->id.rand(0000000,9999999).$file1->extension();
        //     $file1->move($path, $fileName1);
        //     $product->acermi_file = $fileName1;
        // }
        // if($request->file('certita_file')){
        //     $file2 = $request->file('certita_file');
        //     $fileName2 = $product->id.rand(0000000,9999999).$file2->extension();
        //     $file2->move($path, $fileName2);
        //     $product->certita_file = $fileName2;
        // }
        // if($request->file('notice_file')){
        //     $file3 = $request->file('notice_file');
        //     $fileName3 = $product->id.rand(0000000,9999999).$file3->extension();
        //     $file3->move($path, $fileName3);
        //     $product->notice_file = $fileName3;
        // }
        if($request->file('data_file')){
            $file4 = $request->file('data_file');
            $fileName4 = $product->id.rand(0000000,9999999).$file4->extension();
            $file4->move($path, $fileName4);
            $product->data_file = $fileName4;
        }
        $product->save();

        return back()->with('success', __('Added Succesfully'))->with('produits_tab_active', 'Product tab active')->with('travaux_tab_activate', 'Travaux tab active');
    }

    // Product Update
    public function productUpdate(Request $request){
        if(!checkAction(Auth::id(), 'general__setting-produits', 'edit') && role() != 's_admin'){
            return back();
        }
        $request->validate([
            // 'acermi_file' => 'file',
            // 'certita_file' => 'file',
            // 'notice_file' => 'file',
            'data_file' => 'file',
        ]);

        $product = Product::find($request->id);
        $product->update($request->except(['_token', 'id', 'baremes', 'tags', 'prestation_id', 'projet_status', 'stock_status']));
        $product->projet_status = $request->projet_status ? 'yes':'no';
        $product->stock_status = $request->stock_status ? 'yes':'no';
        $selected = '';
        if($request->baremes){
            $count = count($request->baremes);
            foreach($request->baremes as $key => $baremes)
            {
                $selected .= $baremes. ($count != $key+1 ? ',':'');
            }
        }
        $product->getTags()->sync($request->tags);
        $product->prestations()->sync($request->prestation_id);
        $product->baremes = $selected;
        $path = public_path('uploads/products');
        // if($request->file('acermi_file')){
        //     $file1 = $request->file('acermi_file');
        //     $fileName1 = $product->id.rand(0000000,9999999).$file1->extension();
        //     $file1->move($path, $fileName1);
        //     $product->acermi_file = $fileName1;
        // }
        // if($request->file('certita_file')){
        //     $file2 = $request->file('certita_file');
        //     $fileName2 = $product->id.rand(0000000,9999999).$file2->extension();
        //     $file2->move($path, $fileName2);
        //     $product->certita_file = $fileName2;
        // }
        // if($request->file('notice_file')){
        //     $file3 = $request->file('notice_file');
        //     $fileName3 = $product->id.rand(0000000,9999999).$file3->extension();
        //     $file3->move($path, $fileName3);
        //     $product->notice_file = $fileName3;
        // }
        if($request->file('data_file')){
            $file4 = $request->file('data_file');
            $fileName4 = $product->id.rand(0000000,9999999).$file4->extension();
            $file4->move($path, $fileName4);
            $product->data_file = $fileName4;
        }
        if(!$request->activate){
            $product->activate = 'off';
        }
        if(!$request->ce_marking){
            $product->ce_marking = 'off';
        }
        $product->save();

        return back()->with('success', __('Updated Succesfully'))->with('produits_tab_active', 'Product tab active');
    }
    
    // Product Delete 
    public function productDelete(Request $request){
        if(!checkAction(Auth::id(), 'general__setting-produits', 'delete') && role() != 's_admin'){
            return back();
        }
        Product::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('produits_tab_active', 'Product tab active');
    }

    // Category Create
    public function categoryCreate(Request $request){
        Category::create($request->except('_token'));
        return back()->with('success', __('Added Succesfully'))->with('category_tab_active', 'category tab active');
    }
    
    // Category Delete 
    public function categoryUpdate(Request $request){
        $category = Category::find($request->id);
        $category->update($request->except('_token'));
        return back()->with('success', __('Updated Succesfully'))->with('category_tab_active', 'category tab active');
    }
    
    // Category Delete 
    public function categoryDelete(Request $request){
        Category::find($request->id)->delete(); 
        return back()->with('success', __('Deleted Succesfully'))->with('category_tab_active', 'category tab active');    
    }
    
    // Sub Category Create 
    public function subCategoryCreate(Request $request){
        Subcategory::create($request->except('_token'));
        return back()->with('success', __('Added Succesfully'))->with('sub_category_tab_active', 'category tab active');
    }
    
    // Sub Category Update 
    public function subCategoryUpdate(Request $request){
        Subcategory::find($request->id)->update($request->except('_token'));
        return back()->with('success', __('Updated Succesfully'))->with('sub_category_tab_active', 'category tab active');
    }
    
    // Sub Category delete 
    public function subCategoryDelete(Request $request){
        Subcategory::find($request->id)->delete();
        return back()->with('success', __('Deleted Succesfully'))->with('sub_category_tab_active', 'category tab active');
    }

    public function productEditModal(Request $request){
        $product = Product::find($request->product_id);
        $categories = Category::all();
        $subcategories = Subcategory::all(); 
        $brands = Brand::all();
        $benefits = Benefit::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get(); 
        $view = view('admin.settings.product-edit-modal', compact('product','categories', 'subcategories', 'brands', 'bareme_travaux_tags', 'benefits'))->render();
        return response($view);
    }


    
}
