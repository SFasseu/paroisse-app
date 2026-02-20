<?php

namespace App\Http\Controllers;

// On importe le modèle Contact
use App\Models\Contact;

// On importe Request pour récupérer les données du formulaire
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Afficher tous les contacts (READ)
     */
    public function index()
    {
        // Récupère tous les contacts dans la base de données
        // Equivalent SQL : SELECT * FROM contacts
        $contacts = Contact::all();

        // Envoie les données à la vue contact/index.blade.php
        return view('contact.index', compact('contacts'));
    }

    /**
     * Afficher le formulaire d'ajout (CREATE - formulaire)
     */
    public function create()
    {
        // Affiche la page create.blade.php
        return view('contact.create');
    }

    /**
     * Enregistrer un nouveau contact (CREATE - insertion)
     */
    public function store(Request $request)
    {
        // Insère les données dans la base de données
        // Les valeurs viennent du formulaire
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'phone' => $request->phone,
        ]);

        // Redirige vers la page index après insertion
        return redirect()->route('contact.index');
    }

    /**
     * Afficher un seul contact (READ - détail)
     */
    public function show(Contact $contact)
    {
        // Laravel récupère automatiquement le contact grâce au Route Model Binding
        return view('contact.show', compact('contact'));
    }

    /**
     * Afficher le formulaire de modification (UPDATE - formulaire)
     */
    public function edit(Contact $contact)
    {
        // Envoie le contact à modifier vers edit.blade.php
        return view('contact.edit', compact('contact'));
    }

    /**
     * Mettre à jour un contact (UPDATE - modification)
     */
    public function update(Request $request, Contact $contact)
    {
        // Met à jour les données du contact sélectionné
        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'phone' => $request->phone,            

        ]);

        // Retourne vers la page index après modification
        return redirect()->route('contact.index');
    }

    /**
     * Supprimer un contact (DELETE)
     */
    public function destroy(Contact $contact)
    {
        // Supprime le contact de la base de données
        $contact->delete();

        // Retourne vers la page index après suppression
        return redirect()->route('contact.index');
    }
}
