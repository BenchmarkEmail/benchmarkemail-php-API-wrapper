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

    $segmentList = $client->segmentGet($token, "", 1, 1, "");
    $segmentID = $segmentList[0]['id'];

    $retval = $client->segmentGetContacts($token, $segmentID, "",1,5,"", "" );

    echo sizeof($retval)." Contacts Returned:\n";
    echo "<table>";
    echo "<tr><td>  </td><td>Contact ID</td><td> Email </td><td> Name </td><td> Middle Name</td> <td> Last Name</td></tr>";
    foreach($retval as $listData){
      echo "<tr>";
      echo "<td>".$listData['sequence']."</td><td>".$listData['id']."</td>";
      echo "<td>".$listData['email']."</td><td>".$listData['firstname']."</td>";
      echo "<td>".$listData['middlename']."</td><td>".$listData['lastname']."</td>";
      echo "</tr>";
    }
    echo "</table>";


  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
