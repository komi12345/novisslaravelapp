<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    /**
     * Traite l'envoi du formulaire de contact
     */
    public function send(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Créer une instance de l'email
        $mail = new ContactFormMail($validatedData);

        // Envoyer l'email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send($mail);

        // Retourner une réponse JSON pour les requêtes AJAX
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Votre message a été envoyé avec succès.']);
        }

        // Redirection avec message de succès pour les requêtes normales
        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}