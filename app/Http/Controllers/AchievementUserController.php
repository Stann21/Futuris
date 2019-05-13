<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\achievements_users;

class AchievementUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userid, $onwhat, $onwhatid) {
        $user = DB::table('users')->where('id', $userid)->first();
        $achievements = DB::table('achievements')->get();
        $goals = DB::table('learning_goals')->where('user_id', $userid)->get();

        return view ('backendpages.achievementUser.create')
            ->with('userid', $userid)
            ->with('user', $user)
            ->with('achievements', $achievements)
            ->with('onwhat', $onwhat)
            ->with('onwhatid', $onwhatid)
            ->with('goals', $goals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'achievement' => 'required',
            'title_achievement' => 'required',
            'description_achievement' => 'required',
        ]);

        $onwhat = $request->input('onwhat');

        switch($onwhat){
            case "0":
                $feedbackOn = 'Gebruiker';
                break;
            case "1":
                $feedbackOn = 'Hoofddoel';
                break;
            case "2":
                $feedbackOn = 'Subdoel';
                break;
        }


        $userid = $request->input('userid');
        $achievement = DB::table('achievements')->where('id', $request->input('achievement'))->first();

        $achievementsUser = new achievements_users;
        $achievementsUser->achievement_title = $request->input('title_achievement');
        $achievementsUser->achievement_description = $request->input('description_achievement');
        $achievementsUser->achievement_img = $achievement->achievements_img;
        $achievementsUser->achievement_client = $userid;
        $achievementsUser->achievement_subject = $feedbackOn;
        $achievementsUser->achievement_subjectid = $request->input('onwhatid');
        $achievementsUser->save();

        return redirect ('/admin/user/' . $userid)->with('success', 'Achievement is ingevoerd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $achievements = DB::table('achievements_users')->where('achievement_client', $id)->get();
        $user = DB::table('users')->where('id', $id)->first();


        return view ('backendpages.achievementUser.show')
            ->with('achievements', $achievements)
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $userid) {
        $achievements = DB::table('achievements')->get();
        $goals = DB::table('learning_goals')->where('user_id', $userid)->get();
        $current_achievement = DB::table('achievements_users')->where('id', $id)->first();

        return view ('backendpages.achievementUser.edit')
            ->with('achievements', $achievements)
            ->with('current_achievement', $current_achievement)
            ->with('goals', $goals)
            ->with('userid', $userid);

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
            'achievement' => 'required',
            'title_achievement' => 'required',
            'description_achievement' => 'required',
        ]);

        $achievement = DB::table('achievements')->where('id', $request->input('achievement'))->first();

        DB::table('achievements_users')->where('id', $id)->update(array(
            'achievement_title' => $request->input('title_achievement'),
            'achievement_description' => $request->input('description_achievement'),
            'achievement_img' => $achievement->achievements_img,
        ));

        return redirect('/admin/user/' . $request->input('userid'))->with('success', 'Achievement aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroys($achievement, $userid) {
        $delete_achievement = DB::table('achievements_users')->where('id', $achievement)->delete();

        return redirect('/admin/user/' . $userid)->with('success', 'Achievement is verwijderd');
    }
}
