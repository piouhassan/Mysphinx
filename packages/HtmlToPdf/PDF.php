<?php


namespace Akuren\HtmlToPdf;


class PDF
{
    public static function Generator ()
    {
        return (new PdfGenerator());
    }
}