<?php

function contarCaracteres($texto) {
    return strlen($texto);
}

function contarPalavras($texto) {
    $texto = trim($texto);
    $texto = preg_replace('/\s+/', ' ', $texto);

    if ($texto == "") {
        return 0;
    }

    $palavras = explode(" ", $texto);

    return count($palavras);
}

function contarFrases($texto) {
    $texto = trim($texto);

    if ($texto == "") {
        return 0;
    }

    $frases = preg_split('/[.!?]+/', $texto, -1, PREG_SPLIT_NO_EMPTY);

    return count($frases);
}

function encontrarMaiorPalavra($texto) {
    $texto = preg_replace('/[.,!?;:]/', '', $texto);
    $palavras = preg_split('/\s+/', trim($texto));

    $maior = "";

    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
    }

    return $maior;
}

function encontrarMenorPalavra($texto) {
    $texto = preg_replace('/[.,!?;:]/', '', $texto);
    $palavras = preg_split('/\s+/', trim($texto));

    $menor = "";

    foreach ($palavras as $palavra) {
        if ($menor == "" || strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return $menor;
}

function contarPalavrasRepetidas($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[.,!?;:]/', '', $texto);
    $palavras = preg_split('/\s+/', trim($texto));

    $quantidades = array_count_values($palavras);

    $repetidas = 0;

    foreach ($quantidades as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function cincoPalavrasMaisFrequentes($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[.,!?;:]/', '', $texto);
    $palavras = preg_split('/\s+/', trim($texto));

    $quantidades = array_count_values($palavras);

    arsort($quantidades);

    return array_slice($quantidades, 0, 5, true);
}

function removerEspacosDuplicados($texto) {
    $texto = trim($texto);

    return preg_replace('/\s+/', ' ', $texto);
}

function formatarTexto($texto) {
    $texto = removerEspacosDuplicados($texto);

    return ucwords(strtolower($texto));
}

function processarTexto($texto) {

    return [
        "caracteres" => contarCaracteres($texto),

        "palavras" => contarPalavras($texto),

        "frases" => contarFrases($texto),

        "palavra_maior" => encontrarMaiorPalavra($texto),

        "palavra_menor" => encontrarMenorPalavra($texto),

        "palavras_repetidas" => contarPalavrasRepetidas($texto),

        "mais_frequentes" => cincoPalavrasMaisFrequentes($texto),

        "texto_sem_espacos_duplicados" => removerEspacosDuplicados($texto),

        "texto_formatado" => formatarTexto($texto)
    ];
}


// Exemplo de uso

$texto = "o gato correu para o jardim. O gato encontrou outro gato. O gato voltou para casa.";

$resultado = processarTexto($texto);

echo "Quantidade de caracteres: " . $resultado["caracteres"] . "<br>";
echo "Quantidade de palavras: " . $resultado["palavras"] . "<br>";
echo "Quantidade de frases: " . $resultado["frases"] . "<br>";
echo "Palavra mais longa: " . $resultado["palavra_maior"] . "<br>";
echo "Palavra mais curta: " . $resultado["palavra_menor"] . "<br>";
echo "Quantidade de palavras repetidas: " . $resultado["palavras_repetidas"] . "<br>";

echo "Cinco palavras mais frequentes:<br>";

foreach ($resultado["mais_frequentes"] as $palavra => $quantidade) {
    echo $palavra . " - " . $quantidade . " vez(es)<br>";
}

echo "Texto sem espaços duplicados: " .
     $resultado["texto_sem_espacos_duplicados"] . "<br>";

echo "Texto formatado: " .
     $resultado["texto_formatado"];

?>