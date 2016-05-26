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
  	$SurveyID='66562';

	$retval = $client->surveyGetQuestionList( $token ,$SurveyID);

	if ( !$retval )
	{
		echo "Error!";
		echo "\n\tCode=".$client->errorCode;
		echo "\n\tMsg=".$client->errorMessage."\n";
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