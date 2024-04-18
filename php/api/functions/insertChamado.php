<?php
include "../../config/dbconnect.php";
include "../../config/httpaccess.php";

$res = array('error' => false, 'msg' => '');

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "InsertChamado"){
        $titulo = $mysqli_con->real_escape_string($_POST['titulo']);
        $descricao = $mysqli_con->real_escape_string($_POST['descricao']);
        $gravidade = $mysqli_con->real_escape_string($_POST['gravidade']);
        $urgencia = $mysqli_con->real_escape_string($_POST['urgencia']);
        $tendencia = $mysqli_con->real_escape_string($_POST['tendencia']);
        //$anexo = $mysqli_con->real_escape_string($_POST['anexo']);

        $prioridade = (intval($gravidade)*intval($urgencia)*intval($tendencia));

        $sql = "INSERT INTO chamados(`titulo_chamado`,`descricao_chamado`,`gravidade`,`urgencia`,`tendencia`,`prioridade_chamado`) VALUES('$titulo','$descricao','$gravidade','$urgencia','$tendencia','$prioridade')";

        $result = $mysqli_con->query($sql);
        $res['msg'] = "Chamado registrado com sucesso!";

    }else{
        $res['error'] = true;
        $res['msg'] = "Ocorreu um erro inesperado! Tente novamente mais tarde";
    }
}

$mysqli_con -> close();
header("Content-type: application/json");
echo json_encode($res);
die();

?>