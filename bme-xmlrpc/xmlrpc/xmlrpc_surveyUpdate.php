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

    $SurveyID='66556';
    $surveyDetail['name'] = 'Sales SurveyUpdate';
    $surveyDetail['url'] = 'www.benchmarkemail.com';
    $surveyDetail['title'] = 'Shop Survey';
    $surveyDetail['intro'] = 'Please take our quick, easy survey on the services we provide.';
    $surveyDetail['id']='66556';
    $UpdatedSurveyID = $client->surveyUpdate($token,$SurveyID,$surveyDetail);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>
