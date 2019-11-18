<?php


namespace Akuren\HtmlToPdf;


interface PdfGeneratorInterface
{


    /**
     * @param string $path
     * @return mixed
     */
    public function render(string $path);



    /**
     * @param string $name
     * @return mixed
     */
    public function  default(string $name);

    /**
     * @param string $name
     * @return mixed
     */
    public function  dark(string $name);

    /**
     * @param string $name
     * @return mixed
     */
    public function  light(string $name);


    /**
     * @param string $name
     * @return mixed
     */
    public function custom (string $name);



}