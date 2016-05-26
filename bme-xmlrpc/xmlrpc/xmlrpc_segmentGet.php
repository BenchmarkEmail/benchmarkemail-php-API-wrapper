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

    $segments = $client->segmentGet($token, "", 1, 100, "");



    foreach($segments as $rec) {
      echo $rec['sequence'] . "] Segment Name: " . $rec['segmentname'] . "(" . $rec['id'] . ")";
      echo "\t List Name: " . $rec['listname'] . "(" . $rec['listid'] . ")";
      echo "\t Contacts:" . $rec['contactcount'] . "\t Created Date: " . $rec['createdDate'] ;
      echo "\t Updated Date: " . $rec['modifiedDate'];
      echo "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
