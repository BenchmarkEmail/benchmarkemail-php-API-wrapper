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
    $signUpList = $client->listGetSignupForms($token, 1, 10, "","asc");

    $signUpID=$signUpList[0]['id'];
    $code=$client->signupFormGetCode($token,$signUpID,"HTML");

      echo"\t Code;".$code;



  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>