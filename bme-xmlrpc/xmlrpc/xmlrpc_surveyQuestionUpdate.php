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

$surveyQuestionDetail['answer1'] = 'yes';
$surveyQuestionDetail['answer2'] = 'No';
$surveyQuestionDetail['answer3'] = 'May Be';
$surveyQuestionDetail['question'] = 'Would u like this Product Again';
$surveyQuestionDetail['questionoptions'] = '3';
$surveyQuestionDetail['questiontype'] = '2';
$surveyQuestionDetail['comment'] = '0';
$surveyQuestionDetail['questionid']='340500';
$UpdatedQuestionID = $client->surveyQuestionUpdate($token,$SurveyID,$surveyQuestionDetail);

  } catch (XML_RPC2_FaultException $e){
    echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }
?>

