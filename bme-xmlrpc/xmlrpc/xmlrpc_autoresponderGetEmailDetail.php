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

    $AutoresponderList = $client->autoresponderGetList($token, 1, 10, "", "", "");
    $autoresponderID   = $AutoresponderList[0]["id"];
	
    $retval = $api->autoresponderGetDetail( $token , $autoresponderID );
    $autoresponderDetailID = $retval["emails"][0]["autoresponderDetailID"]; // look at the api documentation to examine this structure
	
	$retval = $api->autoresponderGetEmailDetail( $token , $autoresponderID , $autoresponderDetailID );

	if ( !$retval )
	{
			echo "Error!";
			echo "\n\tCode=".$api->errorCode;
			echo "\n\tMsg=".$api->errorMessage."\n";
	} 
	else
	{
		echo "<table>";
		foreach($retval as $k=>$v) 
		{
			echo "<tr><td>" . $k . "</td><td>" . $v ."</td></tr>";
		}
	     echo "</table>";
	}
	
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
