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

    $segmentList = $client->segmentGet($token, "", 1, 1, "");
    $segmentID = $segmentList[0]['id'];

    $segmentCriteriaList = $client->segmentGetCriteriaList($token, $segmentID);

    foreach($segmentCriteriaList as $data){
      print_r($data);
      echo "<br />";
    }


  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
