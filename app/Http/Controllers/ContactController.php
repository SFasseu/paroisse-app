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

        return view("contact.index",compact('contacts'));
   

    
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
        'name'=> 'required',
        'email' => 'required|email',
        'adress' => 'required'     
        ],
        [
            'name.required' => 'le nom est requis',
            'email.required' => 'votre adresse email est requise',
            'email.unique' => 'adresse email deja prise',
            'adress.required' => 'adresse requise'
        ]);
         try {

            Contact::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'adress' => $request->adress,
                ]
            );

            return redirect('/contact')->with('success' , 'contact ajouter avec success');
         
            } catch (Exception $e) {
            
         }
        
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
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
       $contact->delete();
       return redirect('/contact')->with('success','contact supprimer');
       
    }
}
