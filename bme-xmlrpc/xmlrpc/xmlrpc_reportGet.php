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

    $campaignList = $client->reportGet($token, "", 1, 100, "", "");

    foreach($campaignList as $rec){
      echo $rec['sequence'] . "] Campaign: " . $rec['emailName'] . "(" . $rec['id'] . ")";
      echo "\t Status:" . $rec['status'] . "\t Delivery Date: " . $rec['scheduleDate'] ;
      echo "\t Target List ID: " . $rec['toListID'] . "\t Target List Name: " . $rec['toListName'];
      echo "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
