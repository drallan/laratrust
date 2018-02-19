<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Flash;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update-acl');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index()
	{
		$permissions = Permission::orderBy('id', 'DESC')->paginate(10);

		return view('permissions.index', compact('permissions'))->with('i');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function create()
	{
		return view('permissions.create');
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
				'name'         => 'required',
				'display_name' => 'required',
			]
		);

		Permission::create($request->all());

		Flash::success('Permission created successfully');

		return redirect()->route('permissions.index');
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
		$permission = Permission::find($id);

		return view('permissions.show', compact('permission'));
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
		$permission = Permission::find($id);

		return view('permissions.edit', compact('permission'));
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
				'name'         => 'required',
				'display_name' => 'required',
			]
		);
		Permission::find($id)->update($request->input());

		Flash::success('Permission updated successfully');

		return redirect()->route('permissions.index');
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
		Permission::find($id)->delete();

		Flash::success('Permission deleted successfully');

		return redirect()->route('permissions.index');
	}
}
