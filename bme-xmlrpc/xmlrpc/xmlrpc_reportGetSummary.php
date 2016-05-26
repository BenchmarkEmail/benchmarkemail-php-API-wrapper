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
    $campaignList = $client->reportGet($token, "", 1, 1, "", "");
    $campaignID = $campaignList[0]['id'];

    $summary = $client->reportGetSummary($token, $campaignID);
echo("hello".count($summary));
	if(sizeof($summary)>0)
	{
    echo " Campaign: " . $summary['emailName'] . "(" . $summary['id'] . ") <br />";
    echo " To: " . $summary['toListName'] . "(" . $summary['toListID'] . ") <br />";
    echo " Date: " . $summary['scheduleDate'] . "<br />";
    echo " Total Sent: " . $summary['mailSent'] . "<br />";
    echo " Opens: " . $summary['opens'] . "<br />";
    echo " Bounces: " . $summary['bounces'] . "<br />";
    echo " Unsubscribes: " . $summary['unsubscribes'] . "<br />";
    echo " Clicks: " . $summary['clicks'] . "<br />";
    echo " Forwards: " . $summary['forwards'] . "<br />";
    echo " Abuse Complaint: " . $summary['abuseReports'] . "<br />";
    echo " Subject: ". $summary['subject']."<br/>";
    echo " ShareUrl: ".$summary['shareURL']."<br/>";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
