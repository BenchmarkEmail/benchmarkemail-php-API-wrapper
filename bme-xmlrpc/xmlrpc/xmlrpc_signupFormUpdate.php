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
    $contactList=$client->listGet($token, "", 1, 100, "", "");
    $contact[0]['id']=$contactList[0]['id'];
    $contact[1]['id']=$contactList[1]['id'];
    $signupID=$signUpList[0]["id"];
    $signForm['introduction'] = 'Join our email List';
    $signForm['name'] = 'BenchmarkEmail';
    $signForm['title'] = 'Join our Mailing List';
    $signForm['lists'] = $contact;


    $retVal = $client->signupFormUpdate($token,$signupID,$signForm);
    echo("hello".$retVal);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
