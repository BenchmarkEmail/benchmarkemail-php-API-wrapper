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
	 
	$webhookList = $client->webhookGet($token,$listID);
	$webhookID = $webhookList[0]['id'];
	
	$webhookDetails['id'] = $webhookID;
	$webhookDetails['contact_list_id'] = $listID;
	$webhookDetails['subscribes'] = 'FALSE';
	$webhookDetails['unsubscribes'] = 'TRUE';
	$webhookDetails['profile_updates'] = 'FALSE';
	$webhookDetails['email_changed'] = 'FALSE';
	$webhookDetails['cleaned_address'] = 'FALSE';
	$webhookDetails['url'] = 'http://www.webhook-url.com';
	$allOk = $client->webhookUpdate($token, $webhookDetails); 

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
