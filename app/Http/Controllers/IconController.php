<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Icon;
use Illuminate\Support\Facades\DB;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $icons = Icon::IconByName();
        return view('backendpages.icon.icon')
            ->with('icons', $icons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view ('backendpages.icon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'iconname' => 'required',
            'iconcode' => 'required',
        ]);

        // Create user
        $icon = new Icon;
        $icon->icon_name = $request->input('iconname');
        $icon->icon_code = $request->input('iconcode');
        $icon->save();

        return redirect('/admin/icon/create')->with('success', 'Icoon aangemaakt');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $icons = DB::table('icons')->where('icon_id', $id)->delete();
        return redirect('/admin/icon')->with('success', $icons . ' is verwijderd');
    }
}
