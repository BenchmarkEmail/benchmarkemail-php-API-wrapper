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
    $token = $client->login($username, $password);

    /**
    Fetch the latest contact list, so we can retrieve the contact list ID.
    **/
    $contactList = $client->listGet($token, "", 1, 1, "", "");
    $listID = $contactList[0]['id'];
	$listID="XXXXX";

    /**
    Prepare the data to insert.
    **/
    $record1['email'] = "werewrwerrer@gmail.com";
    $record1['firstname'] = 'Peter';
    $record1['lastname'] = 'Parker';
	$record1["extra 1"] = "Extra 1";
	$record1["extra 3"] = "Extra 3";

    $record2['email'] = "reewrwer@gmail.com";
    $record2['firstname'] = 'Bruce';
    $record2['lastname'] = 'Banner';
	$record2["extra 1"] = "Extra 1";
	$record2["extra 3"] = "Extra 3";

    $rec = array($record1, $record2);

    $added = $client->listAddContactsRetID($token, $listID, $rec);

    print_r($added);

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
