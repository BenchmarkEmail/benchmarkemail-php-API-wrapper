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

    
	$retval = $client->videoGetList($token,1, 10);
	$videoID=$retval[0]['id'];
	$videoData=array();
	$videoData=$client->videoGet($token,$videoID);
	echo($videoData['sequence'].".)Videos:)".$videoData['client_videos']);
	echo("VideosDescription:)".$videoData['video_description']);
	echo("VideosEmbed:)".$videoData['video_embed']);
	echo("VideoHeight:)".$imgData['video_height']);
    
    
  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>
