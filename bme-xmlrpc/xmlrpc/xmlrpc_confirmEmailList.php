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

    $ConfirmedEmails = $client->confirmEmailList($token);

    foreach($ConfirmedEmails as $rec) {
       echo " sequence: (" . $rec['sequence'] . ") id: (" . $rec['id'] . ")";
       echo "\t Email:" . $rec['email'] . "\t Created Date: " . $rec['createddate'] ;
	   echo "\t Confirmed: " . $rec['confirmed'];
       echo "\t Modified Date: " . $rec['modifieddate'];
       echo "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
