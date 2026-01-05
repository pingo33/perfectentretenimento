// static/js/video-carousel.js
(() => {
  const CAROUSEL_ID = "videoCarousel";
  const CONTENT_ID = "carousel-content";
  const DOTS_ID = "carousel-indicators";

  // 'ratio-21x9' | 'ratio-16x9' | 'ratio-4x3' | 'ratio-1x1'
  const RATIO_CLASS = "ratio-21x9";

  const elCarousel = document.getElementById(CAROUSEL_ID);
  const elContent = document.getElementById(CONTENT_ID);
  const elDots = document.getElementById(DOTS_ID);
  if (!elCarousel || !elContent) return;

  // Helper: cria um item do carrossel com <video> lazy (data-src)
  const slideTemplate = (src, active) => `
    <div class="carousel-item ${active ? "active" : ""}">
      <div class="ratio ${RATIO_CLASS}">
        <video class="w-100 h-100"
               muted
               loop
               playsinline
               preload="metadata"
               poster=""
               style="object-fit: contain; display: block; background: black;">
          <source data-src="${src}" type="video/mp4">
          Seu navegador não suporta vídeos.
        </video>
      </div>
    </div>
  `;

  // Lazy-set do src real quando necessário
  function ensureVideoSrc(videoEl) {
    const source = videoEl.querySelector("source[data-src]");
    if (source && !source.src) {
      source.src = source.getAttribute("data-src");
      // Carrega o vídeo assim que o src real é aplicado
      videoEl.load();
    }
  }

  // Play/Pause control por slide
  function playActivePauseOthers() {
    const items = elContent.querySelectorAll(".carousel-item");
    items.forEach(item => {
      const video = item.querySelector("video");
      if (!video) return;
      if (item.classList.contains("active")) {
        ensureVideoSrc(video);
        // Autoplay normalmente exige muted + user gesture; com playsinline+muted funciona no iOS
        const tryPlay = video.play?.();
        if (tryPlay && typeof tryPlay.then === "function") {
          tryPlay.catch(() => {/* silencioso */ });
        }
      } else {
        video.pause?.();
      }
    });
  }

  // Observa quando o carrossel entra na viewport: só aí carrega/começa
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        playActivePauseOthers();
      } else {
        // fora de viewport: pausa tudo
        elContent.querySelectorAll("video").forEach(v => v.pause?.());
      }
    });
  }, { threshold: 0.2 });

  // Evento do Bootstrap ao finalizar a transição de slide
  function bindBootstrapEvents() {
    elCarousel.addEventListener("slid.bs.carousel", () => {
      playActivePauseOthers();
    });
    elCarousel.addEventListener("slide.bs.carousel", () => {
      // opcional: pausa já no início da transição
      elContent.querySelectorAll("video").forEach(v => v.pause?.());
    });
  }

  async function loadVideos() {
    try {
      const resp = await fetch("/api/videos", { cache: "no-store" });
      if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
      const videos = await resp.json(); // Ex.: ["/static/videos/v1.mp4", "..."]

      if (!Array.isArray(videos) || videos.length === 0) {
        elContent.innerHTML = `<div class="p-4 text-center text-muted">Nenhum vídeo encontrado.</div>`;
        return;
      }

      // Monta os slides
      elContent.innerHTML = videos.map((src, i) => slideTemplate(src, i === 0)).join("");

      // Indicadores (se houver container)
      if (elDots) {
        elDots.innerHTML = videos.map((_, i) =>
          `<button type="button" data-bs-target="#${CAROUSEL_ID}" data-bs-slide-to="${i}"
                   class="${i === 0 ? 'active' : ''}" ${i === 0 ? 'aria-current="true"' : ''}
                   aria-label="Slide ${i + 1}"></button>`
        ).join("");
      }

      // Vincula eventos do carousel e inicia observação
      bindBootstrapEvents();
      io.observe(elCarousel);

      // Garante estado inicial
      playActivePauseOthers();

    } catch (err) {
      console.error("Falha ao carregar vídeos:", err);
      elContent.innerHTML = `<div class="p-4 text-center text-danger">Erro ao carregar vídeos.</div>`;
    }
  }

  // Inicializa
  loadVideos();
})();
