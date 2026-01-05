<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContatoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index(ContatoRequest $request)
    {
        // -------------------------
        // FORMULÁRIO DE CONTATO
        // -------------------------
        if ($request->isMethod('post')) {

            $nome = $request->nome;
            $email = $request->email;
            $mensagem = $request->mensagem;

            $assunto = "[Site] Novo contato de {$nome}";
            $corpo = "Nome: {$nome}\n"
                   . "E-mail: {$email}\n\n"
                   . "Mensagem:\n{$mensagem}";

            $destinatarios = config(
                'mail.contact_recipients',
                [config('mail.from.address')]
            );

            foreach ($destinatarios as $dest) {
                Mail::raw($corpo, function ($message) use ($assunto, $dest) {
                    $message->to($dest)
                            ->subject($assunto);
                });
            }

            return redirect()
                ->route('home')
                ->with('success', 'Mensagem enviada com sucesso! Em breve entraremos em contato.');
        }

        // -------------------------
        // IMAGENS (static/images)
        // -------------------------
        $imagesPath = public_path('images');
        $images = [];

        if (File::exists($imagesPath)) {
            $images = collect(File::files($imagesPath))
                ->filter(fn ($file) =>
                    in_array(strtolower($file->getExtension()), [
                        'png','jpg','jpeg','gif','webp'
                    ])
                )
                ->map(fn ($file) => 'images/' . $file->getFilename())
                ->values()
                ->toArray();
        }

        // -------------------------
        // SERVIÇOS
        // -------------------------
        $rawServices = [
            'plataforma360',
            'tunelLed',
            'totemMovel',
            'cabine3d',
            'efeitosEspeciais'
        ];

        $TITLE_MAP = [
            'plataforma360' => ['Plataforma 360', 'vídeos imersivos em rotação', 'icones/iconperfect360.jpg'],
            'tunelLed' => ['Túnel de LED', 'impacto visual instagramável', 'icones/iconperfect360.jpg'],
            'totemMovel' => ['Totem Móvel', 'captação dinâmica e interação', 'icones/iconperfect360.jpg'],
            'cabine3d' => ['Cabine Espelhada 3D', 'a queridinha da noite', 'icones/iconperfect360.jpg'],
            'efeitosEspeciais' => ['Efeitos Especiais', 'fumaça, luzes e efeitos visuais exclusivos', 'icones/iconperfect360.jpg'],
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

    // -------------------------
    // JSON DE VÍDEOS
    // -------------------------
    public function listVideos()
    {
        $videosPath = public_path('videos');
        $urls = [];

        if (File::exists($videosPath)) {
            foreach (File::allFiles($videosPath) as $file) {
                if (in_array(strtolower($file->getExtension()), ['mp4','webm','ogg','mov'])) {
                    $urls[] = URL::to('videos/' . $file->getRelativePathname());
                }
            }
        }

        return response()->json($urls);
    }
}
