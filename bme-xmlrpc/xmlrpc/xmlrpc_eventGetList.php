<?php
  /**
 This Example shows how to get the list of existing Events
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    
    $retval = $client->eventGetList($token ,"", "","1","5", "", "");

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
		if ( !is_array($v) )
			{
			   echo "<tr><td>" . $k . "</td><td>" . $v ."</td></tr>";
			}
			else
			{
			   echo "<tr><td>" . $k . "</td><td>" . print_r($v) ."</td></tr>";
			};
	  }
	     echo "</table>";
	}
	
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
