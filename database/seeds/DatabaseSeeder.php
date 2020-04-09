<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // compte admin
        $users = factory("App\User")->create([
            "name" => "Mouaz",
            "email" => "mouazmouaz@hotmail.fr",
            "password" => '$2y$10$lvdZ0P43XlP/3Xd7VCHTDOQx2e1vUT7N7p8zqXdEQxI1PTXflJsMW' // mettre ici des guillements simples sinon il interprète le $ et ce qui suit comme étant une variable avec des guillemets doubles
        ]);

        //4 utilisateurs
        $users = factory("App\User", 4)->create();

        //10 utilisateurs
        $produits = factory("App\Produit", 10)->create();

        //4 tags
        // $nomsTags = ["High-Tech", "Quotidien", "Vêtements", "Cosmétiques"];
        $nomsTags = ["Promo", "Produit vedette", "Satisfait ou remboursé", "Recommandé"];
        foreach ($nomsTags as $nomTag) {
            // factory("App\Tag")->create(["nom" => $nomTag]);
            factory("App\Tag")->create(["nom" => $nomTag, "slug" => Str::slug($nomTag)]);
        }

        // liaisons produits/tags
        foreach ($produits as $produit) {
            for ($i = 0; $i < 3; $i++) {
                // on va faire une jointure à notre produit :
                App\Tag::all()->random()->produits()->syncWithoutDetaching($produit->id);
            }
        }
    }
}
