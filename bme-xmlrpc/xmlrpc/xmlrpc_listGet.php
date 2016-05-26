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

    $contactLists = $client->listGet($token, "", 1, 100, "", "");

    foreach($contactLists as $rec) {
       echo $rec['sequence'] . "] List Name: " . $rec['listname'] . "(" . $rec['id'] . ")";
       echo "\t Contacts:" . $rec['contactcount'] . "\t Created Date: " . $rec['createdDate'] ;
       echo "\t Updated Date: " . $rec['modifiedDate'];
       echo "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
