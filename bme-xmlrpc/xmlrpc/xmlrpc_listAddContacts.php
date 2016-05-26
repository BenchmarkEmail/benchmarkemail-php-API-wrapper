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

    /**
    Prepare the data to insert.
    **/
    $record1['email'] = "user1@__.com";
    $record1['firstname'] = 'Peter';
    $record1['lastname'] = 'Parker';

    $record2['email'] = "user2@___.com";
    $record2['firstname'] = 'Bruce';
    $record2['lastname'] = 'Banner';

    $rec = array($record1, $record2);

    $added = $client->listAddContacts($token, $listID, $rec);

    echo $added . " records added.";

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
