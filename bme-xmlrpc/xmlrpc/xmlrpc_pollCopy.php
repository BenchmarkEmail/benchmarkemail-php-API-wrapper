<?php
require_once'XML/RPC2/Client.php';
require_once'inc/config.php';
try
{
$client=XML_RPC2_Client::create($apiURL);
$token=$client->login($apiLogin,$apiPassword);

$pollList=$client->pollGetList($token,"","",1,10,"","");
$pollID=$pollList[0]['id'];
$newPollID=$client->pollCopy($pollID,"New Poll");
if($newPollID!="0")
{
echo("New Poll ID is ".$newPollID);
}
else
{
echo("Poll can't be copied");
}

}
catch(XML_RPC2_FaultException $e)
{
echo "ERROR:".$e.getFaultString()."(".$e.getFaultCode().")";
}
?>