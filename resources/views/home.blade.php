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

                <!-- Texto justificado -->
                <div class="mx-auto mb-5 text-justify" style="max-width: 900px;">
                    <p class="lead text-light">
                        Temos diversos serviços exclusivos para divertir, encantar e animar o seu evento.
                        Entre eles, destacamos a <strong class="text-warning">Plataforma 360</strong>,
                        que produz vídeos dinâmicos e imersivos, muitas vezes em câmera lenta.
                        Esses vídeos podem ser editados com efeitos especiais e compartilhados nas redes sociais,
                        tornando-se uma experiência moderna e inesquecível.
                    </p>

                    <p class="lead text-light">
                        Outro sucesso é o <strong class="text-warning">Túnel de LED</strong>,
                        uma estrutura formada por painéis iluminados que criam um corredor visualmente impactante e
                        instagramável.
                        É a escolha perfeita para surpreender convidados e valorizar ainda mais o ambiente do seu
                        evento.
                    </p>

                    <p class="lead text-light">
                        Para quem busca interação e diversão, oferecemos o <strong class="text-warning">Totem
                            móvel</strong>.
                        Diferente dos totens fixos, ele circula entre os convidados, capturando fotos criativas e
                        espontâneas por meio de um iPad em suporte especial.
                        Uma atração que garante registros únicos e aproxima ainda mais o público.
                    </p>

                    <p class="lead text-light">
                        E, claro, não poderia faltar a <strong class="text-warning">Cabine espelhada 3D</strong>,
                        também conhecida como “espelho mágico”.
                        Essa cabine de fotos interativa combina tecnologia, design sofisticado e personalização,
                        oferecendo fotos e vídeos com efeitos especiais.
                        Todo o conteúdo pode ser compartilhado instantaneamente via QR Code, e-mail ou redes sociais,
                        garantindo um toque de glamour e uma experiência verdadeiramente instagramável.
                    </p>
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
        <div class="text-center mb-4">
            <h2 class="fw-bold text-warning">Serviços</h2>
            <p class="text-secondary">Clique para ver a galeria</p>
        </div>

        <div class="row g-3">
            @foreach ($services as $svc)
                <div class="col-12 col-md-6 col-lg-3">
                    <button
                        type="button"
                        class="btn w-100 text-start p-4 rounded-3 bg-dark border border-secondary shadow-sm d-flex align-items-center gap-3 service-btn"
                        data-service="{{ $svc['key'] }}"
                        data-title="{{ $svc['title'] }}"
                    >
                        <img
                            src="{{ asset($svc['icon']) }}"
                            alt=""
                            width="70"
                            height="70"
                            class="img-fluid rounded-circle"
                        >

                        <span>
                            <strong class="text-white">{{ $svc['title'] }}</strong><br>
                            @if (!empty($svc['desc']))
                                <small class="text-secondary">{{ $svc['desc'] }}</small>
                            @endif
                        </span>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MODAL REUTILIZÁVEL PARA VÍDEOS -->
<div class="modal fade" id="servicoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border border-secondary rounded-3">

            <div class="modal-header border-secondary">
                <h5 class="modal-title">
                    <span id="modalServiceName">Galeria</span>
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>
            </div>

            <div class="modal-body text-center">
                <div
                    id="servicoCarousel"
                    class="carousel slide border border-secondary rounded-3"
                >
                    <div
                        class="carousel-indicators m-0 p-3 bg-black bg-opacity-25"
                        id="servico-indicators"
                    ></div>

                    <div class="carousel-inner" id="servico-inner"></div>

                    <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#servicoCarousel"
                        data-bs-slide="prev"
                    >
                        <span class="carousel-control-prev-icon"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>

                    <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#servicoCarousel"
                        data-bs-slide="next"
                    >
                        <span class="carousel-control-next-icon"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
                </div>
            </div>

            <div class="modal-footer border-secondary">
                <button
                    type="button"
                    class="btn btn-outline-light"
                    data-bs-dismiss="modal"
                >
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- DEPOIMENTOS -->
<section id="depoimentos" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-warning">O que dizem nossos clientes</h2>
            <p class="text-secondary mb-0">Depoimentos de quem viveu a experiência</p>
        </div>

        <div
            id="carouselDepo"
            class="carousel slide rounded-3 shadow-sm overflow-hidden border border-secondary"
            data-bs-ride="carousel"
            data-bs-interval="7000"
            data-bs-pause="hover"
        >
            <div class="carousel-inner bg-dark">

                <!-- SLIDE 1 -->
                <div class="carousel-item active">
                    <div class="p-4 d-flex flex-column align-items-center text-center">
                        <p class="mb-3 lead">“A plataforma 360 foi o grande destaque da nossa festa!”</p>

                        <div class="d-flex align-items-center gap-3">
                            <!-- BOLINHA COM VÍDEO -->
                            <div class="depo-avatar">
                                <video
                                    class="depo-video"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    preload="metadata"
                                >
                                    <source
                                        src="{{ asset('galerias/depoimentos/video-12.mp4') }}"
                                        type="video/mp4"
                                    >
                                </video>
                            </div>

                            <div class="text-start">
                                <strong>Maria Fernandes</strong><br>
                                <small class="text-secondary">Evento Corporativo</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2 -->
                <div class="carousel-item">
                    <div class="p-4 d-flex flex-column align-items-center text-center">
                        <p class="mb-3 lead">“O túnel de LED deixou a entrada incrível!”</p>

                        <div class="d-flex align-items-center gap-3">
                            <div class="depo-avatar">
                                <video
                                    class="depo-video"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    preload="metadata"
                                >
                                    <source
                                        src="{{ asset('galerias/depoimentos/video-3.mp4') }}"
                                        type="video/mp4"
                                    >
                                </video>
                            </div>

                            <div class="text-start">
                                <strong>João Oliveira</strong><br>
                                <small class="text-secondary">Aniversário</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3 -->
                <div class="carousel-item">
                    <div class="p-4 d-flex flex-column align-items-center text-center">
                        <p class="mb-3 lead">“Nosso chá revelação foi perfeito! Todo mundo quis participar.”</p>

                        <div class="d-flex align-items-center gap-3">
                            <div class="depo-avatar">
                                <video
                                    class="depo-video"
                                    autoplay
                                    muted
                                    loop
                                    playsinline
                                    preload="metadata"
                                >
                                    <source
                                        src="{{ asset('galerias/depoimentos/video-6.mp4') }}"
                                        type="video/mp4"
                                    >
                                </video>
                            </div>

                            <div class="text-start">
                                <strong>Camila Souza</strong><br>
                                <small class="text-secondary">Chá Revelação</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselDepo"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>

            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselDepo"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
    </div>
</section>

<!-- CONTATO -->
<section id="contato" class="py-6 bg-black text-light border-top border-secondary">
    <div class="container-xxl" style="max-width: 760px;">

        <!-- Cabeçalho: título à esquerda + WhatsApp à direita -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
            <h2 class="fw-bold mb-0">Entre em Contato</h2>

            @php
                $whatsText = urlencode(
                    'Olá, obrigado por entrar em contato com a Perfect360. Em que posso te ajudar?'
                );
            @endphp

            <a
                href="https://wa.me/5522992816997?text={{ $whatsText }}"
                target="_blank"
                class="btn btn-whatsapp px-4 py-2"
                onclick="window.gtag && gtag('event','click_whatsapp',{page: location.pathname});"
            >
                <img
                    src="{{ asset('icones/whatsapp.webp') }}"
                    alt="WhatsApp"
                    width="20"
                    height="20"
                    class="me-2 align-text-bottom"
                >
                Falar no WhatsApp
            </a>
        </div>

        <p class="text-secondary mb-4">Vamos conversar sobre seu próximo evento?</p>

        {{-- Flash messages (equivalente ao messages do Django) --}}
        @if (session('success'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3" role="alert">
                Verifique os campos do formulário.
            </div>
        @endif

        <form
            action="{{ route('home') }}"
            method="post"
            class="p-4 rounded-3 border border-secondary bg-dark"
        >
            @csrf

            {{-- Honeypot simples (equivalente ao form.website) --}}
            <input type="text" name="website" style="display:none">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    value="{{ old('nome') }}"
                    class="form-control"
                    required
                >
                @error('nome')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required
                >
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mensagem" class="form-label">Mensagem</label>
                <textarea
                    name="mensagem"
                    id="mensagem"
                    rows="4"
                    class="form-control"
                    required
                >{{ old('mensagem') }}</textarea>
                @error('mensagem')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Enviar
            </button>
        </form>
    </div>
</section>


<footer class="py-4 text-center text-secondary border-top">
    © 2025 Perfect Entreterimento
</footer>

@endsection
