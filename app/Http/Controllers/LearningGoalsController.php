<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\learning_goals;
use App\Icon;
use Illuminate\Support\Facades\DB;

class LearningGoalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clientid, $goal, $goalid) {
        $learninggoal = learning_goals::GetSingleGoal($goalid);
        $icons = Icon::IconByName();

        switch ($goal) {
            case '0':
                $name = 'Hoofddoel';
                $link = '/admin/user/' . $clientid;
                break;
            case '1':
                $name = 'Subdoel';
                $link = '/admin/user/' . $clientid;
                break;
        }

        return view('backendpages.goals.create')
            ->with('icons', $icons)
            ->with('clientid', $clientid)
            ->with('learninggoal', $learninggoal)
            ->with('goal', $goal)
            ->with('goalid', $goalid)
            ->with('name', $name);
    }
    public function insert(Request $request, $id){
        $subgoalID = $request->input('subgoalID');

        DB::table('learning_goals')->where('learning_id', $subgoalID)->update(array(
            'learning_feedback' => $request->input('feedback'),
            'learning_feedbackIcon' => $request->input('feedbackicon')
        ));

         return redirect('./goal/' . $id)->with('success', 'Feedback is ingevoerd');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name_goal' => 'required',
        ]);

        //Userid
        $userid = $request->input('userid');

        //ID from maingoal
        $goalid = $request->input('category_name');

        //Role
        $role = $request->input('role');
        if ($role == 'Hoofddoel'){
            $learningRole = 'Hoofdleerdoel';
        }

        if ($role == 'Subdoel') {
            $learningRole = 'Subleerdoel';
        }

        // Create LearningGoal
        $LearningGoalsController = new learning_goals;
        $LearningGoalsController->learning_name = $request->input('name_goal');
        $LearningGoalsController->learning_category = $request->input('category_name');
        $LearningGoalsController->user_id = $userid;
        $LearningGoalsController->learning_role = $learningRole;
        $LearningGoalsController->learning_description = $request->input('description');
        $LearningGoalsController->learning_finished = '0';
        $LearningGoalsController->learning_icon = $request->input('icon');
        $LearningGoalsController->learning_finish = $request->input('ending');
        $LearningGoalsController->save();

        //Redirect for maingoal en subgoal
        if (empty($goalid)) {
            return redirect('/admin/user/' . $userid)->with('success', 'Leerdoel aangemaakt');
        }else {
            return redirect('/admin/goals/' . $goalid .'/' . $userid)->with('success', 'Leerdoel aangemaakt');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $userid) {
        $goals = learning_goals::GetSingleGoal($id);
        $subgoals = learning_goals::GetSubgoals($id, $userid);
        $name = 'Leerdoel';

        return view('backendpages.goals.show')
            ->with('goals', $goals)
            ->with('subgoals', $subgoals)
            ->with('userid', $userid)
            ->with('category')
            ->with('name', $name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * %$clientid = The id of the client id
     * $goal = The difference between goal(0) and subgoal(1)
     * $goalid = The id of the goal that will be edited
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($clientid, $goal, $goalid) {
        $learninggoal = learning_goals::GetSingleGoal($goalid);
        $icons = Icon::IconByName();

        switch ($goal) {
            case '0':
                $name = 'Hoofddoel';
                $link = $learninggoal->learning_id;
                break;
            case '1':
                $name = 'Subdoel';
                $link = $learninggoal->learning_category;
                break;
        }

        return view('backendpages.goals.edit')
            ->with('clientid', $clientid)
            ->with('learninggoal', $learninggoal)
            ->with('goal', $goal)
            ->with('goalid', $goalid)
            ->with('icons', $icons)
            ->with('name', $name);
    }

    /**
     * Update the specified resource in storage.
     *
     * Variable goal:
     * 0 = Main goal
     * 1 = Subgoal
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name_goal' => 'required',
        ]);

        //Get all the stuff
        $userid = $request->input('userid');
        $goalid = $request->input('category_name');
        $goalname = $request->input('name_goal');
        $goal = $request->input('goal');

        if ($goal == '0') {
            DB::table('learning_goals')->where('learning_category', $goalid)->update(array(
                'learning_icon' => $request->input('icon')
            ));
        }

        if ($goal == '1') {
            //Setup variables
            $done = '0';
            $total = '0';
            $subgoals = DB::table('learning_goals')->where('learning_category', $goalid)->get();
            $maingoal = DB::table('learning_goals')->where('learning_id', $goalid)->get();

            //How many subgoals have been finished
            foreach ($subgoals as $subgoal) {
                if ($subgoal->learning_finished == '1') {
                    $done++;
                }
                $total++;
            }

            //Whats the current subgoal status?
            foreach ($maingoal as $main) {
                if ($main->learning_finished == '0') {
                    if ($request->input('finished') == '1') {
                        $done ++;
                    }
                }else {
                    if ($request->input('finished') == '1') {
                        $done ++;
                    }else {
                        $done = $done -1;
                    }
                }
            }


            //Check if the maingoal is finished and set it.
            if ($total == $done) {
                DB::table('learning_goals')->where('learning_id', $goalid)->update(array(
                    'learning_finished' => '1'
                ));
            }else {
                DB::table('learning_goals')->where('learning_id', $goalid)->update(array(
                    'learning_finished' => '0'
                ));
            }
        }

        DB::table('learning_goals')->where('learning_id', $id)->update(array(
            'learning_name' => $goalname,
            'learning_description' => $request->input('description'),
            'learning_finished' => $request->input('finished'),
            'learning_icon' => $request->input('icon')
        ));

      return redirect('/admin/goals/' . $goalid. '/' .$userid)->with('success', 'Leerdoel ' . $goalname . ' aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
      $learninggoal = DB::table('learning_goals')->where('learning_id', $id)->delete();
      $subgoals = DB::table('learning_goals')->where('learning_category', $id)->delete();

      return redirect('/admin/user/' . $request->input('userid'))->with('success', 'Leerdoel en subdoel(en) zijn verwijderd');
    }
}
