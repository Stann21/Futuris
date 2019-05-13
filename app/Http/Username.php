<?php

namespace App\Http;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class Username {
    public function compose(View $view){
        $view->with('username', Auth::user()->username);
    }
}