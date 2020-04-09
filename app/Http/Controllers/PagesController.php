<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function accueil()
    {
        $avantages = ["Expertise", "Réactivité", "Equipe à l'écoute"];
        $pseudo = request("pseudo");

        // 3 possibilités :
        // return view('accueil', ["avantages" => $avantages]);
        return view('accueil', compact("avantages", "pseudo"));
        // return view('accueil')->withAvantages($avantages);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function store()
    {
        //     // $email = request("email");
        //     request()->validate([
        //         "nom" => "required",
        //         "email" => "required|email",
        //         "message" => "required",
        //     ]);
        //     dd($email);
        //     // return view('contact');
        // }

        $champsValides = request()->validate([
            "nom" => "required",
            "email" => "required|email",
            "message" => "required",
        ]);
        // envoi de l'e-mail
        // $contenu = "Message : " . request("nom") . " <" . request("email") . ">\n" . request("message");
        // $contenu .= request("message");

        // Mail::to("mouazmouaz@hotmail.fr")->send(new Contact());
        // Mail::to("mouazmouaz@hotmail.fr")->send(new Contact($contenu));

        // Mail::raw($contenu, function ($message) {
        //     $message->from(request("email"))->to("mouazmouaz@hotmail.fr")->subject("Site");
        // });
        // return redirect("/contact"); // redirige vers la page contact

        //***********RECAP */
        //envoi de l'e-mail brut
        //$contenu = "Message de : ".request("nom")." <".request("email")."> :\n";
        //$contenu .= request("message");
        // Mail::raw($contenu, function ($message) {
        //     $message->from(request("email"))->to("alex.beaugrand@gmail.com")->subject("Site");
        // });

        //mail html
        $nom = request("nom");
        $email = request("email");
        $message = request("message");
        Mail::to("mouazmouaz@hotmail.fr")->send(new Contact($nom, $email, $message));
        return redirect()->back()->with("success", "Message envoyé !"); // redirige sur la page précédente et stocke le message contenu en param de with dans les SESSION Storage. (modif aussi à faire dans app.blade). Stocke une variable en session s'il existe bien deja une variable en session. La condition du si est précisée dans le app.blade. En gros ça permet d'avoir un message qui dit Message envoyé au rechargement de la page.
    }
}
