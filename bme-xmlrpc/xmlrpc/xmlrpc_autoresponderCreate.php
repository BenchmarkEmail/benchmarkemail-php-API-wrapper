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


	$Autoresponder = array();
	$Autoresponder["autoresponderName"] = "Autoresponder 1";
	$Autoresponder["contactListID"]     = "11223";// id of the contact list
	$Autoresponder["isSegment"]         = false;
	$Autoresponder["fromName"]         =  "Joe de maggio";
	$Autoresponder["fromEmail"]         = "yname@yemail.com";
	$Autoresponder["webpageVersion"]    = false;
	$Autoresponder["permissionReminder"]    = true;
	$Autoresponder["permissionReminderMessage"]    = "Please click here to confirm, <a target=_new style='color:#0000ff;' href='CONFIRMURL'>Confirm my subscription</a> .";

	$retval = $api->autoresponderCreate( $token , $Autoresponder);
	
  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
