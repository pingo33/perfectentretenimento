// static/js/galleries-config.js
// Observações:
// - Use apenas caminhos RELATIVOS ao /static (ex.: "galerias/...").
// - O prefixo real (/static/) é adicionado via window.STATIC_URL no services-gallery.js.
// - Cada item pode ter: type ("video" | "image"), src, ratio ("16x9", "4x3", "1x1", "21x9", "9x16"), poster (opcional), mime (opcional).

window.SERVICE_GALLERIES = {
    plataforma360: [
        {
            type: "video",
            src: "galerias/plataforma360/IMG_2650.MOV",
            ratio: "16x9",
            // poster: "galerias/plataforma360/poster-02.jpg",
            // mime: "video/mp4"
        },
        {
            type: "video",
            src: "galerias/plataforma360/video-plataforma-02.mp4",
            ratio: "16x9",
            // poster: "galerias/plataforma360/poster-02.jpg",
            // mime: "video/mp4"
        },
        {
            type: "video",
            src: "galerias/plataforma360/Giro.MOV",
            ratio: "16x9",
            // poster: "galerias/plataforma360/poster-02.jpg",
            // mime: "video/mp4"
        }
    ],

    tunelLed: [
        {
            type: "video",
            src: "galerias/tunelled/video-14.mp4",
            ratio: "16x9",
            // poster: "galerias/tunelled/poster-02.jpg"
        }
    ],

    totemMovel: [
        {
            type: "video",
            src: "galerias/totemovel/video-7.mp4",
            ratio: "16x9"
        }
    ],

    cabine3d: [
        {
            type: "video",
            src: "galerias/cabine3d/video-10.mp4",
            ratio: "16x9"
        },
        {
            type: "video",
            src: "galerias/cabine3d/Cabine3D.MOV",
            ratio: "16x9"
        }
    ],

    efeitosEspeciais: [
        {
            type: "video",
            src: "galerias/efeitosespeciais/IMG_5908.MOV",
            ratio: "16x9",
        },
        {
            type: "video",
            src: "galerias/efeitosespeciais/IMG_5828.MOV",
            ratio: "16x9",
        },
    ],

};
