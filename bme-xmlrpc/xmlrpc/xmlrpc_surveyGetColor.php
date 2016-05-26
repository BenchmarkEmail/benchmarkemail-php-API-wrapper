<?php
require_once'XML/RPC2/Client.php';
require_once'inc/config.php';
try
{
$client=XML_RPC2_Client::create($apiURL);
$token=$client->login($apiLogin,$apiPassword);

$surveyList=$client->surveyGetList($token,"","1",1,10,"","");
$SurveyID=$surveyList[0]['id'];
$rec=$client->surveyGetColor($token,$SurveyID);

      echo $rec['surveyid'] . "]: Survey ID, AnswerFont :" . $rec['answerfont'] . "<br>Answersize".$rec['answersize'];
      echo "\t buttonalign:" . $rec['buttonalign'] . " ButtonText " . $rec['buttontext'] . " Form BackGround " . $rec['formbg'];
      echo "<br />";


  } catch (XML_RPC2_FaultException $e){
        echo "ERROR:" . $e->getFaultString() ."(" . $e->getFaultCode(). ")";
  }

?>