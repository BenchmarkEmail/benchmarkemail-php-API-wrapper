<?php
  /**
 This Example shows how to Get the event Ticket
  **/
  require_once 'XML/RPC2/Client.php';
  require_once 'inc/config.php';

  try
  {
    $client = XML_RPC2_Client::create($apiURL);
    $token = $client->login($apiLogin, $apiPassword);

    $retval = $client->ticketGetByID($token , "12513", "4220");

	if ( !$retval )
	{
		echo "Error!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	} 
	else
	{
	
	 /* echo "<table>";
	  foreach($retval as $k=>$v) 
	  {
		if ( !is_array($v) )
			{
			   echo "<tr><td>" . $k . "</td><td>" . $v ."</td></tr>";
			}
			else
			{
			   echo "<tr><td>" . $k . "</td><td>" . print_r($v) ."</td></tr>";
			};
	  }
	     echo "</table>";
		 
		 echo "<table>";
		 */
  echo "<tr><td>Serail</td><td>Ticket Item id</td><td> Ticket Id</td><td> Event Id </td><td> Event Fee Id </td><td> Ticket Quantity </td><td> Checkin Quantity </td>";
  echo "<td> Price </td><td> Feelable </td><td> status </td><td> Discount Amount </td><td> Discount Percentage </td><td> Charges </td><td> Firstname </td><td> Lastname </td><td> Email </td></tr>";
  	  foreach($retval as $k=>$v)
  	  {
  	  	echo("<tr>");
  		if ( !is_array($v) )
  			{
  			   echo "<td>" . $k . "</td><td>" . $v ."</td>";
  			}
  			else
  			{
  			  foreach($v as $key=>$val)
			  {
			    if ( !is_array($val) )
			    			{
			    			   echo "<td>" . $val ."</td>";
			    			}
			    			else
			    			{
			    			   echo "<td>" . print_r($val) ."</td>";
			    			}
  	  		   }

  			}
  			echo("</tr>");
  	  }
	     echo "</table>";
	 
	}
	
  } catch (XML_RPC2_FaultException $e){
      echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
