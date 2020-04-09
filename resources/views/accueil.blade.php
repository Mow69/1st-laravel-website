@extends("layouts.app")

@section("titre","Bienvenue")

@section("contenu")

    <p>Vous bénéficiez des avantages :</p>

    <?php
        // foreach ($avantages as $avantage) {
        //     echo "$avantage<br>";
        // }
    ?>

    @foreach ($avantages as $avantage)
            {{$avantage}}
            <br>
    @endforeach

@endsection