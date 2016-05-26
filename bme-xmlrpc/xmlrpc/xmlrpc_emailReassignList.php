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

    /**
    Fetch the latest email, so we can retrieve the email ID.
    **/
    $emailList = $client->emailGet($token, "", "", 1, 1, "", "");
    $emailID = $emailList[0]['id'];

	$contacts = Array();

	$contactLists = $client->listGet($token, "", 1, 100, "", "");
	$contacts[0]['toListID'] = $contactLists[0]['id'];

    $contactLists = $client->segmentGet($token, "", 1, 100, "");
    $contacts[1]['isSegment'] = true;
	$contacts[1]['toSegmentID'] = $contactLists[0]['id'];

    $retVal=$client->emailReassignList($token, $emailID, $contacts);
	echo($retVal);
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>