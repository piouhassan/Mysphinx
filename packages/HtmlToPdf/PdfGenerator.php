<?php


namespace Akuren\HtmlToPdf;


use HTML2PDF;

class PdfGenerator implements PdfGeneratorInterface
{

    private $orientation;

    private  $format;

    private $langue;

    private $unicode;

    private $encoding;

    

    /**
     * @param string $path
     * @return mixed
     */
    public function render (string $path)
    {
        if ($path === "default"){

            require __DIR__.'/Template/default.php';

        }elseif ($path === "dark"){

            require __DIR__.'/Template/dark.php';
        }
        elseif ($path === "light"){

            require __DIR__.'/Template/light.php';
        }

        elseif ($path === "custom"){
            require __DIR__.'/Template/custom.php';
        }

    }


    /**
     * @param mixed $orientation
     * @return PdfGenerator
     */
    public function setOrientation ($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * @param mixed $format
     * @return PdfGenerator
     */
    public function setFormat ($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param mixed $langue
     * @return PdfGenerator
     */
    public function setLangue ($langue)
    {
        $this->langue = $langue;
        return $this;
    }

    /**
     * @param mixed $unicode
     * @return PdfGenerator
     */
    public function setUnicode ($unicode)
    {
        $this->unicode = $unicode;
        return $this;
    }

    /**
     * @param mixed $encoding
     * @return PdfGenerator
     */
    public function setEncoding ($encoding)
    {
        $this->encoding = $encoding;
        return $this;
    }


    /**
     * @param string $name
     * @return mixed
     * @throws \HTML2PDF_exception
     */
    public function  default (string $name)
    {
        include __DIR__. "/html2pdf/html2pdf.class.php";
        $pdf = new HTML2PDF($this->orientation, $this->format, $this->langue, $this->unicode, $this->encoding);
        $pdf->pdf->SetDisplayMode("fullpage");
        $pdf->writeHTML($this->render('default'));
        $pdf->Output($name.".pdf", "");
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \HTML2PDF_exception
     */
    public function dark (string $name)
    {
        include __DIR__. "/html2pdf/html2pdf.class.php";
        $pdf = new HTML2PDF($this->orientation, $this->format, $this->langue, $this->unicode, $this->encoding);
        $pdf->pdf->SetDisplayMode("fullpage");
        $pdf->writeHTML($this->render('dark'));
        $pdf->Output($name.".pdf", "");
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \HTML2PDF_exception
     */
    public function light (string $name)
    {
        include __DIR__. "/html2pdf/html2pdf.class.php";
        $pdf = new HTML2PDF($this->orientation, $this->format, $this->langue, $this->unicode, $this->encoding);
        $pdf->pdf->SetDisplayMode("fullpage");
        $pdf->writeHTML($this->render('light'));
        $pdf->Output($name.".pdf", "");
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \HTML2PDF_exception
     */
    public function custom (string $name)
    {
         include __DIR__. "/html2pdf/html2pdf.class.php";
        $pdf = new HTML2PDF($this->orientation, $this->format, $this->langue, $this->unicode, $this->encoding);
        $pdf->pdf->SetDisplayMode("fullpage");
        $pdf->writeHTML($this->render('custom'));
        $pdf->Output($name.".pdf", "");
    }

}