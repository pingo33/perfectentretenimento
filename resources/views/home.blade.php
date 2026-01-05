@extends('layouts.base')

@section('title', $title ?? 'Perfect Plataforma 360')

@section('content')

<!-- NAV / HEADER FIXO -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom sticky-top">
    <div class="container-xxl py-2">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="#topo">
            <img
                src="{{ asset('icones/3d06b323-30ad-4590-b6cd-fa2df97df6d3.jpg') }}"
                alt="Logo Perfect 360"
                class="rounded-circle me-2"
                style="width:40px;height:40px;object-fit:cover;"
            >
            <span class="fw-semibold">Perfect Entreterimento</span>
        </a>

        <!-- BOTÃO HAMBURGUER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- LINKS -->
        <div class="collapse navbar-collapse justify-content-end" id="menuNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link link-light" href="#servicos">Serviços</a></li>
                <li class="nav-item"><a class="nav-link link-light" href="#videos">Vídeos</a></li>
                <li class="nav-item"><a class="nav-link link-light" href="#depoimentos">Depoimentos</a></li>
                <li class="nav-item"><a class="nav-link link-light" href="#contato">Contato</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO / CARROSSEL -->
<section id="topo" class="bg-black">
    <div id="carouselHero" class="carousel slide hero-carousel" data-bs-ride="carousel">

        <div class="carousel-indicators">
            @foreach($images as $i => $img)
                <button type="button"
                        data-bs-target="#carouselHero"
                        data-bs-slide-to="{{ $i }}"
                        class="{{ $i === 0 ? 'active' : '' }}"
                        @if($i === 0) aria-current="true" @endif>
                </button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($images as $i => $img)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <img
                        src="{{ asset($img) }}"
                        class="d-block w-100 hero-img"
                        alt="Imagem {{ $i + 1 }}"
                        loading="{{ $i === 0 ? 'eager' : 'lazy' }}"
                    >
                    <div class="carousel-caption d-none d-md-block">
                        <h2 class="display-6 fw-bold text-shadow">Experiências 360°</h2>
                        <p class="lead text-shadow">
                            Tecnologia + criatividade para momentos inesquecíveis
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
</section>

@php
    $urlInsta = 'https://www.instagram.com/perfect.plataforma360/?igsh=ejI1czR2cnNmb2V2&utm_source=qr';
@endphp

<!-- SOBRE -->
<section id="sobre" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="text-center">
                    <span class="d-inline-block text-uppercase fw-bold text-warning mb-2" style="letter-spacing:2px;">
                        Quem Somos
                    </span>

                    <h2 class="display-4 fw-bold text-white mb-3">
                        A <span class="text-warning">Perfect Entreterimento</span>
                    </h2>

                    <p class="lead text-light mb-5">
                        Há <strong>19 anos</strong> transformando eventos em experiências inesquecíveis.
                        Com mais de <strong>1.000</strong> projetos realizados, unimos
                        <span class="text-warning">criatividade</span> e
                        <span class="text-warning">tecnologia</span>.
                    </p>
                </div>

                <!-- KPIs -->
                <div class="row g-4 mb-5 text-center">
                    @php
                        $kpis = [
                            ['icon'=>'trophy-fill','value'=>'19+','label'=>'anos de história'],
                            ['icon'=>'calendar-event-fill','value'=>'1.000+','label'=>'eventos'],
                            ['icon'=>'people-fill','value'=>'2.000+','label'=>'seguidores'],
                            ['icon'=>'star-fill','value'=>'5★','label'=>'avaliações'],
                        ];
                    @endphp

                    @foreach($kpis as $kpi)
                        <div class="col-6 col-md-3">
                            <div class="p-4 bg-dark rounded-3 border border-secondary h-100">
                                <i class="bi bi-{{ $kpi['icon'] }} fs-1 text-warning mb-2"></i>
                                <div class="fs-2 fw-bold text-warning">{{ $kpi['value'] }}</div>
                                <div class="small text-secondary">{{ $kpi['label'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- BOTÕES SOCIAIS -->
                <div class="d-flex justify-content-center">
                    <a href="{{ $urlInsta }}" target="_blank" class="btn btn-instagram px-4 py-2">
                        <img src="{{ asset('icones/instagram.webp') }}" width="20" class="me-2">
                        Instagram
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- VÍDEOS -->
<section id="videos" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-warning">Experiências em Vídeo</h2>
            <p class="text-secondary">Confira momentos incríveis feitos por nós</p>
        </div>

        <div id="videoCarousel" class="carousel slide">
            <div class="carousel-inner ratio ratio-16x9" id="carousel-content"></div>
            <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<!-- SERVIÇOS -->
<section id="servicos" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl">
        <div class="row g-3">
            @foreach($services as $svc)
                <div class="col-12 col-md-6 col-lg-3">
                    <button
                        class="btn w-100 text-start p-4 bg-dark border border-secondary d-flex gap-3 service-btn"
                        data-service="{{ $svc['key'] }}"
                        data-title="{{ $svc['title'] }}"
                    >
                        <img src="{{ asset($svc['icon']) }}" width="70" class="rounded-circle">
                        <span>
                            <strong>{{ $svc['title'] }}</strong><br>
                            <small class="text-secondary">{{ $svc['desc'] }}</small>
                        </span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CONTATO -->
<section id="contato" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl" style="max-width:760px">

        <h2 class="fw-bold mb-3">Entre em Contato</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('home') }}" class="p-4 bg-dark border border-secondary rounded-3">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input name="nome" class="form-control" value="{{ old('nome') }}" required>
                @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mensagem</label>
                <textarea name="mensagem" rows="4" class="form-control" required>{{ old('mensagem') }}</textarea>
                @error('mensagem') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>
</section>

<footer class="py-4 text-center text-secondary border-top">
    © 2025 Perfect Entreterimento
</footer>

@endsection
