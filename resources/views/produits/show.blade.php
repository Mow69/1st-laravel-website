@extends("layouts.app")

@section("titre","Produit " . $produit->id)

@section("contenu")

<div class="row">
    <div class="col d-flex justify-content-center">
        @include("partiels._produit",["afficherBtVoir"=>false])
    </div>
</div>

@auth    
    <div class="row">
        <div class="col">
            <hr>
            <a class="btn btn-sm btn-outline-secondary" href="/produits/{{ $produit->id }}/edit">Modifier</a>
            <form method="POST" action="/produits/{{ $produit->id }}" class="d-inline">
                @csrf
                @method("DELETE")
                <input type="submit" class="btn btn-sm btn-outline-danger" value="Supprimer">
            </form>
        </div>
    </div>
@endauth

@endsection