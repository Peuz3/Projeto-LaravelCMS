<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = [];

        $dbSettings = Setting::get();

        foreach($dbSettings as $dbSetting)
        {
            $settings [$dbSetting['name'] ] = $dbSetting['content'];
        }


       return view('admin.settings.index',[
           'settings' => $settings
       ]);
    }
}
