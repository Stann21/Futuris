<?php

namespace App\Http\Controllers;

use App\learning_goals;
use App\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $mentorid = Auth::id();
        $feedback = feedback::FeedbackMentor($mentorid);
        $users = users::GetAllMentorClients($mentorid);

        return view ('backendpages.feedback.index')
            ->with('feedback', $feedback)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userid, $id, $feedbackid){
        switch($id) {
            case '0':
                $maingoal = '';
                break;
            case '1':
                $goal = learning_goals::GetSingleGoal($feedbackid);
                $maingoal = learning_goals::GetSingleGoal($goal->learning_category);
                break;
        }

        return view ('backendpages.feedback.create')
            ->with('userid', $userid)
            ->with('id', $id)
            ->with('feedbackid', $feedbackid)
            ->with('maingoal', $maingoal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'feedback' => 'required',
        ]);

        $userid = $request->input('userid');

        $feedback = new Feedback;
        $feedback->feedback_description = $request->input('feedback');
        $feedback->feedback_client = $userid;
        $feedback->feedback_mentor = Auth::id();
        $feedback->feedback_role = $request->input('feedback_role');
        $feedback->feedback_onid = $request->input('feedback_onid');
        $feedback->feedback_date = Carbon::now()->format('Y-m-d');
        $feedback->save();

        return redirect('admin/user/' . $userid)->with('success', 'Feedback aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *  What does locationid mean
     * 0 = From the feedback view
     * 1 = From the user view
     */
    public function edit($id, $locationid) {;
        $feedback = feedback::GetSpecificFeedback($id);

        switch($locationid) {
            case ('0'):
                $link = '/admin/feedback';;
                break;
            case ('1'):
                $link = '/admin/user/' . $feedback->feedback_client;
                break;
        }

        return view('backendpages.feedback.edit')
            ->with('id', $id)
            ->with('feedback', $feedback)
            ->with('locationid', $locationid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'feedback' => 'required',
        ]);

        $userid = $request->input('userid');
        $locationid = $request->input('location');

        DB::table('feedback')->where('feedback_id', $id)->update(array(
            'feedback_description' => $request->input('feedback'),
        ));

        switch($locationid) {
            case ('0'):
                return redirect('admin/feedback')->with('success', 'Feedback is aangepast');

                break;
            case ('1'):
                return redirect('admin/user/' . $userid)->with('success', 'Feedback is aangepast');
                break;
        }
    }

    /**
     * Remove the specified resource from storage, redirects to feedbackoverview
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('feedback')->where('feedback_id', $id)->delete();

        return redirect ('admin/feedback')->with('success', 'Feedback is verwijderd');
    }

    /**
     * Remove the specified resource from storage, redirects to specifiek page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *  1 = User overview
     */

    public function destroypages($id, $page) {
        $userid = DB::table('feedback')->where('feedback_id', $id)->first('feedback_client');
        DB::table('feedback')->where('feedback_id', $id)->delete();

        foreach ($userid as $id) {
            switch($page) {
                case ('1'):
                    return redirect ('admin/user/' . $id)->with('success', 'Feedback is verwijderd');
                    break;
            }
        }
    }
}
