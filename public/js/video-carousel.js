// video-carousel.js
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

  // Cria um slide do carrossel com <video> lazy (data-src)
  const slideTemplate = (src, active) => `
    <div class="carousel-item ${active ? "active" : ""}">
      <div class="ratio ${RATIO_CLASS}">
        <video class="w-100 h-100"
               muted
               loop
               playsinline
               preload="metadata"
               style="object-fit: contain; display: block; background: black;">
          <source data-src="${src}" type="video/mp4">
          Seu navegador não suporta vídeos.
        </video>
      </div>
    </div>
  `;

  // Aplica o src real apenas quando necessário
  function ensureVideoSrc(videoEl) {
    const source = videoEl.querySelector("source[data-src]");
    if (source && !source.src) {
      source.src = source.getAttribute("data-src");
      videoEl.load();
    }
  }

  // Toca o vídeo ativo e pausa os demais
  function playActivePauseOthers() {
    const items = elContent.querySelectorAll(".carousel-item");
    items.forEach(item => {
      const video = item.querySelector("video");
      if (!video) return;

      if (item.classList.contains("active")) {
        ensureVideoSrc(video);
        const tryPlay = video.play?.();
        if (tryPlay && typeof tryPlay.then === "function") {
          tryPlay.catch(() => {});
        }
      } else {
        video.pause?.();
      }
    });
  }

  // Observa quando o carrossel entra na viewport
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        playActivePauseOthers();
      } else {
        elContent.querySelectorAll("video").forEach(v => v.pause?.());
      }
    });
  }, { threshold: 0.2 });

  // Eventos do Bootstrap Carousel
  function bindBootstrapEvents() {
    elCarousel.addEventListener("slid.bs.carousel", playActivePauseOthers);
    elCarousel.addEventListener("slide.bs.carousel", () => {
      elContent.querySelectorAll("video").forEach(v => v.pause?.());
    });
  }

  // Carrega vídeos do backend Laravel
  async function loadVideos() {
    try {
      const resp = await fetch(`${window.STATIC_URL}videos-list`, {
        cache: "no-store"
      });

      if (!resp.ok) {
        throw new Error(`HTTP ${resp.status}`);
      }

      const videos = await resp.json();

      if (!Array.isArray(videos) || videos.length === 0) {
        elContent.innerHTML =
          `<div class="p-4 text-center text-muted">Nenhum vídeo encontrado.</div>`;
        return;
      }

      // Monta os slides
      elContent.innerHTML = videos
        .map((src, i) => slideTemplate(src, i === 0))
        .join("");

      // Indicadores (bolinhas)
      if (elDots) {
        elDots.innerHTML = videos
          .map((_, i) => `
            <button type="button"
              data-bs-target="#${CAROUSEL_ID}"
              data-bs-slide-to="${i}"
              class="${i === 0 ? "active" : ""}"
              ${i === 0 ? 'aria-current="true"' : ""}
              aria-label="Slide ${i + 1}">
            </button>
          `)
          .join("");
      }

      bindBootstrapEvents();
      io.observe(elCarousel);
      playActivePauseOthers();

    } catch (err) {
      console.error("Falha ao carregar vídeos:", err);
      elContent.innerHTML =
        `<div class="p-4 text-center text-danger">Erro ao carregar vídeos.</div>`;
    }
  }

  // Inicializa
  loadVideos();
})();
