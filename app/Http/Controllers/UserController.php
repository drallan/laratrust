<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-manage', ['except' => 'index']);
        $this->middleware('role:broker', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = User::with('client')->orderBy('name', 'ASC');
        if(\Auth::user()->client_id != Client::DEFAULT_CLIENT_ID) {
            $query->where('client_id', \Auth::user()->client_id);
        }
        $users = $query->paginate(10);

        return view('users.index', compact('users'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \View
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id')->all();
        $currentRoles = [];
        $clients = Client::pluck('name', 'id')->all();

        return view('users.create', compact('roles', 'currentRoles', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Redirect
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'Roles' => 'nullable'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $this->syncUserRoles($request, $user);

        flash()->success('User has been created');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \View
     */

    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name', 'id')->all();
        $currentRoles = $user->roles->pluck('id', 'id')->toArray();
        $clients = Client::pluck('name', 'id')->all();

        return view('users.edit', compact('user', 'roles', 'currentRoles', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Redirect
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirm',
            'Roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        $this->syncUserRoles($request, $user);

        flash('User updated successfully')->success();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Redirect
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        flash()->success('User has been deleted');

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @param         $user
     */
    private function syncUserRoles(Request $request, $user)
    {
        if ($request->has('Roles')) {
            $user->roles()->sync($request->get('Roles', []));
        }
    }
}
