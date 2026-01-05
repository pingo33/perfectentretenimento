// static/js/services-gallery.js
(() => {
    const STATIC_PREFIX = (window.STATIC_URL || '/static/').replace(/\/+$/, '/');
    const cfg = window.SERVICE_GALLERIES || {};

    const modalEl = document.getElementById('servicoModal');
    const titleEl = document.getElementById('modalServiceName');
    const indicatorsEl = document.getElementById('servico-indicators');
    const innerEl = document.getElementById('servico-inner');
    const carouselEl = document.getElementById('servicoCarousel');
    if (!modalEl || !titleEl || !indicatorsEl || !innerEl || !carouselEl) return;

    let carouselInst = null;

    // ==============================
    // CONFIGURAÇÃO DE LARGURA MÁXIMA
    // ==============================
    const WIDTH_CAP_VW = 0.62;   // 62% da tela (ajuste se quiser mais)
    const MIN_DIALOG_PX = 360;   // largura mínima do modal

    const toURL = (rel) => rel?.startsWith('http') ? rel : STATIC_PREFIX + String(rel || '').replace(/^\/+/, '');
    const isVideoPath = (p = '') => /\.(mp4|webm|ogg)(\?|#|$)/i.test(p);

    const pauseAll = () => innerEl.querySelectorAll('video').forEach(v => { try { v.pause(); } catch { } });
    const playActive = () => {
        const v = innerEl.querySelector('.carousel-item.active video');
        if (v) v.play?.().catch(() => { });
    };

    // ==============================
    // CONSTRUÇÃO DOS SLIDES
    // ==============================
    function buildSlides(items) {
        indicatorsEl.innerHTML = items.map((_, i) =>
            `<button type="button" data-bs-target="#servicoCarousel" data-bs-slide-to="${i}"
         class="${i === 0 ? 'active' : ''}" aria-label="Slide ${i + 1}"></button>`
        ).join('');

        innerEl.innerHTML = items.map((it, i) => {
            const obj = typeof it === 'string'
                ? (isVideoPath(it) ? { type: 'video', src: it } : { type: 'image', src: it })
                : (it || {});
            const src = toURL(obj.src);
            const poster = obj.poster ? `poster="${toURL(obj.poster)}"` : '';
            const autoplay = i === 0 ? 'autoplay muted' : '';

            if (obj.type === 'image' || (!obj.type && !isVideoPath(src))) {
                return `
          <div class="carousel-item ${i === 0 ? 'active' : ''}"
               style="display:flex;align-items:center;justify-content:center;background:#000;">
            <img src="${src}" alt="${obj.alt || 'Galeria'}" loading="lazy"
                 style="width:auto;height:auto;object-fit:contain;border-radius:.5rem;background:#000;">
          </div>`;
            }

            return `
        <div class="carousel-item ${i === 0 ? 'active' : ''}"
             style="display:flex;align-items:center;justify-content:center;background:#000;">
          <video ${autoplay} controls playsinline preload="metadata" ${poster}
                 style="width:auto;height:auto;object-fit:contain;border-radius:.5rem;background:#000;">
            <source src="${src}" type="${obj.mime || 'video/mp4'}">
            Seu navegador não suporta vídeos.
          </video>
        </div>`;
        }).join('');
    }

    // ==============================
    // AJUSTE DO TAMANHO DO MODAL E MÍDIA
    // ==============================
    function fitMediaInsideViewport() {
        const headerH = modalEl.querySelector('.modal-header')?.getBoundingClientRect().height || 0;
        const footerH = modalEl.querySelector('.modal-footer')?.getBoundingClientRect().height || 0;

        const maxW = Math.floor(window.innerWidth * WIDTH_CAP_VW); // largura máxima (62vw)
        const maxH = Math.floor(window.innerHeight * 0.90);         // altura máxima (90vh)
        const availH = Math.max(160, maxH - headerH - footerH - 16); // altura útil no body

        const activeSlide = innerEl.querySelector('.carousel-item.active');
        if (!activeSlide) return;

        activeSlide.querySelectorAll('video, img').forEach(el => {
            el.style.maxWidth = `${maxW}px`;
            el.style.maxHeight = `${availH}px`;
            el.removeAttribute('width');
            el.removeAttribute('height');
        });
    }

    function adjustModalSize() {
        const dialog = modalEl.querySelector('.modal-dialog');
        const headerH = modalEl.querySelector('.modal-header')?.getBoundingClientRect().height || 0;
        const footerH = modalEl.querySelector('.modal-footer')?.getBoundingClientRect().height || 0;

        const capW = Math.floor(window.innerWidth * WIDTH_CAP_VW);
        const maxH = Math.floor(window.innerHeight * 0.90);
        const availH = Math.max(160, maxH - headerH - footerH - 16);

        const activeVideo = innerEl.querySelector('.carousel-item.active video');
        const activeImg = innerEl.querySelector('.carousel-item.active img');

        let naturalW = 1280, naturalH = 720;
        if (activeVideo?.videoWidth) {
            naturalW = activeVideo.videoWidth;
            naturalH = activeVideo.videoHeight;
        } else if (activeImg?.naturalWidth) {
            naturalW = activeImg.naturalWidth;
            naturalH = activeImg.naturalHeight;
        }

        const scale = Math.min(capW / naturalW, availH / naturalH, 1);
        const targetW = Math.max(Math.floor(naturalW * scale), MIN_DIALOG_PX);

        dialog.style.width = `${targetW}px`;
        dialog.style.maxWidth = `${Math.floor(WIDTH_CAP_VW * 100)}vw`;
    }

    function applyFit() {
        fitMediaInsideViewport();
        adjustModalSize();
    }

    // ==============================
    // INICIALIZAÇÃO DO CARROSSEL
    // ==============================
    function initCarousel() {
        if (carouselInst) carouselInst.dispose();
        carouselInst = new bootstrap.Carousel(carouselEl, { interval: false });

        carouselEl.addEventListener('slide.bs.carousel', pauseAll);
        carouselEl.addEventListener('slid.bs.carousel', () => {
            playActive();
            applyFit();
        });

        applyFit();
    }

    // ==============================
    // ABERTURA DO MODAL
    // ==============================
    document.querySelectorAll('.service-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const key = btn.getAttribute('data-service');
            const title = btn.getAttribute('data-title') || 'Galeria';
            titleEl.textContent = `Galeria — ${title}`;
            const list = Array.isArray(cfg[key]) ? cfg[key] : [];

            if (!list.length) {
                indicatorsEl.innerHTML = '';
                innerEl.innerHTML = '<div class="p-4 text-center text-muted">Sem mídias para este serviço.</div>';
            } else {
                buildSlides(list);
            }

            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            modalEl.addEventListener('shown.bs.modal', () => {
                const firstVid = innerEl.querySelector('.carousel-item.active video');
                const firstImg = innerEl.querySelector('.carousel-item.active img');

                const start = () => {
                    initCarousel();
                    pauseAll();
                    playActive();
                    applyFit();
                    window.addEventListener('resize', applyFit);
                };

                if (firstVid) {
                    firstVid.addEventListener('loadedmetadata', start, { once: true });
                    setTimeout(start, 400);
                } else if (firstImg) {
                    if (firstImg.complete) start();
                    else firstImg.addEventListener('load', start, { once: true });
                } else {
                    start();
                }
            }, { once: true });

            modalEl.addEventListener('hidden.bs.modal', () => {
                window.removeEventListener('resize', applyFit);
                pauseAll();
            }, { once: true });
        });
    });
})();
