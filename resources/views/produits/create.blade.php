@extends("layouts.app")

@section("titre","Nouveau produit")

@section("contenu")

{{-- <form>
   <label for="nom">Nom</label>
   <input type="text" class="form-control" name="nom" placeholder="nom">
   
   <div class="form-group">
      <label for="description">Email address</label>
      <textarea name="form-control" id="description" name="description"></textarea>
   </div>
   
   <button type="submit" class="btn btn-primary">Créer le produit</button>
</form> --}}
<form method="POST" action="/produits" enctype="multipart/form-data">

   @csrf

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control {{ $errors->has("nom") ? "border border-danger" : "" }}" name="nom" id="nom" value="{{ old("description") }}">
        @if($errors->has("nom"))
          <p class="text-danger">{{ $errors->first("nom") }}</p>
        @endif
      </div>
      
          <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Image</label>
                <div class="custom-file {{ $errors->has("media") ? "border border-danger" : "" }}">
                    <input type="file" class="custom-file-input " name="media" id="media" value="{{ old("media") }}">
                    <label class="custom-file-label" for="media"></label>
                </div>
                @if($errors->has("media"))
                    <p class="text-danger">{{ $errors->first("media") }}</p>
                @endif
            </div>
        </div>
        <div class="col">
            <div id="preview"></div>
        </div>
    </div>
      
      {{-- <div class="form-group">
         <label>Image</label>
         <div class="custom-file">
             <input type="file" class="custom-file-input {{ $errors->has("media") ? "border border-danger" : "" }}" name="media" id="media" value="{{ old("media") }}">
             <label class="custom-file-label" for="media">Merci de choisir un fichier</label>
         </div>
         @if($errors->has("media"))
             <p class="text-danger">{{ $errors->first("media") }}</p>
         @endif
     </div> --}}

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control @error("description") border border-danger @enderror" name="description" id="description">{{ old("description") }}</textarea>
        @error("description")
            <p class="text-danger">{{ $errors->first("description") }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <select name="tags[]" id="tags" multiple class="form-control">
            @foreach($tags as $tag)
                {{-- Si je préfère une liste déroulante de tags : --}}
                <option value="{{ $tag->id }}">{{ $tag->nom }}</option>
                {{-- ou si je préfère une checkbox :
                <div class="custom-control custom-checkbox">
                    <input value="{{ $tag->id }}" type="checkbox" id="{{$tag->slug}}" name="tags[]" class="custom-control-input" checked>
                    <label for="{{$tag->slug}}" class="custom-control-label">{{ $tag->nom }}</label>
                </div> --}}
            @endforeach
        </select>
        @error("tags")
            <p class="text-danger">{{ $errors->first("tags") }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Créer le produit</button>
    
</form>
   
@endsection
