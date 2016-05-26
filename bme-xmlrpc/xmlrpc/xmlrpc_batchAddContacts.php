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
	php_info();
    /**
    Fetch the latest contact list, so we can retrieve the contact list ID.
    **/
    $contactList = $client->listGet($token, "", 1, 1, "", "");
    $listID = $contactList[0]['id'];

    /**
    Prepare the data to insert.
    **/
    for ( $i = 1; $i < 100; $i++ ) {
	    $details[$i]['email'] = "user" . $i . "@yourdomain.com";
	    $details[$i]['firstname'] = 'Name' . $i;
	    $details[$i]['lastname'] = 'Surname' . $i;
	    $details[$i]['extra 3'] = 'Info ' . $i;
	}

    $batchID = $client->batchAddContacts($token, $listID, $details);

    echo "Batch ID = " . $batchID;

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
