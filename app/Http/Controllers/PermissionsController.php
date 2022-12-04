<?php

namespace App\Http\Controllers;

use App\Models\permissions;
use App\Models\permissionsuser;
use App\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $permissions;
    public function __construct(Permissions $permissions)
    {
        $this->permissions = $permissions;
    }
    public function index()
    {
        $roles = Role::all();
        $permissions = permissions::all();
        return view('permissions.index',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->permissions::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'type_id' => $request->type_id,
            ]);
        session()->flash('Add', __('msg.addPermison'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function show($permissions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function edit($permissions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $permissions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permissions  $permissions
     * @return \Illuminate\Http\Response
     */
    public function destroy($permissions)
    {
        //
    }
}
