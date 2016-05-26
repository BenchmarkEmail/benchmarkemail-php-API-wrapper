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
	$targetEmailID = "email1@validomain.com,email2@validomain.com";

    $retval = $client->confirmEmailAdd($token, $targetEmailID);
	
  if ( strlen($retval) == 0 )
   {
	  echo "Emails added successfully for confirmation!";
   }
    else 
  {
	  echo "Emails not added " .  $retval ;
   };	
	

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
