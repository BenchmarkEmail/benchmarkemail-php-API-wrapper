<?php
  /**
 This Example shows how to Validate the PayPal Email
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $retval = $client->eventCreateFBEvent($token ,"","","","","Test facebook api","Monday 8 April, 2013 at 01:00 AM (BZT2)","Mumbai, Maharashtra, India","123");

	if ( !$retval )
	{
		echo "Error!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	} 
	else
	{
	  echo $retval;
	 
	}
	
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
