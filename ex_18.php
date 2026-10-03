<?php

function contarConsultas($agenda) {
    return count($agenda);
}

function contarPacientesDiferentes($agenda) {
    $pacientes = [];

    foreach ($agenda as $consulta) {
        $pacientes[] = $consulta["paciente"];
    }

    return count(array_unique($pacientes));
}

function contarEspecialidades($agenda) {
    $especialidades = [];

    foreach ($agenda as $consulta) {
        $especialidade = $consulta["especialidade"];

        if (isset($especialidades[$especialidade])) {
            $especialidades[$especialidade]++;
        } else {
            $especialidades[$especialidade] = 1;
        }
    }

    return $especialidades;
}

function ordenarPorHorario($agenda) {
    usort($agenda, function($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });

    return $agenda;
}

function primeiroAtendimento($agenda) {
    $agendaOrdenada = ordenarPorHorario($agenda);

    return $agendaOrdenada[0];
}

function ultimoAtendimento($agenda) {
    $agendaOrdenada = ordenarPorHorario($agenda);

    return $agendaOrdenada[count($agendaOrdenada) - 1];
}

function pesquisarPaciente($agenda, $nome) {
    $resultados = [];

    foreach ($agenda as $consulta) {
        if (strtolower($consulta["paciente"]) == strtolower($nome)) {
            $resultados[] = $consulta;
        }
    }

    return $resultados;
}

function verificarHorariosDuplicados($agenda) {
    $horarios = [];
    $duplicados = [];

    foreach ($agenda as $consulta) {
        $horario = $consulta["horario"];

        if (isset($horarios[$horario])) {
            $duplicados[$horario] = true;
        } else {
            $horarios[$horario] = true;
        }
    }

    return array_keys($duplicados);
}

function organizarAgenda($agenda, $pacientePesquisado) {

    return [
        "total_consultas" => contarConsultas($agenda),

        "pacientes_diferentes" => contarPacientesDiferentes($agenda),

        "consultas_por_especialidade" => contarEspecialidades($agenda),

        "primeiro_atendimento" => primeiroAtendimento($agenda),

        "ultimo_atendimento" => ultimoAtendimento($agenda),

        "agenda_ordenada" => ordenarPorHorario($agenda),

        "pesquisa_paciente" => pesquisarPaciente(
            $agenda,
            $pacientePesquisado
        ),

        "horarios_duplicados" => verificarHorariosDuplicados($agenda)
    ];
}



$agenda = [

    [
        "paciente" => "Jonas",
        "especialidade" => "Cardiologia",
        "data" => "03/10/2026",
        "horario" => "08:00"
    ],

    [
        "paciente" => "Ícaro",
        "especialidade" => "Dermatologia",
        "data" => "03/10/2026",
        "horario" => "09:30"
    ],

    [
        "paciente" => "Carlos",
        "especialidade" => "Cardiologia",
        "data" => "03/10/2026",
        "horario" => "10:00"
    ],

    [
        "paciente" => "Jonas",
        "especialidade" => "Dermatologia",
        "data" => "03/10/2026",
        "horario" => "11:00"
    ],

    [
        "paciente" => "Ana",
        "especialidade" => "Pediatria",
        "data" => "03/10/2026",
        "horario" => "09:30"
    ]
];



$paciente = "Jonas";

$resultado = organizarAgenda($agenda, $paciente);

echo "<br>Total de consultas " .
     $resultado["total_consultas"];

echo "<br>Quantidade de pacientes diferentes: " .
     $resultado["pacientes_diferentes"];


echo "Consultas por especialidade:<br>";

foreach ($resultado["consultas_por_especialidade"] as $especialidade => $quantidade) {
    echo $especialidade . ": " . $quantidade . " consultas <br>";
}


echo "<br>Primeiro atendimento<br>";

$primeiro = $resultado["primeiro_atendimento"];

echo $primeiro["paciente"] . " - " .
     $primeiro["especialidade"] . " - " .
     $primeiro["horario"] . "<br>";


echo "<br>ultimo atendimento<br>";

$ultimo = $resultado["ultimo_atendimento"];

echo $ultimo["paciente"] . " - " .
     $ultimo["especialidade"] . " - " .
     $ultimo["horario"] . "<br>";


echo "<br>agenda ordenada por horário<br>";

foreach ($resultado["agenda_ordenada"] as $consulta) {

    echo $consulta["horario"] . " - " .
         $consulta["paciente"] . " - " .
         $consulta["especialidade"] . "<br>";
}


echo "<br>pesquisa de paciente <br>";

if (count($resultado["pesquisa_paciente"]) > 0) {

    foreach ($resultado["pesquisa_paciente"] as $consulta) {

        echo $consulta["paciente"] . " - " .
             $consulta["especialidade"] . " - " .
             $consulta["data"] . " - " .
             $consulta["horario"] . "<br>";
    }

}


echo "<br>horarios duplicados <br>";

if (count($resultado["horarios_duplicados"]) > 0) {

    foreach ($resultado["horarios_duplicados"] as $horario) {
        echo "horario duplicado: " . $horario . "<br>";
    }
    

}
