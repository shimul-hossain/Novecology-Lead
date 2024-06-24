<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\QualityControlQuestion;
use App\Models\CRM\QualityControlType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QualityControlController extends Controller
{
    public function qualityControlCreate(Request $request){

        $qc = QualityControlType::create([
            'name' => $request->name
        ]);

        if($request->label_title){
            foreach($request->label_title as $key => $value){
                if($request->type[$key] == 'question'){
                    QualityControlQuestion::create([
                        'quality_control_id'    => $qc->id,  
                        'type'                  => 'question',
                        'question_title'        => $value,
                        'question_name'         => Str::snake($value, '_'),
                        'question_type'         => $request->input_type[$key],
                        'question_required'     => $request->required_optional[$key],
                        'question_options'      => $request->options[$key],
                    ]);
                }else{
                    QualityControlQuestion::create([
                        'quality_control_id'    => $qc->id,  
                        'type'                  => 'header',
                        'header_title'          => $value,
                        'header_color'          => $request->qc_header_color[$key],  
                    ]);
                }
            }
        }



        return back()->with('success', __("Created Successfully"))->with('quality_control', 1);
    }

    public function qualityControlUpdate(Request $request){
        $qc = QualityControlType::find($request->id);
        $qc->update([
            'name' => $request->name,
        ]);

        $question_ids = $request->question_id;  
        
        foreach($qc->getQuestions as $question){
            if(in_array($question->id, $question_ids)){
                if($question->type == 'question'){
                    $question->update([
                        'question_title'        => $request->label_title[array_search($question->id, $question_ids)],
                        'question_name'         => Str::snake($request->label_title[array_search($question->id, $question_ids)], '_'),
                        'question_type'         => $request->input_type[array_search($question->id, $question_ids)],
                        'question_required'     => $request->required_optional[array_search($question->id, $question_ids)],
                        'question_options'      => $request->options[array_search($question->id, $question_ids)],
                    ]);
                }else{
                    $question->update([
                        'header_title'          => $request->label_title[array_search($question->id, $question_ids)],
                        'header_color'          => $request->qc_header_color[array_search($question->id, $question_ids)],  
                    ]);
                }
            }else{
                 $question->delete();
            }
        }

        if($request->label_title){
            foreach($request->label_title as $key => $value){
                if($request->question_id[$key] == 0){
                    if($request->type[$key] == 'question'){
                        QualityControlQuestion::create([
                            'quality_control_id'    => $qc->id,  
                            'type'                  => 'question',
                            'question_title'        => $value,
                            'question_name'         => Str::snake($value, '_'),
                            'question_type'         => $request->input_type[$key],
                            'question_required'     => $request->required_optional[$key],
                            'question_options'      => $request->options[$key],
                        ]);
                    }else{
                        QualityControlQuestion::create([
                            'quality_control_id'    => $qc->id,  
                            'type'                  => 'header',
                            'header_title'          => $value,
                            'header_color'          => $request->qc_header_color[$key],  
                        ]);
                    }
                }
            }
        }

        return back()->with('success', __("Updated Successfully"))->with('quality_control', 1);
    }

    public function qualityControlDelete(Request $request){
        QualityControlType::find($request->id)->delete();
        return back()->with('success', __("Deleted Successfully"))->with('quality_control', 1);
    }
}
