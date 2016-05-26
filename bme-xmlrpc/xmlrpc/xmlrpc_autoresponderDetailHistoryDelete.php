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

	$AutoresponderList = $client->autoresponderGetList($token, 1, 10, '', '', '');
    $autoresponderID   = $AutoresponderList[0]["id"];
	$autoresponderID ='4612';
    $AutoResponderDetailed=$client->autoresponderGetDetail($token,$autoresponderID);
     if(count($AutoResponderDetailed['emails'][0]) > 0)
      {
      $autoResponderDetailID=$AutoResponderDetailed['emails'][0]['autoresponderdetailid'];
      $autoResponderDetailID='7631';
      }
      $email='antriksh@cybermaxsolutions.com';

      $retVal = $client->autoresponderDetailHistoryDelete($token, $autoresponderID, $autoResponderDetailID, $email);

      echo("Autoresponder detail history deleted status ".$retVal);


  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
