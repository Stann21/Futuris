<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Achievement;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Illuminate\Support\Facades\Auth;
use File;

class AchievementController extends Controller
{
    public function index() {
        $achievements = DB::select("SELECT * FROM achievements");

        return view('backendpages.achievementpages.index')
            ->with('achievements',$achievements);
    }

    public function getAchievementsToFrontend() {
        $id = Auth::user()->id;
        $achievements = DB::table("achievements_users")->where('achievement_client',$id)->get();
        return view('pages.achievements')->with('achievements',$achievements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('backendpages.achievementpages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // $message =['achievements_title.required'=>'achievement moet ingevuld worden','achievements_description.required'=>'achievement beschrijving moet ingevuld worden','achievements_img.required'=>'achievements foto moet ingevuld worden'];
        $this->validate($request, [
            'achievements_title' => 'required|unique:achievements',
            'achievements_description' => 'required',
            'achievements_img'=>'image|required|max:1999'
        ]);//$message

        if($request->hasFile('achievements_img')){
            $filenamewithExt = $request->file('achievements_img')->getClientOriginalName();
             
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
            //Get just ext
            $extension = $request->file('achievements_img')->getClientOriginalExtension();
            
            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            //Upload Image
          
            $path = $request->file('achievements_img')->storeAs('public/images/',$fileNameToStore);

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

    
        //Get mentorID
        $achievementid = $request->input("achievements_title");
        
        $achievementid = DB::table('achievements')->where('achievements_title', $achievementid)->get();

        // Create Achievement
        $achievement = new Achievement; //User
        $achievement->achievements_title = $request->input('achievements_title');
        $achievement->achievements_description = $request->achievements_description;
        if($request->hasFile('achievements_img')){
        $achievement->achievements_img = $fileNameToStore;
        }
  
        $achievement->save();

      return redirect('/admin/achievement')->with('success', 'Achievement aangemaakt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($achievement_id) {
        $achievements = DB::table('achievements')->where('id', $achievement_id)->first();

        return view('backendpages.achievementpages.edit')
            ->with('achievements', $achievements);
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
            'achievements_title' => 'required',
            'achievements_description' => 'required',
        ]);//$message

        if($request->hasFile('achievements_img')){
            $filenamewithExt = $request->file('achievements_img')->getClientOriginalName();
             
            //Get just filename
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
            //Get just ext
            $extension = $request->file('achievements_img')->getClientOriginalExtension();
            
            //FileName to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
            //Upload Image
          
            $path = $request->file('achievements_img')->storeAs('public/images/',$fileNameToStore);

        }
    
        //Get achievementid
        $achievement = Achievement::find($id);
        $achievement->achievements_title = $request->input('achievements_title');
        $achievement->achievements_description = $request->achievements_description;
        if($request->hasFile('achievements_img')){
        $achievement->achievements_img = $fileNameToStore;
        }
  
        $achievement->save();
        // DB::table('achievements')->where('achievements_id', $id)->update(array(
        //     'achievements_title' => $request->input('achievements_title'),
        //     'achievements_description' => $request->input('achievements_description'),
        // ));
  

        return redirect('/admin/achievement/')->with('success', 'Achievement aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $achievements = Achievement::find($id);

        if($achievements->achievements_img !='noimage.jpg'){
            File::delete(public_path('public/images/'.$achievements->achievements_img));
        }

        $achievements->delete();       
        return redirect('/admin/achievement')->with('success', 'achievement verwijderd');
    }
}
