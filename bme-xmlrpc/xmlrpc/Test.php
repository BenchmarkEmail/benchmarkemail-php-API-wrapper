<?php
 require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';
  try
  {
$client = XML_RPC2_Client::create("http://api.benchmarkemail.com/1.0");
$token = $client->login("Arnortest", "123123");

//$contactList = $client->listGet($token, "", 1, 10, "", "");

//$listID = $contactList[0]['id'];

//$contacts = $client->listGetContacts($token, $listID, "", 1, 100, "","");
$emailLists = $client->emailGet($token, "", "", 1, 100, "", "");

$emailID = $emailLists[0]['id'];
Echo("hello ".$emailID);
$allOk = $client->emailSendNow($token, $emailID);
}catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
