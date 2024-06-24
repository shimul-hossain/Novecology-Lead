<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CRM\Notion;
use App\Models\CRM\NotionAssign;
use App\Models\CRM\NotionCategory;
use App\Models\CRM\NotionSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class NotionController extends Controller
{
    public function index()
    {
        if(role() == 's_admin'){ 
            $notions = Notion::take(30)->get();
        }else{
            $notions = Auth::user()->notion()->take(30)->get();
        }
        $categories = NotionCategory::orderBy('order', 'asc')->get();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->get();
        return view('notion.index', compact('notions', 'installers', 'categories'));

    }
    public function store(Request $request){ 
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);
        $notion = Notion::create([
            'title'             => $request->title,
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'data'              => '[{"id":"5FxRrEAyF8","type":"paragraph","data":{"text":"Let\'s start here"}}]',
            'created_by'        => Auth::id(),
        ]);
        $notion->assignee()->attach($request->user_id);
        $path = public_path('uploads/notion');
        if($request->file('profile')){
            $image = $request->file('profile');
            $fileName = $notion->id.rand(00000,55555).'.'.$image->extension();
            $image->move($path, $fileName);
            $notion->profile = $fileName;
            $notion->save();
        }

        if($request->file('cover')){
            $image = $request->file('cover');
            $fileName = $notion->id.rand(00000,55555).'.'.$image->extension();
            $image->move($path, $fileName);
            $notion->cover = $fileName;
            $notion->save();
        } 

        return back()->with('success', __('Created Successfully'));
    }
    public function update(Request $request){ 
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
        ]);
        $notion = Notion::find($request->id);
        $notion->update([
            'title'             => $request->title, 
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id, 
        ]);

        $notion->assignee()->sync($request->user_id);
        $path = public_path('uploads/notion');
        if($request->file('profile')){
            $image = $request->file('profile');
            $fileName = $notion->id.rand(00000,55555).'.'.$image->extension();
            $image->move($path, $fileName);
            $notion->profile = $fileName;
            $notion->save();
        }

        if($request->file('cover')){
            $image = $request->file('cover');
            $fileName = $notion->id.rand(00000,55555).'.'.$image->extension();
            $image->move($path, $fileName);
            $notion->cover = $fileName;
            $notion->save();
        } 

        return back()->with('success', __('Updated Successfully'));
    }
    
    public function notionDelete(Request $request){
        $notion = Notion::find($request->id);
        if($notion){
            $notion->delete();
        }
        return back()->with('success', __('Deleted Successfully'));
    }

    public function dataStore(Request $request){
         
        Notion::find($request->id)->update([
            'data'  => $request->data
        ]);
        return response('Success');
    }

    public function profileUpdate(Request $request){
        $notion = Notion::find($request->id);
        $path = public_path('uploads/notion');
        $image = $request->file('profile');
        $fileName = Auth::id().rand(00000,55555).'.'.$image->extension();
        $image->move($path, $fileName);
        $notion->profile = $fileName;
        $notion->save();
        return response('Success');
    }
    public function coverUpdate(Request $request){
        $notion = Notion::find($request->id);
        $path = public_path('uploads/notion');
        $image = $request->file('cover');
        $fileName = Auth::id().rand(00000,55555).'.'.$image->extension();
        $image->move($path, $fileName);
        $notion->cover = $fileName;
        $notion->save();
        return response('Success');
    }

    public function titleUpdate(Request $request){
        Notion::find($request->id)->update([
            'title' => $request->title,
        ]);

        return response('Success');
    }

    public function notionDetails($id){
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->get();
        if(role() != 's_admin'){
            if(NotionAssign::where('user_id', Auth::id())->where('notion_id', $id)->exists()){
                $notion = Notion::find($id);
                return view('notion.details', compact('notion', 'installers'));
            }else{
                return back();
            }
        }else{
            $notion = Notion::find($id);
            return view('notion.details', compact('notion', 'installers'));
        }
    }


    public function uploadFile(Request $request){
        if($request->file('image')){
            $image = $request->file('image');
            $fileName = time().'.'.$image->extension();
            $image->move(public_path('uploads/notionfile'), $fileName);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset('uploads/notionfile').'/'.$fileName,
                ]
            ]);         
        }
        if($request->file('file')){
            $file = $request->file('file');
            $fileName = time().'.'.$file->extension();
            $file->move(public_path('uploads/notionfile'), $fileName);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset('uploads/notionfile').'/'.$fileName,
                ]
            ]);         
        }
    }

    public function notionAssignUpdate(Request $request){
        $notion = Notion::find($request->id);
        $notion->assignee()->sync($request->user_id);
        return back()->with('success', __("Updated Succesfully"));
    }

    public function notionCategoryChange(Request  $request){
        $category = NotionCategory::find($request->category_id);
        if($category){
            $view = view('notion.sub_category_list',['sub_categories' => $category->subCategories])->render();
            return response($view);
        }else{
            return response('');
        }
    }

    public function notionCategoryFilter(Request $request){
        if(role() == 's_admin'){
            $notions = Notion::where('category_id', $request->category_id)->take(30)->get();
        }else{
            $notions = Auth::user()->notion()->where('category_id', $request->category_id)->take(30)->get();
        }
        $categories = NotionCategory::orderBy('order', 'asc')->get();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $category = NotionCategory::find($request->category_id);
        $load_status = $notions->count() == 30 ? true : false;
        $veiw = view('notion.category_filter', compact('notions', 'installers', 'categories', 'category'))->render();
        return response()->json(['data' => $veiw, 'load_status' => $load_status]);
    }

    public function notionSubcategoryFilter(Request $request){
        if(role() == 's_admin'){
            $notions = Notion::where('sub_category_id', $request->sub_category_id)->take(30)->get();
        }else{
            $notions = Auth::user()->notion()->where('sub_category_id', $request->sub_category_id)->take(30)->get();
        } 
        $categories = NotionCategory::orderBy('order', 'asc')->get();
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->get(); 
        $load_status = $notions->count() == 30 ? true : false;
        $veiw = view('notion.subcategory_filter', compact('notions', 'installers', 'categories'))->render();
        return response()->json(['data' => $veiw, 'load_status' => $load_status]);
    }

    public function notionLoadMore(Request $request){
        // dd($request->count);
        if($request->type == 'all'){
            if(role() == 's_admin'){
                $notions = Notion::skip($request->count)->take(30)->get();
            }else{
                $notions = Auth::user()->notion()->skip($request->count)->take(30)->get();
            }
        }else if($request->type == 'category'){
            if(role() == 's_admin'){
                $notions = Notion::where('category_id', $request->category)->skip($request->count)->take(30)->get();
            }else{
                $notions = Auth::user()->notion()->where('category_id', $request->category)->skip($request->count)->take(30)->get();
            }   
        }else{ 
            if(role() == 's_admin'){
                $notions = Notion::where('sub_category_id', $request->subcategory)->skip($request->count)->take(30)->get();
            }else{
                $notions = Auth::user()->notion()->where('sub_category_id', $request->subcategory)->skip($request->count)->take(30)->get();
            }   
        }
        $total_count = $request->count + 30;
        $load_status = $notions->count() == 30 ? true : false;
        $installers = User::where('deleted_status', 'no')->where('status', 'active')->get(); 
        $categories = NotionCategory::orderBy('order', 'asc')->get();
        $data = view('notion.loaded', compact('notions', 'installers', 'categories'))->render();

        return response()->json(['data' => $data, 'load_status' => $load_status, 'total_count' => $total_count]);
    }

    
    //   End 
}
 