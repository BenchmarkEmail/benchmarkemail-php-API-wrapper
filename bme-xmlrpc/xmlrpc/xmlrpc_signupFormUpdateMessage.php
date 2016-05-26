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
    $signUpList=$client->listGetSignupForms($token,1,10,"","asc");

    $signupID=$signUpList[0]["id"];
    $signForm['welcomeEmailConfirmationText'] = 'Thanks For Joining Us';
    $signForm['welcomeEmailFromEmail'] = 'goswamiantriksh@gmail.com';
    $signForm['welcomeEmailFromName'] = 'CybermaxSolutions';
    $signForm['welcomeEmailMessage'] = 'Welcome to our List';
    $signForm['welcomeEmailSubject'] = 'Confirmation Mail';


    $retVal = $client->signupFormUpdateMessage($token,$signupID,$signForm);
    echo($retVal);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
