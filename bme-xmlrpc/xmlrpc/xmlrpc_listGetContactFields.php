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
    $listID=$contactLists[0]['id'];
    $retVal=$client->listGetContactFields($token,$listID);
    echo("<table>");
    foreach($retVal as $k=>$v)
    {
    echo("<tr><td><b>". $k ."</b></td><td>".$v ."</td></tr>");
    }

echo("</table>");
  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
