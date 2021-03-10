<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\AdminRequest;

use Spatie\Permission\Models\Role;
use Modules\Admin\Models\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'name' => [request('name'), 'like'], 
            'email' => [request('email'), 'like'], 
            'admins_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Admin::sorted();

        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('admins_id', '!=', 1);
        }
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $admins = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('admin::admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->all());
        $admin->syncRoles(request('roles'));

        return redirect()->route('admin.admins.index')->with('status', __('admin::lang.adminCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin::admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        // return auth()->user()->admins_type ;
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('admin::admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\AdminRequest  $request
     * @param  \Modules\Admin\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->all());
        $admin->syncRoles(request('roles'));
        if(auth()->user()->admins_type != 'admin'){
            return view('admin::admin.admins.show', compact('admin'));
        }
        return redirect()->route('admin.admins.index')->with('status', __('admin::lang.adminUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        
        return back()->with('status', __('admin::lang.adminDeleted'));
    }
}
