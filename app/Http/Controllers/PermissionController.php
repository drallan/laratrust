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
     * @param Request $request
     *
     * @return \View
     */
    public function index(Request $request)
    {
        $phrase = $request->get('phrase');
        $permissions = Permission::with('roles')->orderBy('name', 'ASC');
        if ($phrase) {
            $permissions->where('name', 'LIKE', '%'.$phrase.'%');
        }
        $permissions = $permissions->get();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \View
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     *
     * @return \Redirect
     */
    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());

        Flash::success('Permission created successfully');

        return redirect()->route('permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \View
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionRequest $request
     * @param int               $id
     *
     * @return \Redirect
     */
    public function update(PermissionRequest $request, $id)
    {
        Permission::find($id)->update($request->all());

        Flash::success('Permission updated successfully');

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Redirect
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();

        Flash::success('Permission deleted successfully');

        return redirect()->route('permissions.index');
    }
}
