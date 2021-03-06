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
    Fetch the first contact records, so we can retrieve the email to fetch the details.
    **/
    $contact = $client->listGetContacts($token, $listID, "", 1, 1, "", "");
    $contactEmail = $contact[0]['email'];

    $contactDetail = $client->listGetContactDetails($token, $listID, $contactEmail);
    foreach($contactDetail as $key => $value) {
      echo $key . ": " . $value . "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
