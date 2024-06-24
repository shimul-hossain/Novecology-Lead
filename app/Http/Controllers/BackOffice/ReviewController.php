<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Models\ClintOpinion;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews = ClintOpinion::all();
        return view('backoffice.review.index', compact('reviews'));
    }

    public function statusChange(Request $request){
        $review = ClintOpinion::find($request->review_id);
        if($review){
            $review->update([
                'status' => $request->status,
            ]);
        }

        return response('success');
    }
}
