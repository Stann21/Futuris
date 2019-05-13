<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\learning_goals;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Setup
        $id = Auth::user()->id;
        $users = User::where('user_role', 'Client')->where('user_mentor', $id)->orderBy('username', 'ASC')->get();
        $MaingoalsPercentage = users::CountMaingoalsPercentage($users);
        
        return view('backendpages.users.index')
            ->with('users', $users)
            ->with('MaingoalsPercentage', $MaingoalsPercentage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $mentor = DB::table('users')->where('user_role', 'mentor')->get();
        $templates = DB::table('template_goals')->where('template_role', 'Hoofdleerdoel')->get();

        return view('backendpages.users.create')
            ->with('mentor', $mentor)
            ->with('templates', $templates)
            ->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'username' => 'required',
        ]);

        $id = $request->input('id');

        //Create user
        if ($id == '0') {
            //Get activationcode
            $activationcode = users::GenerateActivationCode();

            //Hash random password
            $getPassword = users::GenerateActivationCode();
            $password = bcrypt($getPassword);

            // Create user
            $user = new User;
            $user->username = $request->input('username');
            $user->password = $password;
            $user->user_role = 'client';
            $user->user_endgoal = $request->endgoal;
            $user->user_activationcode = $activationcode;
            $user->user_mentor = $request->mentor;
            $user->user_activated = '0';
            $user->user_feedback = $request->input('feedback');
            $user->save();

            //Get templates
            $template = $request->input('template');
            //Get userid that has been inserted
            $userid = DB::table('users')->where('username', $request->input('username'))->pluck('id');

            if (!empty($template)) {
                foreach ($template as $templates) {
                    $checked_templates = DB::table('template_goals')->where('template_name', $templates)->get();

                    //Create maingoal
                    foreach ($checked_templates as $checked_template) {
                        if ($checked_template->template_role == 'Hoofdleerdoel') {
                            //Create the maingoal
                            $maingoal_template = new learning_goals;
                            $maingoal_template->learning_name = $checked_template->template_name;
                            foreach ($userid as $id) {
                                $maingoal_template->user_id = $id;
                            }
                            $maingoal_template->learning_role = $checked_template->template_role;
                            $maingoal_template->learning_finished = '0';
                            $maingoal_template->learning_icon = $checked_template->template_icon;
                            $maingoal_template->learning_finish = $checked_template->template_finish;
                            $maingoal_template->save();
                        } //End if

                        //Create subgoal
                        if ($checked_template->template_role == 'Subleerdoel') {
                            $maingoal = DB::table('template_goals')->where('template_id', $checked_template->template_category)->first();
                            $main_goal = DB::table('learning_goals')->where('learning_name', $maingoal->template_name)->where('user_id', $userid)->first();

                            if (!empty($main_goal)) {
                                //Create the subgoal
                                $subgoal_template = new learning_goals;
                                $subgoal_template->learning_name = $checked_template->template_name;
                                $subgoal_template->learning_description = $checked_template->template_description;
                                foreach ($userid as $id) {
                                    $subgoal_template->user_id = $id;
                                }
                                $subgoal_template->learning_role = $checked_template->template_role;
                                $subgoal_template->learning_finished = '0';
                                $subgoal_template->learning_icon = $checked_template->template_icon;
                                $subgoal_template->learning_finish = $checked_template->template_finish;
                                $subgoal_template->learning_category = $main_goal->learning_id;
                                $subgoal_template->save();
                            }
                        }
                    } //End foreach
                }
            }

            return redirect('/admin/user')->with('success', 'Gebruiker aangemaakt');
        }

        //Create mentor
        if ($id == '1') {
            //Get activationcode
            $activationcode = users::GenerateActivationCode();

            //Hash random password
            $getPassword = $request->input('password');
            $getPasswordRepeat = $request->input('password_repeat');

            if($getPassword == $getPasswordRepeat) {
                $length_password =  strlen($getPassword);
                if ($length_password < '8') {
                    return redirect ('/admin/user/create/1')->with('error', 'Wachtwoord is te kort, minimaal acht karakters.');
                }else {
                    //Hash password
                $password = bcrypt($getPassword);

                //Create mentor
                $user = new User;
                $user->username = $request->input('username');
                $user->password = $password;
                $user->user_role = 'mentor';
                $user->user_activationcode = $activationcode;
                $user->user_activated = '1';
                $user->save();

                return redirect('/admin/backanddashboard')->with('success', ' Begeleider aangemaakt');
                }
            }else {
                return redirect ('/admin/user/create/1')->with('error', 'Wachtwoorden komen niet overeen');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //Get userid
        $users = User::where('id', $id)->first();
        //Get goals
        $goals = DB::table('learning_goals')->where('learning_role', 'Hoofdleerdoel')->where('user_id', $id)->get();
        //Get subgoals
        $subgoals = DB::table('learning_goals')->where('learning_role', 'Subleerdoel')->where('user_id', $id)->get();
        //Get feedback
        $feedback = DB::table('feedback')->where('feedback_mentor', Auth::id())->where('feedback_client', $users->id)->orderBy('feedback_id', 'desc')->limit('5')->get();
        //Get Percentage counter
        $percentageCounter = users::CountPercentage($goals, $subgoals);
        //Get name of mentor
        $mentorname = DB::table('users')->where('id', $users->user_mentor)->get('username');
        //Get achievement for user
        $achievements = DB::table('achievements_users')->where('achievement_client', $id)->orderBy('id', 'desc')->take('4')->get();
        $userid = $users->id;


        return view('backendpages.users.user')
            ->with('userid', $userid)
            ->with('users', $users)
            ->with('goals', $goals)
            ->with('subgoals', $subgoals)
            ->with('feedback',$feedback)
            ->with('percentageCounter', $percentageCounter)
            ->with('mentorname', $mentorname)
            ->with('achievements', $achievements);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $users = User::find($id);
        //Get all the mentor names
        $mentor = DB::table('users')->where('user_role', 'mentor')->get();

        return view('backendpages.users.edit')
            ->with('users', $users)
            ->with('mentor', $mentor);
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
            'username' => 'required',
        ]);

        //Hash password
        $getPassword = $request->input('password');
        $password = bcrypt($getPassword);

        // Create user
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->password = $password;
        $user->user_endgoal = $request->endgoal;
        $user->user_mentor = $request->mentor;
        $user->user_feedback = $request->input('feedback');
        $user->save();

        return redirect('/admin/user/' . $id . '/edit')->with('success', 'Gebruiker aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // Delete user
        $delete_users = DB::table('users')->where('id', $id)->delete();
        //Delete learninggoals & subgoals
        $delete_goals = DB::table('learning_goals')->where('user_id', $id)->delete();
        //Delete feedback
        $delete_feedback = DB::table('feedback')->where('feedback_client', $id)->delete();
        //Delete achievements
        $delete_achievements = DB::table('achievements_users')->where('achievement_client', $id)->delete();

        return redirect('/admin/user')->with('success', 'Gebruiker verwijderd');
    }


}
