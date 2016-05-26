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

	$campaignDetail=$client->reportGet($token,"", 1,2, "", "");
	$emailID=$campaignDetail[1]['id'];
    $countryLists = $client->reportGetOpenCountry($token,$emailID);

    foreach($countryLists as $rec) {
       echo $rec['sequence'] . "] Country Name: " . $rec['country_name'] ;
       echo "\t Country Region:" . $rec['country_region'] . "\t Open Count: " . $rec['openCount'] ;
       echo "<br />";
    }

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
