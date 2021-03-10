<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Modules\Admin\Models\Setting;
 

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Setting::all();

        return view('admin::admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        request()->flash();
        return view('admin::admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Setting\Http\Requests\SettingRequest  $request
     * @param  \Modules\Admin\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        // dd($request->all());
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                Setting::where('settings_key', $key)->update([
                    'settings_key'    =>  $key,
                    'settings_value'    =>  $value
                ]);
            }
        }
 
        return redirect()->route('admin.settings.edit')->with('status', __('admin::lang.settingUpdated'));
    }

}
