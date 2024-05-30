<?php
include "../../config/dbconnect.php";
include "../../config/httpaccess.php";

$res = array('error' => false, 'msg' => '', 'chamados' => '');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id_user = $_GET['id_user'];
    $permission = $_GET['permission'];

    if ($action == "selectChamados") {
        //$status_chamado = isset($_GET['status_chamado']) ? $_GET['status_chamado'] : '';
        //$sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm,TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS minutos_espera FROM chamados WHERE id_user='$id_user'";

        if ($permission == 1){
            $sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm,TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS minutos_espera FROM chamados WHERE id_user='$id_user'";
        }elseif ($permission == 2){
            $sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm,TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS minutos_espera FROM chamados WHERE id_user_tecnico='$id_user'";
        }

        /*if(isset($_GET['status_chamado'])){
            $status_chamado = $_GET['status_chamado'];
            $sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm,TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS minutos_espera FROM chamados WHERE id_user='$id_user' AND status_chamado = '$status_chamado'";
        }else{
            $sql = "SELECT *,DATE_FORMAT(data_criacao, '%d/%m/%Y') AS data_criacao_fm,TIMESTAMPDIFF(MINUTE, data_criacao, NOW()) AS minutos_espera FROM chamados WHERE id_user='$id_user'";
        }*/

        $result = $mysqli_con->query($sql);
        $num = mysqli_num_rows($result);
        $chamados = array();

        if ($num > 0) {
            while ($row = $result->fetch_assoc()) {
                $status_chamado_ret = $row['status_chamado'];
                switch ($status_chamado_ret){
                    case 1:
                        $status_desc = "Em aberto";
                        break;
                    case 2:
                        $status_desc = "Em atendimento";
                        break;
                    case 3:
                        $status_desc = "Concluido";
                        break;
                    case 0:
                        $status_desc = "Cancelado";
                        break;
                }
                $chamados[] = $row;
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