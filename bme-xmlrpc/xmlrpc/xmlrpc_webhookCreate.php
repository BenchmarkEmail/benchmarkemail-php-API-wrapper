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
	
	$webhookDetails['contact_list_id'] = $listID;
	$webhookDetails['subscribes'] = 'TRUE';
	$webhookDetails['unsubscribes'] = 'FALSE';
	$webhookDetails['profile_updates'] = 'TRUE';
	$webhookDetails['email_changed'] = '1';
	$webhookDetails['cleaned_address'] = '0';
	$webhookDetails['url'] = 'http://www.webhook-url.com';
	$newWebhookID = $client->webhookCreate($token, $webhookDetails); 
    echo($newWebhookID);
  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
