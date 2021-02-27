<?php


namespace App\Utils;


use Mpdf\Mpdf;

class MpdfConverter implements HtmlToPdfConverter
{

    /**
     * @inheritDoc
     */
    public function convertToPdf(string $html, array $options = [])
    {
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>Hallo MPDF</h1>');
        return $mpdf->Output();

    }
}