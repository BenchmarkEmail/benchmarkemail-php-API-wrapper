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
	 
	$webhookLists = $client->webhookGet($token,$listID);
 
	foreach($webhookLists as $rec) {
		echo $rec['sequence'] . "] URL: " . $rec['url'] . "(" . $rec['id'] . ")";
		echo "\t Subscribes:" . $rec['subscribes'] ;
		echo "\t Unsubscribes:" . $rec['unsubscribes'] ;
		echo "\t Profile Updates:" . $rec['profile_updates'] ;
		echo "\t Email Changed:" . $rec['email_changed'] ;
		echo "\t Cleaned Address:" . $rec['cleaned_address'] ;
		echo "\t Created Date: " . $rec['createdDate'] ;
		echo "\t Updated Date: " . $rec['modifiedDate'];
		echo "<br />";
	} 

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
