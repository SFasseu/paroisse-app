<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $contacts = Contact::all();

          return view('contact.index',compact('contacts'));
          
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'address'=>'required',
        'phone'=>'required',
        ]);
        Contact::create($request->all());
        return redirect('/contact')->with('success','contact ajouté');

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
           $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'address'=>'required',
        'phone'=>'required',
        ]);
        $contact->update($request->all());
       return redirect('/contact')->with('success','contact modifié');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/contact')->with('success','contact supprimé');
    }
}
