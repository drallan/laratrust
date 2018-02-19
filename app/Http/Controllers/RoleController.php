<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller {

    public function __construct()
    {
        $this->middleware('permission:update-acl');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \View
     */
	public function index()
	{
		$roles = Role::orderBy('id', 'DESC')->paginate(10);

		return view('roles.index', compact('roles'))->with('i');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$permissions = Permission::get();

		return view('roles.create', compact('permissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{
		$this->validate(
			$request, [
				'name' => 'required|unique:roles,name',
				'display_name' => 'required',
				'permission' => 'nullable',
			]
		);

		$role = Role::create($request->input());

		$role->syncPermissions($request->input('permission'));

		flash()->success('Role created successfully');

		return redirect()->route('roles.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$role = Role::find($id);

		return view('roles.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$role = Role::find($id);

		$permissions = Permission::all();

		$rolePermissions = $role->permissions()
            ->pluck('permission_role.permission_id', 'permission_role.permission_id')
            ->all();

		return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate(
			$request, [
				'name' => 'required',
				'display_name' => 'required',
				'permission' => 'nullable',
			]
		);

		$role = Role::find($id);
		$role->update($request->input());

		$role->syncPermissions($request->input('permission') );

		flash()->success('Role has been updated');

		return redirect()->route('roles.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Role::find($id)->delete();

		flash()->success('Role has been deleted');

		return redirect()->route('roles.index');
	}
}
