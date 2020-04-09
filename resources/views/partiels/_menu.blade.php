<div class="row mt-2 mb-5">
    <div class="col">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link {{ Request::path()=="/"?"active":"" }}" href="/">Accueil</a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link {{ Request::is("produits")?"active":"" }}" href="/produits">Produits</a> --}}
                {{-- ou si j'ai bien un .name() dans web.php je peux faire : --}}
                <a class="nav-link {{ Request::is("produits")?"active":"" }}" href="{{ route("produits.index") }}">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is("about")?"active":"" }}" href="/about">A propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is("contact")?"active":"" }}" href="/contact">Contact</a>
            </li>
        </ul>
    </div>
</div>

{{-- AVANT MODIFS : --}}
{{-- <div class="row mt-2 mb-5">
    <div class="col">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link 
                {{ Request::path()=="/"?"active":""}}" 
                href="/">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is("about")?"active":""}}" 
             href="/about">A propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is("contact")?"active":""}}" 
                href="/contact">Contact</a>
            </li>
        </ul>
    </div>
</div> --}}