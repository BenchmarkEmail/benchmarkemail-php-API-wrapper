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

	$retval = $client->autoresponderGetList($token, 1, 10, '', '', '');
	
if (!$retval){
  echo "Error!";
  echo "\n\tCode=".$api->errorCode;
  echo "\n\tMsg=".$api->errorMessage."\n";
} else {
  echo sizeof($retval)." Autoresponders Returned:\n";
  echo "<table>";
  echo "<tr><td> ID</td><td>Autoresponder Name </td><td> Total emails </td><td> Status </td>";
  echo "<td> Modified Date</td></tr>";
  foreach($retval as $autoresponderData)
  {
    echo "<tr>";
    echo " <td>".$autoresponderData['id']."</td><td>".$autoresponderData['autoresponderName']."</td>";
    echo " <td>".$autoresponderData['totalEmails']."</td><td>".$autoresponderData['status']."</td>";
    echo " <td>".$autoresponderData['modifiedDate']."</td>";
    echo "</tr>";
  }
  echo "</table>";
}
	

	
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
