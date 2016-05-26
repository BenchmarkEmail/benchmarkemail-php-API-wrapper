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

    $emailLists = $client->emailGet($token, "", "", 1, 10, "", "");
    $emailID=$emailLists[0]['id'];
	$newName="Welcome";
	$retval = $client->emailCheckName($token,$emailID,$newName);
	echo("Email Name Possible status:".$retval);
  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
