<?php


namespace App\Views\Extensions;


use Akuren\translation\Translate;

class LanguageExtension extends \Twig_Extension
{

    public function getFunctions() : array
    {
        return [
            new \Twig_SimpleFunction('lang', [$this , 'language'], ['is_safe' => ['html']])
        ];
    }

    public function language($value)
    {
       return Translate::of($value);
    }

}