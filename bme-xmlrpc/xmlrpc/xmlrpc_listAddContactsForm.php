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
    Fetch the latest signup forms, so we can retrieve the signup form ID.
    **/
    $formList = $client->listGetSignupForms($token, 1, 1, "");
    $signupFormID = $formList[0]['id'];

    /**
    Prepare the data to insert.
    **/
    $record1['email'] = "user1@__.com";
    $record1['firstname'] = 'Peter';
    $record1['lastname'] = 'Parker';

    $added = $client->listAddContactsForm($token, $signupFormID, $record1);

    echo $added . " record added.";

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
