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
    Fetch the latest campaign, so we can retrieve the email campaign ID.
    **/
    $campaignList = $client->reportGet($token, "", 1, 10, "", "");
    $campaignID = $campaignList[0]['id'].",".$campaignList[1]['id'];
	echo($apiLogin." Hello ".$campaignID);
    $summary = $client->reportCompare($token, $campaignID);

    foreach($summary as $recs){
    echo " Campaign: " . $recs['emailName'] . "(" . $recs['id'] . ") <br />";
    echo " To: " . $recs['toListName'] . "(" . $recs['toListID'] . ") <br />";
    echo " Date: " . $recs['scheduleDate'] . "<br />";
    echo " Total Sent: " . $recs['mailSent'] . "<br />";
    echo " Opens: " . $recs['opens'] . "<br />";
    echo " Bounces: " . $recs['bounces'] . "<br />";
    echo " Unsubscribes: " . $recs['unsubscribes'] . "<br />";
    echo " Clicks: " . $recs['clicks'] . "<br />";
    echo " Forwards: " . $recs['forwards'] . "<br />";
    echo " Abuse Complaint: " . $recs['abuseReports'] . "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
