<?php

require_once('../model/operacao.php');

function isTheseParametersAvailable($params){
     $available = true;
     $missingparams = " ";

    foreach($params as $param){
    if(!isset($_POST[$param]) || strlen ($_POST[$param])<=0){
    $availilable = false;
    $missingparams = $missingparams. ", ".$param;

         }
     }

    if(!$available){
     $response = array();
     $response['error'] = true;
     $response['message'] = 'parameters' .substr($missingparams, 1,
     strlen($missingparams)).'missing';

    echo json_encode($response);

         die();
}
}

$response = array();

if(isset($_GET['apicall'])){

    switch($_GET['apicall']){

case 'create':
    isTheseParametersAvailable(array('campo_2', 'campo_3', 'campo_4'));
    $db = new Operacao();
    $result = $db->createBolos(
    $_POST['campo_2'],
    $_POST['campo_3'],
    $_POST['campo_4'],

);
    if($result){
    $response['error'] -false;
    $response['message'] = 'dados inseridos com sucesso.';
    $response['dadoscreate'] =
    $db->getBolos();
}else{
    $response['error'] = true;
    $response['message']= 'Dados nao foram inseridos';

}
    break;
    case 'getBolos':
    $db= new Operacao();
    $response['error'] = false;
    $response['message']= 'dados Listados com sucesso.';
    $response['dadoslista']=$db->getBolos();

break;
    case 'updateBolos':
    isTheseParametersAvailable(array('campo_1', 'campo_2', 'campo_3','campo_4'));
    $db = new Operacao();
    $result = $db->updateBolos(
    $_POST['campo_1'],
    $_POST['campo_2'],
    $_POST['campo_3'],
    $_POST['campo_4'],
);

    if($result){
     $response['error'] = false;
     $response['message'] = "Dados alterados com sucesso.";
     $response['dadosalterar'] =
     $db ->getBolos();
}else{
    $respopnse['error'] = true;
    $response['message'] = "Dados não alterados";
}
    break;
    case 'deleteBolos':
    if(isset($_GET['uid'])){
    $db = new Operacao();
    if($db->deleteBolos($_GET['uid'])){
    $response['error'] = false;
    $response['message'] = "Dado excluido com sucesso";
    $response['deleteFrutas'] = $db->getBolos();

      }else{
    $response['error'] = true;
    $response['message'] = "Algo deu errado";
      }
      }else{
    $response['error'] = true;
    $response['message'] = "Dados não apagados";
}
      break;
    }
      }else{
    $response['error'] = true;
    $response['message'] = "Chamada de Api com defeito";
}

    echo json_encode($response);
