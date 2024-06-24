<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Automatise;
use App\Models\CRM\Automatisation;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectSubStatus;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;

class AutomatisationController extends Controller
{
    public function index(){
        $items = Automatise::all();
        // $items = Automatise::paginate(paginationNumber('automatisation'));
        return view('admin.automatisation-block', compact('items'));
        // $items = Automatisation::paginate(paginationNumber('automatisation'));
        // return view('admin.automatisation', compact('items'));
    }

    public function blockCreate()
    {
        $main_status = LeadStatus::orderBy('order', 'asc')->get();
        $sub_status =  LeadSubStatus::orderBy('order', 'asc')->get();
        $chantier_status = ProjectNewStatus::orderBy('order', 'asc')->get();
        $chantier_sub_status = ProjectSubStatus::orderBy('order', 'asc')->get();
        $email_templates = EmailTemplate::all();
        $sms_templates = SmsTemplate::all();
        return view('admin.block-create', compact('main_status', 'sub_status', 'email_templates', 'sms_templates', 'chantier_status', 'chantier_sub_status'));
    }
    public function blockEdit($id)
    {
        $automatisation = Automatise::find($id);
        $main_status = LeadStatus::orderBy('order', 'asc')->get();
        $sub_status =  LeadSubStatus::orderBy('order', 'asc')->get();
        $chantier_status = ProjectNewStatus::orderBy('order', 'asc')->get();
        $chantier_sub_status = ProjectSubStatus::orderBy('order', 'asc')->get();
        $email_templates = EmailTemplate::all();
        $sms_templates = SmsTemplate::all();
        return view('admin.block-edit', compact('main_status', 'automatisation', 'sub_status', 'email_templates', 'sms_templates', 'chantier_status', 'chantier_sub_status'));
    }


    public function activateBlock(Request $request)
    {
        $data = Automatise::find($request->id);
        if($data){
            $data->update(['active' => $request->status]);
        }
        return response()->json(['success' => true, 'message' => __("Updated Successfully")]);
    }

    public function blockStore(Request $request)
    {
        // dd($request->all());
        Automatise::create($request->except('_token')); 

        return redirect('/admin/automatisation')->with('success', __("Created Successfully"));
    }

    public function blockUpdate(Request $request){
        $item = Automatise::find($request->id);
        $item->update($request->except(['_token', 'id']));
        return redirect('/admin/automatisation')->with('success', __("Updated Successfully"));
    }

    public function blockDelete(Request $request)
    {
        Automatise::find($request->id)->delete();
        return redirect('/admin/automatisation')->with('success', __("Deleted Successfully"));
    }

    public function store(Request $request){
        $request->validate([
            'nom_campagne'      => 'required',
            'type_de_campagne'  => 'required',
            'recurrence'        => 'required',
            'date_de_debut'     => 'required',
            'horaire_de_debut'  => 'required',
            'date_de_fin'       => 'required',
        ]);

        Automatisation::create($request->except('_token') + ['created_by' => Auth::id()]);

        return back()->with('success', __("Created Successfully"));
    }
    public function update(Request $request){
        $request->validate([
            'nom_campagne'      => 'required',
            'type_de_campagne'  => 'required',
            'recurrence'        => 'required',
            'date_de_debut'     => 'required',
            'horaire_de_debut'  => 'required',
            'date_de_fin'       => 'required',
        ]);
        $data = Automatisation::find($request->id);
        if($data){
            $data->update($request->except(['id', '_token']));
        }

        return back()->with('success', __("Updated Successfully"));
    }

    public function delete(Request $request){
        $data = Automatisation::find($request->id);
        if($data){
            $data->delete();
        }
        return back()->with('success', __("Deleted Successfully"));
    }

    public function bulkDelete(Request $request){
        if($request->id){
            $ids = explode(',', $request->id);
            foreach($ids as $id){
                $item = Automatisation::find($id);
                if($item){
                    $item->delete();
                }
            }
        }
        return back()->with('success', __("Deleted Successfully"));
    }

    public function statusChange(Request $request){
    $data = Automatisation::find($request->id);
    if($data){
        $data->update([
            'status' => $request->status,
        ]);
    }

    return response(__('Updated Succesfully'));
    }
}
