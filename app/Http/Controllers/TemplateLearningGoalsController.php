<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\template_goals;
use App\Icon;
use vendor\project\StatusTest;


class TemplateLearningGoalsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $learningGoal = 'Hoofdleerdoel';
        $templates = template_goals::AllLearningGoals($learningGoal)->get();

        return view ('backendpages.templategoals.index')
            ->with('templates', $templates)
            ->with('title', 'Leerdoelen template')
            ->with('link', '/admin/goalstemplate/create/2/0')
            ->with('linktext', 'Nieuwe template aanmaken');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($goal, $goalid) {
        $learninggoal = template_goals::GetSingleGoal($goalid);
        $icons = Icon::IconByName();

        switch ($goal) {
            case '2':
                $name = 'Template Hoofddoel';
                $title = 'Template aanmaken';
                $link = '/admin/goalstemplate';
                break;
            case '3':
                $name = 'Template Subdoel';
                $title = 'Subdoel aanmaken';
                $link = '/admin/goalstemplate/' . $goalid;
                break;
        }

        return view ('backendpages.goals.create')
            ->with('icons', $icons)
            ->with('learninggoal', $learninggoal)
            ->with('goal', $goal)
            ->with('goalid', $goalid)
            ->with('name', $name)
            ->with('title', $title)
            ->with('link', $link)
            ->with('linktext', 'Terug');
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
            'icon' => 'required',
            'ending' => 'required',
        ]);

        $categoryName =  $request->input('category_name');

        // Create LearningGoal
        $templateGoals = new template_goals;
        $templateGoals->template_category = $request->input('category_name');
        $templateGoals->template_name = $request->input('name_goal');
        $templateGoals->template_icon = $request->input('icon');
        $templateGoals->template_role = $request->input('role');
        $templateGoals->template_description = $request->input('description');
        $templateGoals->template_finish = $request->input('ending');
        $templateGoals->save();

        if (empty($goalid)) {
            return redirect('/admin/goalstemplate/'  . $categoryName)->with('success', 'Leerdoel aangemaakt!');
        }else {
            return redirect('/admin/goalstemplate')->with('success', 'Leerdoel aangemaakt');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $goals = template_goals::GetSingleGoal($id);
        $subgoals = template_goals::GetSubgoals($id);
        $name = 'Template';

        return view('backendpages.goals.show')
            ->with('goals', $goals)
            ->with('subgoals', $subgoals)
            ->with('name', $name)
            ->with('title', $goals->template_name)
            ->with('link', '/admin/goalstemplate')
            ->with('linktext', 'Terug');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($goalid, $goal) {
        $learninggoal = template_goals::getSingleGoal($goalid);
        $icons = Icon::IconByName();

        switch ($goal) {
            case '2':
                $name = 'Template Hoofddoel';
                break;
            case '3':
                $name = 'Template Subdoel';
                break;
        }

      return view('backendpages.goals.edit')
          ->with('learninggoal', $learninggoal)
          ->with('goal', $goal)->with('goalid', $goalid)
          ->with('icons', $icons)
          ->with('name', $name)
          ->with('title', $learninggoal->template_name . ' aanpassen')
          ->with('link', '/admin/goalstemplate/'  . $goalid)
          ->with('linktext', 'Terug');
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
            'name_goal' => 'required',
        ]);

        //Userid
        $userid = $request->input('userid');
        $goalid = $request->input('category_name');
        $goalname = $request->input('name_goal');
        $goal = $request->input('goal');

        if ($goal == '0') {
            DB::table('template_goals')->where('template_category', $goalid)->update(array(
                'template_icon' => $request->input('icon')
            ));
        }

        DB::table('template_goals')->where('template_id', $id)->update(array(
            'template_name' => $goalname,
            'template_description' => $request->input('description'),
            'template_icon' => $request->input('icon')
        ));

        return redirect('/admin/goalstemplate/' . $goalid)->with('success', 'Leerdoel ' . $goalname . ' aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $learninggoal = DB::table('template_goals')->where('template_id', $id)->delete();
        $subgoals = DB::table('template_goals')->where('template_category', $id)->delete();

        return redirect('/admin/goalstemplate')->with('success', 'Template en de bijbehorende subdoelen zijn verwijderd');

    }
}
