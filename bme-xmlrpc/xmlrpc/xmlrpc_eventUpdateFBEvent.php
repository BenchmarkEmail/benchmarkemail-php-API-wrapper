<?php
  /**
 This Example shows how to Post the event on Facebook
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $retval = $client->eventUpdateFBEvent($token ,"14588","Friday 26 April, 2013 at 01:00 AM (BZT2)","Mumbai, Maharashtra, India","123");
//eventID=14588&start_time=Sunday 21 April, 2013 at 01:00 AM (BZT2)&location=Mumbai, Maharashtra, India&description=test
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
