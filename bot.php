<?php
  class bot {
    public $webhook = "https://fluencer-contact.bitrix24.com/rest/10/rtxr34f8evtofk2v/";
    

    public function agregarProducto($id , $idProducto){
        $url0 = $this->webhook."crm.lead.productrows.set.json?id=$id&rows[0][PRODUCT_ID]=$idProducto&rows[0][PRICE]=1000";    

        $ch0 = curl_init();
        curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch0, CURLOPT_URL,$url0);    
        $result0 = curl_exec($ch0);
        curl_close($ch0); 
        $arr0 = json_decode($result0, true);

        //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
        
        
    } 
    
    public function obtenerUTMs(){
      $url0 = $this->webhook."lists.element.get.json?IBLOCK_TYPE_ID=lists&IBLOCK_ID=46";    

      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);

      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      return $arr0['result'];
      
    } 

   public function obtenerUTMsID($id){
      $url0 = $this->webhook."lists.element.get.json?IBLOCK_TYPE_ID=lists&IBLOCK_ID=46&ELEMENT_ID=$id";    

      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);

      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      foreach ($arr0['result'][0]["PROPERTY_112"] as $key => $value) {
        $arr = $value;
      }
      return $arr;
      
    } 
    public function obtenerUTMsKey(){
      $url0 = $this->webhook."lists.element.get.json?IBLOCK_TYPE_ID=lists&IBLOCK_ID=46";    

      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);

      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      return $arr0['result'];
      
    } 

    public function agregarPoliza($id , $mess){
      $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=118&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentDeal&DOCUMENT_ID[2]=$id&PARAMETERS[ok]=$mess";    

      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);

      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      
      
  } 


    public function addUTM($leadid , $utms){
      $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=114&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentLead&DOCUMENT_ID[2]=$leadid&PARAMETERS[UTMID]=$utms";    

      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);

      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      
      
  } 

  public function addUTM2($leadid , $utms){ // CALL HOGAR AUTOS - UTM-BOT
    $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=198&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentDeal&DOCUMENT_ID[2]=$leadid&PARAMETERS[UTMID]=$utms";    

    $ch0 = curl_init();
    curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch0, CURLOPT_URL,$url0);    
    $result0 = curl_exec($ch0);
    curl_close($ch0); 
    $arr0 = json_decode($result0, true);

    //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
    } 

    public function addUTMKey($leadid , $utms){ // CALL HOGAR AUTOS - UTM-BOT
      $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=198&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentDeal&DOCUMENT_ID[2]=$leadid&PARAMETERS[UTMID]=$utms";    
  
      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);
  
      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      } 

    public function getDeal($dealid){
      $url0 = $this->webhook."crm.deal.get.json?id=$dealid";    
  
      $ch0 = curl_init();
      curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch0, CURLOPT_URL,$url0);    
      $result0 = curl_exec($ch0);
      curl_close($ch0); 
      $arr0 = json_decode($result0, true);
      
      return $arr0['result']['ASSIGNED_BY_ID'];
      //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
      } 

      public function getPipeline($dealid){
        $url0 = $this->webhook."crm.deal.get.json?id=$dealid";    
    
        $ch0 = curl_init();
        curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch0, CURLOPT_URL,$url0);    
        $result0 = curl_exec($ch0);
        curl_close($ch0); 
        $arr0 = json_decode($result0, true);
        
        return $arr0['result']['STAGE_ID'];
        //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
        } 
//
    public function existeFrase($mensaje){

      $utms = $this->obtenerUTMs();
      $aux3 = -1;
      $ran = is_array($utms) ? count($utms) : 0; // PHP 8: count(null) es error fatal; en 7.4 daba 0
      for ($i=0; $i < $ran ; $i++) {
        $frase = $utms[$i]["PROPERTY_102"];
        foreach ($frase as $key => $value) {
            $frase = $value;
        }
        
      $mensaje1 = explode(" ", $mensaje);
        $frase1 = explode(" ", (string)$frase);
        $aux1= 0; // esta dentro del string
        for ($j=0; $j < count($mensaje1) ; $j++) {
          if(isset($frase1[$j])){
            if($this->distintas($mensaje1[$j], $frase1[$j])){
              $aux1 = -1; // no lo esta
              //writeToLog("$mensaje1[$j]    ---  $frase1[$j]  ", "entre al no estan");
              break;
            } 
          }else{
              $aux1 = 0; //  lo esta
              break;
          }
          
        }
        if($aux1 == 0){
          return $utms[$i]["ID"];
        }
        
      }

   /*   if(str_contains($mensaje,$frase) != false){ // si esta dentro
        writeToLog("$frase esta dentro de $mensaje", "fraseeeee");
        return $utms[$aux3]["ID"];
      }*/


      if($aux3 != -1){ // si esta dentro
        //writeToLog("$frase esta dentro de $mensaje", "fraseeeee");
        return $utms[$aux3]["ID"];
      }

      return -1;

    }

    public function addDeal($idcontact ){
      //
              $url0 = $this->webhook."crm.deal.add.json?FIELDS[CONTACT_ID]=$idcontact&FIELDS[CATEGORY_ID]=8&FIELDS[ASSIGNED_BY_ID]=7274";    
      
              $ch0 = curl_init();
              curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch0, CURLOPT_URL,$url0);    
              $result0 = curl_exec($ch0);
              curl_close($ch0); 
              $arr0 = json_decode($result0, true);
      
              return $arr0['result'];
      
      }
      
      
      public function addContact($name , $number){
          //
                  $url0 = $this->webhook."crm.contact.add.json?FIELDS[NAME]=$name&FIELDS[PHONE][0][VALUE]=$number&FIELDS[ASSIGNED_BY_ID]=7386&FIELDS[SOURCE_ID]=WEBFORM";    
          
                  $ch0 = curl_init();
                  curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch0, CURLOPT_URL,$url0);    
                  $result0 = curl_exec($ch0);
                  curl_close($ch0); 
                  $arr0 = json_decode($result0, true);
          
                  return $arr0['result'];
          
          }

          public function listContactoPhone($phone){
            $url0 = $this->webhook."crm.contact.list.json?FILTER[PHONE]=$phone";    
      
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


        public function ejecutarBitrix($idcontact , $mess ){
          //
                  $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=546&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentContact&DOCUMENT_ID[2]=$idcontact&PARAMETERS[mess]=$mess";    
          
                  $ch0 = curl_init();
                  curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($ch0, CURLOPT_URL,$url0);    
                  $result0 = curl_exec($ch0);
                  curl_close($ch0); 
                  $arr0 = json_decode($result0, true);
          
                  return $arr0['result'];
          
          }
    public function existeKey($mensaje){

      $utms = $this->obtenerUTMsKey();
      $this->writeToLog($utms, "utm");
     // print_r($utms);
     $ran = is_array($utms) ? count($utms) : 0; // PHP 8: count(null) es error fatal; en 7.4 daba 0
     //echo "$ran <br>";
      $aux3 = -1;
      for ($i=0; $i < $ran   ; $i++) { 
       // echo "$i <br>";
        $frase = $utms[$i]["PROPERTY_114"];
        foreach ($frase as $key => $value) {
            $frase = $value;
           // echo "$frase <br>";
        }
        
        // PHP 8: una aguja null o vacía siempre coincide; en 7.4 strrpos() devolvía false
        if (!is_string($frase) || $frase === '') {
          $pos = false;
        } else {
          $pos = strrpos($mensaje, $frase);
        }
        $this->writeToLog("exite : $pos", "frase");
        if($pos === false){

        }else{
          echo "$frase entre aqui <br>";
          $aux3 = $i;
          $this->writeToLog("$aux3", "frase");
          break;
        }
      }

   /*   if(str_contains($mensaje,$frase) != false){ // si esta dentro
        writeToLog("$frase esta dentro de $mensaje", "fraseeeee");
        return $utms[$aux3]["ID"];
      }*/


      if($aux3 != -1){ // si esta dentro
        //writeToLog("$frase esta dentro de $mensaje", "fraseeeee");
        $this->writeToLog($utms[$aux3]["ID"], "id utm");
        return $utms[$aux3]["ID"];
      }

      return -1;

    }

    // Igual que $a != $b en PHP 7.4: PHP 8 considera numérico "123\n" (espacio al final)
    // y lo iguala a "123"; en 7.4 se comparaban como texto.
    private function distintas($a, $b){
      $ws = " \t\n\r\v\f";
      if (is_string($a) && is_string($b) && (rtrim($a, $ws) !== $a || rtrim($b, $ws) !== $b)) {
        return $a !== $b;
      }
      return $a != $b;
    }

   public function trasfer($chat_id,$canal){
      $result = $this->restCommand('imopenlines.bot.session.transfer', Array(
        'CHAT_ID' => $chat_id,
        'QUEUE_ID' => $canal,
        'LEAVE' => 'N'
    ), $_REQUEST["auth"]);
  }

  public function transferUser($chat_id,$user_id){ // transfiere a un usuario y el bot sale del chat
      return $this->restCommand('imopenlines.bot.session.transfer', Array(
        'CHAT_ID' => $chat_id,
        'USER_ID' => $user_id,
        'LEAVE' => 'Y'
    ), $_REQUEST["auth"]);
  }

  
    public function editarCotizacion($id , $codC){
        $url0 = $this->webhook."bizproc.workflow.start.json?TEMPLATE_ID=80&DOCUMENT_ID[0]=crm&DOCUMENT_ID[1]=CCrmDocumentLead&DOCUMENT_ID[2]=$id&PARAMETERS[cadena]=$codC";    

        $ch0 = curl_init();
        curl_setopt($ch0, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch0, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch0, CURLOPT_URL,$url0);    
        $result0 = curl_exec($ch0);
        curl_close($ch0); 
        $arr0 = json_decode($result0, true);

        //echo "<pre>"; print_r($arr0["result"]); echo "</pre>";
        
        
    } 



    function addmessage($dialog_1d , $message){
      $this->restCommand('imbot.message.add', 
                  array(
                     "DIALOG_ID" => $dialog_1d,
                     "MESSAGE"   => $message, 
                     //"MESSAGE"   => '', 
                  ), 
                  $_REQUEST["auth"]);
  }

    function adduserJ($chat_id,$botid){
        $this->restCommand('imbot.chat.user.add', 
        Array(
        'CHAT_ID' => $chat_id , 'USERS' => Array(1) ,'BOT_ID' => $botid,
        ), $_REQUEST["auth"]);
    }

    function adduserI($chat_id,$botid){
        $this->restCommand('imbot.chat.user.add', 
        Array(
        'CHAT_ID' => $chat_id , 'USERS' => Array(27,7) ,'BOT_ID' => $botid,
        ), $_REQUEST["auth"]);
    }

    function adduserA($chat_id,$botid){
        $this->restCommand('imbot.chat.user.add', 
        Array(
        'CHAT_ID' => $chat_id , 'USERS' => Array(43,39) ,'BOT_ID' => $botid,
        ), $_REQUEST["auth"]);
    }

    function botleave($chatid , $botid){
      $result = $this->restCommand('imbot.chat.leave', Array(

          'CHAT_ID' => $chatid,
          'BOT_ID' => $botid, 
       
       ), $_REQUEST["auth"]);
  }

  

  public function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(__DIR__ . '/testlog11.log', $log, FILE_APPEND);
    return true;
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
  }
?>