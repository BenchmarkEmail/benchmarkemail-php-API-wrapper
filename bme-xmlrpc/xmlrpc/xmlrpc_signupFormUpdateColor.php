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
    $contactList = $client->listGetSignupForms($token, 1, 10, "","asc");
    $signupID=$contactList[0]['id'];
    echo
    $signupFomrColor['border'] = '1';
    $signupFomrColor['formFont'] = 'Arial';
    $signupFomrColor['formSize'] = '25';
    $signupFomrColor['introAlign'] = 'Middle';
    $signupFomrColor['formBackground'] = '#ff0000';
    $signupFomrColor['headerFont'] = 'sans-serif';
    $signupFomrColor['headerSize'] = '12px';

    $retVal = $client->signupFormUpdateColor($token,$signupID,$signupFomrColor);
    echo($retVal);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
