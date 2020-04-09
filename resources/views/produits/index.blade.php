@extends("layouts.app")

@section("titre","Produits")

@section("contenu")

<div class="row">
      @forelse($produits as $produit)
        {{-- <a href="/produits/{{ $produit->id }}">{{ $produit->nom }}</a> --}}
        <div class="col d-flex justify-content-center col-sm-6 col-md-4">
            @include("partiels._produit",["afficherBtVoir"=>true])
        </div>
    @empty
        <div class="col d-flex justify-content-center col-sm-6 col-md-4">
            <p>Aucun produit.</p>
        </div>
    @endforelse

</div>

<div class="row">
    <div class="col">
        <hr>
        {{-- <a class="bt btn-sm btn-outline-secondary {{ Request::is("produits")?"active":"" }}" href="{{ route("produits.index") }}">Ajouter Produit</a> --}}
        {{-- <a href="{{ route("produits.show",$produit->id) }}">{{ $produit->nom }}</a> --}}
        <a class="btn btn-sm btn-outline-secondary" href="/produits/create">Ajouter un Produit</a>
</div>
</div>


@endsection
