<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        $feedback = feedback::FeedbackClient($id);

        return view ('backendpages.print.index')
            ->with('feedback', $feedback);
    }

    //This is the file that will download the file
    public function pdf(Request $request) {
        $array = [];
        $feedbackid = $request->input('feedback');

        foreach ($feedbackid as $id) {
            $feedback = DB::table('feedback')->where('feedback_id', $id)->first();
            array_push($array, $feedback->feedback_description);
        }

        $pdf = PDF::loadView('backendpages.print.pdf', compact('array'));
        return $pdf->download('rapport.pdf');
    }
}
