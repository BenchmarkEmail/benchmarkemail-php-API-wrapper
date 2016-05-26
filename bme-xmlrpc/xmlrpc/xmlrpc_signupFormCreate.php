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
    $contactLists = $client->listGet($token, "", 1, 100, "", "");
    $contact[0][id]=$contactLists[0]['id'];
	$signupForm['name'] = 'March28 2011SignUpForm2';
    $signupForm['title'] = 'Join Our Mailing List';
    $signupForm['introduction'] = 'Join our weekly newsletter list. Just enter your email below.';
    $signupForm['lists']=$contact;
    $NewSignUpID  = $client->signupFormCreate($token,$signupForm);
    echo($NewSignUpID);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
