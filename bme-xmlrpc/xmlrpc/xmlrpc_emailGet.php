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

    $emailLists = $client->emailGet($token, "", "", 1, 10, "", "");

    foreach($emailLists as $rec) {
      echo $rec['sequence'] . "] Email Name: " . $rec['emailName'] . "(" . $rec['id'] . ")";
      echo "\t To List:" . $rec['toListName'] . "(" . $rec['toListID'] . ")";
      echo "\t Subject:" . $rec['subject'] ;
      echo "\t Status:" . $rec['status'] ;
      echo "\t Created Date: " . $rec['createdDate'] ;
      echo "\t Updated Date: " . $rec['modifiedDate'];
      echo "<br />";
    }
  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
