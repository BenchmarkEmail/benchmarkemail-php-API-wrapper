<?php
  /**
  This Example shows how to authenticate a user using XML-RPC.
  Note that we are using the PEAR XML-RPC client and recommend others do as well.
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $retval = $client->emailTemplateGetList($token,1,10);
    foreach($retval as $rec)
    {
    echo("<br>");
    echo $rec['sequence'].")".$rec['template_name']."<br>";
   echo $rec['template_source']."<br>";
  echo $rec['preview_small'];
  }

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
