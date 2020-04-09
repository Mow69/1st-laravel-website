<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("slug");
            $table->timestamps();
        });

        Schema::create('produit_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("produit_id");
            $table->unsignedBigInteger("tag_id");
            $table->timestamps();
            $table->unique(["produit_id", "tag_id"]);
            $table->foreign("produit_id")->references("id")->on("produits")->onDelete("cascade");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('produit_tag');
    }
}
