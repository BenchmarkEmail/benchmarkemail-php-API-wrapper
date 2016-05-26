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

    $contactList = $client->listGet($token, "", 1, 1, "", "");
    $listID = $contactList[0]['id'];


    $segmentDetail['segmentname'] = 'Segment Test';
    $segmentDetail['description'] = 'Segment Description for Test';
    $segmentDetail['listid'] = $listID;
    $segmentID = $client->segmentCreate($token, $segmentDetail);

    echo "Segment Created : " . $segmentID;

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
