<?php

include_once "bot.php";

$bot = new bot();

$mystring = "[cw_hc] Hola! tengo una consulta sobre el seguro de hogar";

$key = $bot->existeKey($mystring);

echo "$key <br>";
/*
$findme   = "cwc_hc";
$pos = strpos($mystring, $findme);

// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
// porque la posición de 'a' está en el 1° (primer) caracter.
if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    echo "La cadena '$findme' fue encontrada en la cadena '$mystring'";
    echo " y existe en la posición $pos";
}
*/
?>