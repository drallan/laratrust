<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sysadmin');
    }

    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \View
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Redirect
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Client::create($request->input());

        flash()->success('Client has been created');

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \View
     */

    public function show($id)
    {
        $client = Client::find($id);

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \View
     */
    public function edit($id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $request
     * @param  int $id
     * @return \Redirect
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id,
            'address' => 'required',
            'phone' => 'required',
        ]);

        Client::find($id)->update($request->input());

        flash('Client updated successfully')->success();

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Redirect
     */
    public function destroy($id)
    {
        Client::find($id)->delete();

        flash()->success('Client has been deleted');

        return redirect()->route('clients.index');
    }
}
