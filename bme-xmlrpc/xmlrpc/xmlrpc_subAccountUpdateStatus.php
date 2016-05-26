<?php
  /**
   This example shows how to update the status of your Subaccount using XML-RPC
  Note that we are using the PEAR XML-RPC client and recommend others do as well.
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

   $id = "XXXX" ; // put in your subaccount client ID which should be a number, this can be obtained using the subAccountGetList() method
   $status = "0"; // Status of the Subaccount, this can be either 1 or 0

   $client->subAccountUpdateStatus($token, $id, $status );

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
