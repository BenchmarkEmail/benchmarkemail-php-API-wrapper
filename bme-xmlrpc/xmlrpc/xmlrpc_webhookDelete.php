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

	/**
		Fetch the latest contact list ID, so we can retrieve the target contact list ID.
	**/ 
	$contactList = $client->listGet($token, "", 1, 1, "", "");
	$listID = $contactList[0]['id'];
 
	/**
	Fetch the latest webhook, so we can retrieve the webhook ID.
	**/
	$webhookList = $client->webhookGet($token,$listID);
	$webhookID = $webhookList[0]['id'];
 
	$deleted = $client->webhookDelete($token, $webhookID); 
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
