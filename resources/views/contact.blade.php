@extends("layouts.app")

@section("titre","Contact")

@section("contenu")

<form method="POST" action="/contact">

    @csrf

    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control {{ $errors->has("nom") ? "border border-danger" : "" }}" name="nom" id="nom" value="{{ old("nom") }}">
        @if($errors->has("nom"))
            <p class="text-danger">{{ $errors->first("nom") }}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control {{ $errors->has("email") ? "border border-danger" : "" }}" name="email" id="email" value="{{ old("email") }}">
        @if($errors->has("email"))
            <p class="text-danger">{{ $errors->first("email") }}</p>
        @endif
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control @error("message") border border-danger @enderror" name="message" id="message">{{ old("message") }}</textarea>
        @error("message")
            <p class="text-danger">{{ $errors->first("message") }}</p>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
    
</form>

@endsection