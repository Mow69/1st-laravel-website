<?php

namespace App\Http\Controllers;

use App\Produit;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     if (request("tag")) {
    //         $tag = Tag::find(request("tag"));
    //         // $tag = Tag::findOrFail(request("tag")); // méthode qui renvoie une 404 si non trouvé.
    //         if ($tag) {
    //             $produits = $tag->produits;
    //         } else {
    //             // redirection
    //             // return redirect("/produits");


    //             //ou si je dis que le produit est vide, càd que le produit existe et pourrait être transmis mais contient une collection de tableau vide.
    //             $produits = collect([]);
    //         }
    //         // $produits = Tag::find(request("tag"))->produits;
    //         $produits = Produit::all();
    //     }
    //     return view("produits.index", compact("produits"));
    // }
    public function index()
    {
        if (request("tag")) {
            $tag = Tag::where("slug", request("tag"))->first();
            // $tag = Tag::find(request("tag")); // mais le find() fonctionne avec un clé primaire mais pas avec un mot comme le slug
            //$tag=Tag::findOrFail(request("tag"));//404 si non trouvé
            if ($tag) {
                $produits = $tag->produits;
            } else {
                //redirection
                //return redirect("/produits");
                $produits = collect([]);
            }
        } else {
            $produits = Produit::all();
        }
        return view("produits.index", compact("produits"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("produits.create", ["tags" => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Produit $produit)
    // public function store(Produit $produit)
    // public function store(Request $request)
    {
        // plus besoins :
        // $champsValides = request()->validate([
        //     "nom" => "required",
        //     "description" => "required|min:10|max:255"
        //     // "description"=>"required","min:10","max:255" 
        // ]);
        // si :
        // $produit->update($this->validerProduit());
        // $champsValides = $this->validerProduit();
        // $uploadPath = request()->file("media")->store("public/medias");
        // $champsValides["media"] = $uploadPath;

        $champsValides = $this->validerProduit();
        if (request("media") != null) {
            // if (request()->has("media")) {
            $uploadPath = request()->file("media")->store("public/medias");
            $champsValides["media"] = $uploadPath;
        } else {
            $champsValides["media"] = "";
        }

        //on rajoute user_id la clé étrangère, on met 1 pr le moment mais on mettra plus tard une config avec OAuth :
        // $champsValides["user_id"] = 1;
        // pour récupérer l'user, on récupère l'id de l'user connecté, mais par défaut la façade Auth ici n'est pas importée il faut chercher l'import correspondant  : 
        $champsValides["user_id"] = Auth::user()->id;
        $produit->update($champsValides);

        // Produit::create($champsValides);
        // return redirect("/produits");

        // dd($champsValides);

        // 1ère méthode sans ::create :
        // $produit = new Produit();
        // $produit->nom = request("nom");
        // $produit->description = request("description");
        // $produit->save();
        // return redirect("/produits");

        // dump(request());
        // dump(request()->all());
        // dump(request()->get("nom"));
        // dump(request()->input("nom"));
        // dump(request()->get("description"));
        // dump(request()->input("description"));
        // dump(request()->request());
        // dump(request()->request("nom"));
        // dump(request()->request("description"));

        // 2nde méthode avec ::create :
        $produit = Produit::create(
            // soit:
            //soit :
            // [
            // "nom" => request("nom"),
            // "description" => request("description"),
            // ]
            //soit :
            // $champsValides(
            // sinon :
            // $this->validerProduit()
            $champsValides
        );

        $produit->tags()->attach(request("tags"));

        return redirect("/produits");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        return view("produits.show", compact("produit"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    // public function edit(Produit $idproduit)
    {
        $tags = Tag::all();

        // $produit = Produit::find($idproduit);
        // return $produit;
        return view("produits.edit", compact("produit", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Produit $produit)
    {

        $champsValides = $this->validerProduit();
        if (request("media") != null) {
            $uploadPath = request()->file("media")->store("public/medias");
            $champsValides["media"] = $uploadPath;
        } else {
            $champsValides["media"] = $produit->media;
        }
        $produit->update($champsValides);

        $produit->tags()->sync(request("tags"));

        return redirect("/produits");

        // plus besoin de :
        // $champsValides = request()->validate([
        //     "nom" => "required",
        //     "description" => "required|min:10|max:255"
        // ]);
        // si :
        // $produit->update($this->validerProduit());


        // return $produit;
        //soit en plus simplifié:
        // $produit->update($champsValides);

        // soit mais moins simplifié :
        // $produit->nom = request("nom");
        // $produit->description = request("description");
        // $produit->update();

        // return redirect("/produits");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect("/produits");
    }

    //valide un produit
    protected function validerProduit()
    {
        //dd(request()->all());
        return request()->validate([
            "nom" => "required",
            "media" => "nullable|mimes:jpeg,jpg,png,gif,svg,mp4,ogx,oga,ogv,ogg,webm|max:10240",
            // "media" => "required|max:10240|mimes:jpeg,jpg,png,gif,svg,mp4,ogx,oga,ogv,ogg,webm",
            "description" => "required|min:10|max:255"
        ]);
    }
}
