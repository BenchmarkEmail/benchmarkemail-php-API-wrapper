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
	
    $AutoresponderList = $client->autoresponderGetList($token, 1, 10, "", "", "");
    $autoresponderID  = $AutoresponderList[0]["id"];


	$HTML = "<html><body> <b> Hello World </b> </body></html>";
	$TEXT = "text version";
	$AutoresponderDetail = array();
	$AutoresponderDetail["subject"] = "My Autoresponder day 1";
	$AutoresponderDetail["templateContent"] = $HTML;
	$AutoresponderDetail["templateText"]    = $TEXT;
	$AutoresponderDetail["us_address"]      = "Bellhop street, amydale avenue";
	$AutoresponderDetail["us_state"]        = "California";
	$AutoresponderDetail["us_city"]         = "San hose";
	$AutoresponderDetail["us_zip"]          = "7000043";
	$AutoresponderDetail["intl_address"]    = "";
	$AutoresponderDetail["type"]            = "annual email"; //  valid values are "one off email" , "annual email" , "new subscriber email"
	$AutoresponderDetail["days"]            = "0";
	$AutoresponderDetail["whentosend"]      = "before"; // valid values are "after" , "before", ignore if this is not applicable
	$AutoresponderDetail["fieldtocompare"]  = "bday"; // label of the date field	$retval = $api->autoresponderCreate( $token , $Autoresponder);

	$retval = $api->autoresponderDetailCreate( $token , $autoresponderID , $AutoresponderDetail );

  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
