<?php

namespace App\Http\Controllers;


use App\Models\Contact;
use Illuminate\Http\Request;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::get();
        return view('message', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Contact::get();
        return view('contact', compact('data'));
    }
    public function sendcontact(Request $request)
    {
        //return 'send contact us' . $request->fname;
        $data = $request->only("fname", "lname", "email", "message");
        Mail::to('info@email.com')->send(
            new ContactMail($data)
        );
        return "mail sent!";
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only("fname", "lname", "email", "message");
        Contact::create($data);
        Mail::to('info@email.com')->send(
            new ContactMail($data)
        );
        return "mail sent!";
        //return redirect('categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contacts = Contact::findOrFail($id);
        return view('showmessage', compact('contacts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
