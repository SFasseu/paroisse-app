<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $fillable = ['name', 'email', 'address'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();  //select * from contacts;

        return view('contact.index', compact('contacts'));

        dd($contacts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $contact = Contact::findOrFail($id);
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
         return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
