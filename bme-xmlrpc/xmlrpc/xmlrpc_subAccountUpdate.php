<?php
  /**
  This Example shows how to update Subaccount details using XML-RPC
  Note that we are using the PEAR XML-RPC client and recommend others do as well.
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $accountstruct = array();
    $clientid = "XXXX"; // put in your subaccount client ID which should be a number,  this can be obtained using the subAccountGetList() method
		$accountstruct["email"] = "subaccountemail@demo.com";
		$accountstruct["firstname"] = "duserfname";
		$accountstruct["lastname"]  = "duserlname";
		$accountstruct["login"]     = "duserlogin";
		$accountstruct["password"] = "duserpassword";
		$accountstruct["phone"] = "933323233";
		$accountstruct["clientid"] = $clientid;


   $client->subAccountUpdate($token, $accountstruct);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
