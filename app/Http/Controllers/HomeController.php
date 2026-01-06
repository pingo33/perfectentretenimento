<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Home + Formulário de Contato
     */
    public function index(Request $request)
    {
        // ----------------------------------
        // FORMULÁRIO DE CONTATO (POST)
        // ----------------------------------
        if ($request->isMethod('post')) {

            // validação segura (usa ContatoRequest se quiser manter)
            $data = app(ContatoRequest::class)->validated();

            $nome     = $data['nome'];
            $email    = $data['email'];
            $mensagem = $data['mensagem'];

            $assunto = "[Site] Novo contato de {$nome}";
            $corpo =
                "Nome: {$nome}\n" .
                "E-mail: {$email}\n\n" .
                "Mensagem:\n{$mensagem}";

            $destinatarios = array_map(
                'trim',
                explode(
                    ',',
                    config(
                        'mail.contact_recipients',
                        config('mail.from.address')
                    )
                )
            );

            Mail::raw($corpo, function ($message) use ($assunto, $destinatarios) {
                $message->to($destinatarios)
                        ->subject($assunto);
            });

            return redirect()
                ->route('home')
                ->with('success', 'Mensagem enviada com sucesso! Em breve entraremos em contato.');
        }

        // ----------------------------------
        // IMAGENS (public/images)
        // ----------------------------------
        $imagesPath = public_path('images');
        $images = [];

        if (File::exists($imagesPath)) {
            $images = collect(File::files($imagesPath))
                ->filter(fn ($file) =>
                    in_array(strtolower($file->getExtension()), [
                        'png', 'jpg', 'jpeg', 'gif', 'webp'
                    ])
                )
                ->map(fn ($file) => 'images/' . $file->getFilename())
                ->values()
                ->toArray();
        }

        // ----------------------------------
        // SERVIÇOS
        // ----------------------------------
        $rawServices = [
            'plataforma360',
            'tunelLed',
            'totemMovel',
            'cabine3d',
            'efeitosEspeciais',
        ];

        $TITLE_MAP = [
            'plataforma360'   => ['Plataforma 360', 'vídeos imersivos em rotação', 'icones/iconperfect360.jpg'],
            'tunelLed'        => ['Túnel de LED', 'impacto visual instagramável', 'icones/iconperfect360.jpg'],
            'totemMovel'      => ['Totem Móvel', 'captação dinâmica e interação', 'icones/iconperfect360.jpg'],
            'cabine3d'        => ['Cabine Espelhada 3D', 'a queridinha da noite', 'icones/iconperfect360.jpg'],
            'efeitosEspeciais'=> ['Efeitos Especiais', 'fumaça, luzes e efeitos visuais exclusivos', 'icones/iconperfect360.jpg'],
        ];

        $services = collect($rawServices)->map(function ($key) use ($TITLE_MAP) {
            [$title, $desc, $icon] = $TITLE_MAP[$key] ?? ['Galeria', '', 'icones/iconperfect360.jpg'];

            return [
                'key'   => $key,
                'title' => $title,
                'desc'  => $desc,
                'icon'  => $icon,
            ];
        });

        return view('home', [
            'title'    => 'Contato',
            'images'   => $images,
            'services' => $services,
        ]);
    }

    /**
     * Lista vídeos (JSON)
     * ROTA: /videos-list
     */
    public function listVideos()
    {
        $videosPath = public_path('videos');
        $urls = [];

        if (File::exists($videosPath)) {
            foreach (File::allFiles($videosPath) as $file) {
                if (in_array(strtolower($file->getExtension()), ['mp4', 'mov', 'webm', 'ogg'])) {
                    $urls[] = asset(
                        'videos/' . str_replace('\\', '/', $file->getRelativePathname())
                    );
                }
            }
        }

        return response()->json($urls);
    }
}
