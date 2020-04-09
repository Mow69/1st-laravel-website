<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ["nom", "user_id", "media", "description"]; // utilisables dans Produit::create()
    //protected $guarded=[];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // ou avec un vendeur, on précise la clé étrangère "user_id" :
    public function vendeur()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    // selon les conventions en laravel :
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // ou si on veut nommer notre table de jointure autrement que selon la convention en produit_tag selon l'ordre alphabétique et la case
    //     public function tags()
    //     {
    //         // pour forcer la table de jointure à avoir un autre nom :
    //         return $this->belongsToMany(Tag::class, "jointure_tags_produits");
    //     }
}
