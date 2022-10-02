<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 bg-light opacity-85" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="/"><img class="d-inline-block align-top img-fluid" src="{{asset('img/planting.svg')}}" alt="" width="50" /><span class="text-theme font-monospace fs-4 ps-2"></span></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="{{route('photo.index')}}">작물 진단</a></li>
                <li class="nav-item px-2"><a class="nav-link fw-medium" href="{{route('search.index')}}">병해충 정보</a></li>
            </ul>
            <form class="d-flex"action="/list" method="POST">
                @csrf
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
