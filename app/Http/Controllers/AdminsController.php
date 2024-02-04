<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Admins = Admin::get();
        return view('users', compact('Admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Adduser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only("username", "fullname", "email", "active", "password");
        //$data["image"]=$this->uploadFile($request->image,"admin/Teacher/images");
        $data["active"] = isset($request->active);
        Admin::create($data);
        //Alert::success("Add ","Add Successfully");
        //return redirect()->back();
        return redirect('users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = Admin::findOrFail($id);
        return view('users', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = Admin::get();
        $user = Admin::findOrFail($id);
        return view('updateuser', compact('user', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only("username", "fullname", "email", "active", "password");
        $data["active"] = isset($request->active);
        Admin::where('id', $id)->update($data);
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
