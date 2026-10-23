<?php

define("webhook3", "https://fluencer-contact.bitrix24.com/rest/10/hfo7jvcrg5iojiaj/");
define("webhookUser", "https://fluencer-contact.bitrix24.com/rest/10/24hx1n2n84d3mr0f/"); // permiso user, solo para usuarioActivo
include_once "bot.php";
//writeToLog($_REQUEST, 'Log de hook');
writeToLog($GLOBALS, 'user');
//variables base
$dialog_id = $_REQUEST['data']['PARAMS']['DIALOG_ID'];
$inmessage = (string)$_REQUEST['data']['PARAMS']['MESSAGE'];
$CHAT_ID = $_REQUEST['data']['PARAMS']['CHAT_ID'];
$crmid = (string)$_REQUEST['data']['PARAMS']['CHAT_ENTITY_DATA_2'];
$evento= $_REQUEST['event'];
$bot_id = 218;
$bot = new bot();

$mess1 = "Te damos la bienvenida al canal Zurich Argentina!";

$mess2 = "Actualmente estamos fuera del horario de atención.
En el siguiente link podes encontrar toda la información relacionada con los seguros de Zurich.
Link: https://www.zurich.com.ar/es-ar/personas

Si preferís, escribinos y nos pondremos en contacto tan pronto como sea posible.";


/*if($evento =="ONIMBOTJOINCHAT"){
  
  }
  else if($evento == 'ONIMBOTMESSAGEADD'){

  }*/

  $crmp = explode("|", $crmid);

$dealid = $crmp[7];
$leadid = $crmp[1];
$idcontact = $crmp[5];

preg_match('/https?:\/\/[^\s]+/', $inmessage, $coincidencias);

if (!empty($coincidencias)) {
    $url = $coincidencias[0];

    writeToLog($dealid, "dealid");
    writeToLog($url, "dealid");
    updateBitrixURL($dealid,$url);
} else {
   
}
$text = $inmessage;

$words = explode(" ", $text);
foreach ($words as $word) {
    if (filter_var($word, FILTER_VALIDATE_URL)) {
        $url =  $word;
        break;
    }
}


  if($inmessage == "Desactivar marketing"){
    writeToLog($dealid, 'entreee');
    
    cambiarFase($dealid);

    return 0;
 }

 function contieneCadena($texto, $buscar) {
    // Usa strpos para buscar la cadena
    if (strpos($texto, $buscar) !== false) {
        return true; // La cadena se encontró
    } else {
        return false; // La cadena no se encontró
    }
}
function cambiarFase($idD){
    $url0 = "https://fluencer-contact.bitrix24.com/rest/10/hfo7jvcrg5iojiaj/bizproc.workflow.start.json?TEMPLATE_ID=841&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentDeal&DOCUMENT_ID[2]=$idD";    

$ch0 = curl_init();
curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch0, CURLOPT_URL,$url0);    
$result0 = curl_exec($ch0);
curl_close($ch0);
$arr0 = json_decode($result0, true);

    //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
return $arr0;
}
if($mess1 == $inmessage || $mess2==$inmessage){

}else{
    $crmp = explode("|", $crmid);

$dealid = $crmp[7];
$leadid = $crmp[1];
$idcontact = $crmp[5];

$key = $bot->existeKey($inmessage);

if($key != -1){
    $bot->addUTMKey($dealid , $key);
    $utm_id = $bot->obtenerUTMsID($key);
    if($utm_id =="HSBC"){
        $bot->trasfer($CHAT_ID,32);
    }else if($utm_id =="directo"){
        $bot->trasfer($CHAT_ID,34);
    }
    $bot->botleave($CHAT_ID , $bot_id);
    writeToLog("key", 'key');
}else{
    writeToLog("no existe key", 'key');
    $utms = $bot->existeFrase($inmessage);
    if((float)$dealid == 0){ // como $dealid == 0 en PHP 7.4 ("" o texto = 0) - si no tiene negociaci�n
        //writeToLog($utms, "utms");
        if($utms != -1){
                $bot->addUTM($leadid , $utms);
                //writeToLog("lead", 'Log de hook');
                sendMessage("Te damos la bienvenida al canal Zurich Argentina!",$dialog_id);
                $bot->botleave($CHAT_ID , $bot_id);
                //writeToLog("utm!", 'Log de hook');
                //sendMessage("frase lo contiene el id es $utms --  $crmid",$dialog_id);
        }else{
            //writeToLog("sin utm", 'Log de hook');
            //sendMessage($mess,$dialog_id);
        } 
    }else{
        writeToLog("source", 'negociación');
        if($utms != -1){ 
            if($utms == 904){
                //sendMessage("Escribe S� acepto para realizar la confirmaci�n",$dialog_id);
                $bot->agregarPoliza($dealid , "wa");
                sleep(2);
                $bot->trasfer($CHAT_ID,18);
                // $bot->botleave($CHAT_ID , $bot_id);
            }else if($utms == 1742){
              //  $bot->addUTM2($dealid , $utms);
                
                $bot->trasfer($CHAT_ID,28);
                //$bot->botleave($CHAT_ID , $bot_id);
            }
            else{

               // $user = getDeal($dealid);
                $bot->addUTM2($dealid , $utms);
              //  $utm_id = $bot->obtenerUTMsID($utms);

               /* if($utm_id =="directo"){
                    $bot->trasfer($CHAT_ID,34);
                } */

                // asigna la negociación a MoreClix y deja el chat en la cola de la línea para que lo tome un operador
                $usuario = 156; // MoreClix
                changeResponsable($dealid, $usuario);
                if(!empty($idcontact)){
                    // solo cambia el responsable del contacto si el actual ya no está activo en la cuenta
                    $respContacto = getContact($idcontact);
                    $activo = empty($respContacto) ? false : usuarioActivo($respContacto);
                    if($activo === false){
                        changeResponsableContact($idcontact, $usuario);
                    }
                    writeToLog(array('contacto' => $idcontact, 'responsable' => $respContacto, 'activo' => $activo), 'responsable contacto');
                }
                $bot->botleave($CHAT_ID , $bot_id);
                writeToLog(array('usuario' => $usuario), 'asignado a MoreClix');
            //  writeToLog("user", 'user');
            }
        }else{
            writeToLog("source2", 'key');
            /*$pipeline = getPipeline($dealid);
            if(str_contains($pipeline, 'C2')){
                if($inmessage == "Sí" || $inmessage == "si" || $inmessage == "Sí acepto" || $inmessage == "1"){
                    //finalizar fase
                    $bot->agregarPoliza($dealid , "ok");
                    $bot->trasfer($CHAT_ID,18);
                    
                    //sendMessage("gracias!",$dialog_id);
                }else if($inmessage == "2" || $inmessage == "No" || $inmessage == "no" || $inmessage == "No acepto"){
                    $bot->agregarPoliza($dealid , "okno");
                    //
                }else{
                    $bot->agregarPoliza($dealid , "source");
                }
            }*/
           
        // $user = getDeal($dealid);
         $bot->agregarPoliza($dealid , "source");
            //$bot->trasfer($CHAT_ID,$user);
            $responsable = getContact($idcontact);

            writeToLog($responsable, 'responsable');
            changeResponsable($dealid,$responsable);
            if($responsable != 156){
               $resp =  transfer2($CHAT_ID,$responsable);

               writeToLog($resp, 'responsable');
            }
           
            $bot->botleave($CHAT_ID , $bot_id);
            
        }
    
    }
}



}

function changeResponsable($iddeal,$responsable){
    //
            $url0 = webhook3 . "crm.deal.update.json?FIELDS[ASSIGNED_BY_ID]=$responsable&id=$iddeal";    
    
            $ch0 = curl_init();
            curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch0, CURLOPT_URL,$url0);    
            $result0 = curl_exec($ch0);
            curl_close($ch0); 
            $arr0 = json_decode($result0, true);
    
            return $arr0['result'];

    }
function changeResponsableContact($idcontact,$responsable){
    //
            $url0 = webhook3 . "crm.contact.update.json?FIELDS[ASSIGNED_BY_ID]=$responsable&id=$idcontact";

            $ch0 = curl_init();
            curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch0, CURLOPT_URL,$url0);
            $result0 = curl_exec($ch0);
            curl_close($ch0);
            $arr0 = json_decode($result0, true);

            return $arr0['result'];

    }
    function updateBitrixURL($iddeal,$url){
        //
                $url0 = webhook3 . "crm.deal.update.json?FIELDS[UF_CRM_1664483817542]=$url&id=$iddeal";    
        
                $ch0 = curl_init();
                curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch0, CURLOPT_URL,$url0);    
                $result0 = curl_exec($ch0);
                curl_close($ch0); 
                $arr0 = json_decode($result0, true);
        
                return $arr0['result'];
        
        }
    function changeCotizacionURL($iddeal,$responsable){
        //
                $url0 = webhook3 . "crm.deal.update.json?FIELDS[ASSIGNED_BY_ID]=$responsable&id=$iddeal";    
        
                $ch0 = curl_init();
                curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch0, CURLOPT_URL,$url0);    
                $result0 = curl_exec($ch0);
                curl_close($ch0); 
                $arr0 = json_decode($result0, true);
        
                return $arr0['result'];
        
        } 

function getContact($idcontact){
    //
            $url0 = webhook3 . "crm.contact.get.json?id=$idcontact";    
    
            $ch0 = curl_init();
            curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch0, CURLOPT_URL,$url0);    
            $result0 = curl_exec($ch0);
            curl_close($ch0); 
            $arr0 = json_decode($result0, true);
    
            return $arr0['result']["ASSIGNED_BY_ID"];
    
    }
function usuarioActivo($iduser){
    // si la consulta falla devuelve null (no se sabe)
            $url0 = webhookUser . "user.get.json?FILTER[ID]=$iduser&FILTER[ACTIVE]=true";

            $ch0 = curl_init();
            curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch0, CURLOPT_URL,$url0);
            $result0 = curl_exec($ch0);
            curl_close($ch0);
            $arr0 = json_decode($result0, true);

            if(!is_array($arr0) || isset($arr0['error'])){
                writeToLog($arr0, 'error usuarioActivo');
                return null;
            }
            return !empty($arr0['result']);

    }
function transfer2($CHAT_ID,$id){
    //
            $url0 =webhook3 ."imopenlines.operator.transfer.json?CHAT_ID=$CHAT_ID&TRANSFER_ID=$id";    
    
            $ch0 = curl_init();
            curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch0, CURLOPT_URL,$url0);    
            $result0 = curl_exec($ch0);
            curl_close($ch0); 
            $arr0 = json_decode($result0, true);
    
            return $arr0;
    
    }

function sendMessage($message , $dialog_id){
   restCommand('imbot.message.add', 
      array(
         "DIALOG_ID" => $dialog_id,
         "MESSAGE"   => $message, 
         //"MESSAGE"   => '', 
      ), 
      $_REQUEST["auth"]);
}

function boyout($CHAT_ID , $bot_id){
    restCommand('imbot.chat.leave', Array(
    'CHAT_ID' => $CHAT_ID, 
      'BOT_ID' => $bot_id, 
  ), $_REQUEST["auth"]);
}

function adduserJ($CHAT_ID , $bot_id){
        $result = restCommand('imbot.chat.user.add', 
        Array(
        'CHAT_ID' => $CHAT_ID , 'USERS' => Array(1) ,'BOT_ID' => $bot_id,
        ), $_REQUEST["auth"]);
    }

function restCommand($method, array $params = array(), array $auth = array()) {
   $queryUrl  = 'https://' . $auth['domain'] . '/rest/' . $method;
   $queryData = http_build_query(array_merge($params, array('auth' => $auth['access_token'])));
   // writeToLog(array('URL' => $queryUrl, 'PARAMS' => array_merge($params, array("auth" => $auth["access_token"]))), 'ReportBot send data');
   // writeToLog($params, 'parametro');
   // writeToLog($queryData, 'mergen');
   // writeToLog($auth["access_token"], 'aut');
   $curl = curl_init();
   curl_setopt_array($curl, array(
       CURLOPT_POST           => 1,
       CURLOPT_HEADER         => 0,
       CURLOPT_RETURNTRANSFER => 1,
       CURLOPT_URL            => $queryUrl,
       CURLOPT_POSTFIELDS     => $queryData,
   ));
   $result = curl_exec($curl);
   curl_close($curl);
   $result = json_decode($result, 1);
   return $result;
   }

function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . '/testlog.log', $log, FILE_APPEND);
    return true;
 }

?>