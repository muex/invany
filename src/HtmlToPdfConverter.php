<?php


namespace App;


interface HtmlToPdfConverter
{
    /**
     * Returns the binary content of the PDF, which can be saved as file or send via Reponse.
     * @param string $html
     * @param array $options
     * @return mixed
     */
    public function convertToPdf(string $html, array $options = []);
}