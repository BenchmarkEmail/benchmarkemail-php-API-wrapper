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

    $emailLists = $client->emailGet($token, "", "", 1, 10, "", "");
    $emailID=$emailLists[0]['id'];
	$HtmlContent = "<html><body>hello</body></html>";
	$TextContent = "Buy our product and get Profit";
	$emailAddress = "antriksh@cybermaxsolutions.com";
	$email=array();
	$email = $client->emailPreview($token,$emailID, $emailAddress, $HtmlContent, $TextContent);
	echo($email['sequence'] . ")" . $email['emailName']);
	echo("From:-". $email['fromEmail']);
	echo("From Name:-".$email['fromName']);
        echo("Template:-".$email['templateContent']);
  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
