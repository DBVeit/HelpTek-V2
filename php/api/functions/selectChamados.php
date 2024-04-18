<?php
include "../../config/dbconnect.php";
include "../../config/httpaccess.php";

$res = array('error' => false, 'msg' => '', 'chamados' => '');

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "selectChamados") {
        $sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm FROM chamados;";
        $result = $mysqli_con->query($sql);
        $num = mysqli_num_rows($result);
        $chamados = array();

        if ($num > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($chamados, $row);
            }
            $res['error'] = false;
            $res['msg'] = "Listagem";
            $res['chamados'] = $chamados;
        } else {
            $res['error'] = false;
            $res['msg'] = "Não há dados para exibição";
        }
    }
}

$mysqli_con -> close();
header("Content-type: application/json");
echo json_encode($res);
die();

?>