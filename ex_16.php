<?php

function contarMaiusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarMinusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarNumeros($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_digit($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarEspeciais($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function classificarSenha($senha) {

    $tamanho = strlen($senha);
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);

    $pontos = 0;

    if ($tamanho >= 8) {
        $pontos++;
    }

    if ($maiusculas > 0) {
        $pontos++;
    }

    if ($minusculas > 0) {
        $pontos++;
    }

    if ($numeros > 0) {
        $pontos++;
    }

    if ($especiais > 0) {
        $pontos++;
    }

    if ($pontos <= 2) {
        return "Fraca";
    } elseif ($pontos == 3) {
        return "Média";
    } elseif ($pontos == 4) {
        return "Forte";
    } else {
        return "Muito Forte";
    }
}

function analisarSenha($senha) {

    return [
        "maiusculas" => contarMaiusculas($senha),
        "minusculas" => contarMinusculas($senha),
        "numeros" => contarNumeros($senha),
        "especiais" => contarEspeciais($senha),
        "tamanho" => strlen($senha),
        "seguranca" => classificarSenha($senha)
    ];
}


$senha = "Senha@123";

$resultado = analisarSenha($senha);

echo "Senha  " . $senha . "<br>";
echo "Letras maiusculas " . $resultado["maiusculas"] . "<br>";
echo "Letras minusculas " . $resultado["minusculas"] . "<br>";
echo "Numeros " . $resultado["numeros"] . "<br>";
echo "Caracteres especiais " . $resultado["especiais"] . "<br>";
echo "Tamanho " . $resultado["tamanho"] . "<br>";
echo "Nivel de segurança " . $resultado["seguranca"];
