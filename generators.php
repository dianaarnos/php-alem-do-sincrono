<?php

$function = function ()
{
    yield PHP_EOL . "Começando a execução do generator";

    echo PHP_EOL . "Echo do Generator";
    yield PHP_EOL . "Yield do generator";

    $incoming = yield;

    echo PHP_EOL . $incoming;

    return PHP_EOL . "Fim da execução do generator.";
};

$generator = $function();

echo PHP_EOL . "Fluxo principal";
echo $generator->current();

echo PHP_EOL . "Fluxo principal";
$generator->next();
echo $generator->current();
$generator->next();

echo PHP_EOL . "Fluxo principal";
$generator->send("Dados enviados ao generator");
$generator->next();
echo $generator->getReturn() . PHP_EOL;

echo PHP_EOL . "Fluxo principal";
