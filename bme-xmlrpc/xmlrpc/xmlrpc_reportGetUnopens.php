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

    $openList = $client->reportGetUnopens($token, $campaignID, 1, 100, "", "");

    foreach($openList as $rec){
      echo $rec['sequence'] . "] Email: " . $rec['email'];
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
