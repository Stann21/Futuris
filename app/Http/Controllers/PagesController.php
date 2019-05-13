<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\users;


class PagesController extends Controller {
    public function index() {
        $title = "Home";
        return view('pages.index', compact('title'));
    }

    public function overview() {
        $title = "Overzicht";
        $id = Auth::user()->id;
        $goals = DB::table('learning_goals')->where('user_id', $id)->where('learning_role', 'Hoofdleerdoel')->get();
        $subgoals = DB::table('learning_goals')->where('user_id', $id)->where('learning_role', 'Subleerdoel')->get();
        $feedback = DB::table('feedback')->where('feedback_client', $id)->get();
        $achievements = DB::table('achievements_users')->where('achievement_client', $id)->orderBy('id', 'desc')->get();
        $i = '0';

        //Get Percentage counter
        $percentageCounter = users::CountPercentage($goals, $subgoals);

        return view('pages.overview')->with('title', $title)->with('goals', $goals)->with('subgoals', $subgoals)->with('feedback', $feedback)->with('achievements', $achievements)->with('percentageCounter', $percentageCounter)->with('i', $i);
    }

    public function goal($id) {
        $title = "Doel";
        $mainGoal = DB::table('learning_goals')->where('learning_id', $id)->first();
        $goals = DB::table('learning_goals')->where('learning_category', $id)->get();
        $userid = DB::table('users')->where('id', Auth::user()->id)->first('user_feedback');
        $achievement = DB::table('achievements_users')->where('achievement_client', Auth::user()->id)->where('achievement_subject', 'Subdoel')->get();

        return view('pages.goal')
            ->with('title', $title)
            ->with('goals', $goals)
            ->with('mainGoal', $mainGoal)
            ->with('userid', $userid)
            ->with('achievement', $achievement);
    }

    public function feedback() {
        $title = "Feedback";
        $id = Auth::user()->id;
        $feedback = DB::table('feedback')->where('feedback_client', $id)->orderBy('feedback_date', 'desc')->get();

        return view('pages.feedback')->with('title', $title)->with('feedback', $feedback);
    }

    public function feedbackDetail($id) {
        $title = "Feedback Detail";
        $feedback = DB::table('feedback')->where('feedback_id', $id)->get();

        return view('pages.feedbackDetail')->with('title', $title)->with('feedback', $feedback);
    }

    public function achievementDetail($id) {

        $title = "Mijn prijzen detail";
        $achievements = DB::table('achievements_users')->where('id', $id)->get();
        $feedback = DB::table('feedback')->where('feedback_id', $id)->get();
    
        return view('pages.achievementDetail')->with('title', $title)->with('achievements', $achievements)->with('feedback',$feedback);
    }

    public function loading() {
        $title = "loading page";
        return view('pages.loading')->with('title', $title);
    }

    public function settings() {
        $title = "Instellingen";
        $userid = Auth::user();
        return view('pages.settings')->with('title', $title)->with('userid', $userid);
    }


    //Not sure what this is
    public function addusers() {
        $title =  "Add users";
        return view('backendpages.addusers')->with('title', $title);
    }

    public function passwordUpdate(Request $request, $id) {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'repeat_password' => 'required'
        ]);

        //Get user
        $user = Users::GetUser($id);

        //Password from the form
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $repeat_password = $request->input('repeat_password');

        //Length password
        $length_password = strlen($new_password);

        //Password hash
        $password = bcrypt($new_password);

        if (password_verify($old_password, $user->password)) {
            if ($new_password == $repeat_password) {
                if ($length_password >= 8) {
                    $user = User::find($id);
                    $user->password = $password;
                    $user->save();
                    return redirect('/settings')->with('success', 'Wachtwoord is veranderd');
                }
                return redirect ('/settings')->with('error', 'Wachtwoord is niet lang genoeg');
            }
            return redirect ('/settings')->with('error', 'Wachtwoorden komt niet overeen');
        }
        return redirect ('/settings')->with('error', 'Het oude wachtwoord is niet correct');
    }
}
