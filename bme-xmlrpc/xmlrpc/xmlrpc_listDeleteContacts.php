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
    Fetch the latest contact list, so we can retrieve the contact list ID.
    **/
    $contactList = $client->listGet($token, "", 1, 1, "", "");
    $listID = $contactList[0]['id'];

    $contacts = $client->listGetContacts($token, $listID, "2", 1, 100, "", "");
    $contact="";

    foreach($contacts as $rec) {

      if(strlen($contact)>0)
      {
      $contact=$contact.",";
      }
	$contact=$contact.$rec['id'];
	}

$retval=	$client->listDeleteContacts($token,$listID,$contact);
echo($retval);
  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>