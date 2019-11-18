<?php

namespace App\Views;

use Akuren\Session\FlashMessageService;
use Akuren\Session\Session;
use App\Views\Extensions\AssetExtension;
use App\Views\Extensions\CsrfExtension;
use App\Views\Extensions\FlashMessageExtension;
use App\Views\Extensions\FormExtension;
use App\Views\Extensions\LanguageExtension;
use App\Views\Extensions\LocaleExtension;
use App\Views\Extensions\MarkdownExtension;
use Psr\Http\Message\ResponseInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Zend\Diactoros\Response;



class View
{
    protected $twig;



    public  function render(ResponseInterface $response  ,$view, array $data = []) : ResponseInterface
    {

        $view = implode('/', explode('.', $view)) . '.twig';
        $loader = new Twig_Loader_Filesystem(__DIR__.'/../../resources/views');
        $twig = new  Twig_Environment($loader, [
            'cache' =>  false //__DIR__.'/../../bootstrap/cache',
        ]);

        $twig->addExtension(new MarkdownExtension());

        $twig->addExtension(new FormExtension());

        $twig->addExtension(new AssetExtension());

        $twig->addExtension(new CsrfExtension());

        $flash = new FlashMessageService(new Session());

        $twig->addExtension(new FlashMessageExtension($flash));

        $twig->addExtension(new LanguageExtension());

        $twig->addExtension(new LocaleExtension());


             $response->getBody()->write($twig->render($view, $data));
             return $response;
    }


    public function Json(array $data = []) : ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write(json_encode($data));

        return $response->withStatus(202);

    }



}