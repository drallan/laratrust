<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use Exception;
use Flash;
use App\Models\Role;
use Redirect;
use Response;
use View;

class RoleController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:update-acl');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name', 'ASC')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $permissions = Permission::orderBy('display_name', 'ASC')->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     *
     * @return Redirect
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());

        $role->syncPermissions($request->get('permissions'));

        Flash::success('Role created successfully');

        return redirect()->route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return View
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $permissions = Permission::orderBy('display_name', 'ASC')->get();

        $rolePermissions = $role->permissions()->pluck('permission_role.permission_id', 'permission_role.permission_id')->all();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param int         $id
     *
     * @return Redirect
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->all());

        $role->syncPermissions($request->get('permissions'));

        Flash::success('Role updated successfully');

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();

        Flash::success('Role deleted successfully');

        return redirect()->route('roles.index');
    }
}
