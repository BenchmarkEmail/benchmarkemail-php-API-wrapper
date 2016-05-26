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
    Fetch the latest email, so we can retrieve the email ID.
    **/
    $emailList = $client->emailRssGet($token, "", 1, 1, "", "");
    $emailID = $emailList[0]['id'];

    $allOk = $client->emailRssSchedule($token, $emailID,"14 Jul 2010 12:00","7");
  } 
  catch (XML_RPC2_FaultException $e)
  {
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
