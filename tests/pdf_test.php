<?php

require __DIR__.'/../vendor/autoload.php';

use Spatie\PdfToImage\Pdf;

try {
    // Substitua pelo caminho de um PDF de teste
    $pdf = new Pdf('caminho/para/seu/arquivo.pdf');
    $pdf->saveImage('teste.jpg');
    echo "Conversão realizada com sucesso!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
