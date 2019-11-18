<?php


namespace App\Http\Controllers;


use AkConfig\App;
use Akuren\Cookies\Cookie;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;


abstract class Controller
{
    protected $view;


    public function __construct()
    {
        $view = new View();

        $this->view = $view;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function getParams(ServerRequestInterface $request) : array
    {
        $params = array_merge( $request->getParsedBody(), $request->getUploadedFiles());
        return $params;
    }



}