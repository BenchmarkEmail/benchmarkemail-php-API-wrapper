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



    $pollDetail['answer1'] = 'Never';
    $pollDetail['answer2'] = 'Once a year';
    $pollDetail['answer3'] = 'Every Month';
    $pollDetail['answer4'] = 'Every Week';
    $pollDetail['answer5'] = 'Daily';
    $pollDetail['name'] = 'Resturant Poll';
    $pollDetail['question'] = 'Do you eat out regularly';
    $pollDetail['answercolor'] = '#0000ff';
    $pollDetail['answerfont'] = 'Comic Sans Ms';
    $pollDetail['borderbg'] = '#777700';
    $pollDetail['buttontext'] = 'Submit';
    $pollDetail['formbg'] = '#FDF000';
    $newPollID = $client->pollCreate($token,$pollDetail);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
