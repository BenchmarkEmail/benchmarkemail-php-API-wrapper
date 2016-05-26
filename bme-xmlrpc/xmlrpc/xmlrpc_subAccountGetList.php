<?php
  /**
   This example shows how to get the List of Subaccounts for your account using XML-RPC
  Note that we are using the PEAR XML-RPC client and recommend others do as well.
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {

    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $retval = $client->subAccountGetList($token);

  echo "<table>";
  foreach($retval as $cltData){
    echo "<tr>";
    echo "<td>".$cltData['firstname']."</td><td>".$cltData['lastname']."</td>";
    echo "<td>".$cltData['clientid']."</td><td>".$cltData['login']."</td>";
    echo "<td>".$cltData['plan_email_limit']."</td><td>".$cltData['free_mail_sent']."</td>";
    echo "<td>".$cltData['active']."</td>";
    echo "</tr>";
  }
  echo "</table>";
}

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
