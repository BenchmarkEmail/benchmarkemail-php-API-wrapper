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

    
	$retval = $client->imageGetList($token,1, 10);
	$imgID=$retval[0]['id'];
	$imgData=array();
	$imgData=$client->imageGet($token,$imgID);
	echo("Image Name:)".$imgData['image_name']);
	echo("image_size:)".$imgData['image_size']);
	echo("image_url:)".$imgData['image_url']);
	echo("image_height:)".$imgData['image_height']);
    
    echo "The available images are " .$retval;
  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
