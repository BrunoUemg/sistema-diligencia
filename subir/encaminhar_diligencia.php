<?php 

include_once "dao/conexao.php";
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
session_start();
$data_hoje = date("Y-m-d");
$hora = date("H:i:s");


$sql_usuario = "SELECT * FROM usuario where idUsuario = $_SESSION[idUsuario]";
$res = $con->query($sql_usuario);
$linha_usuario = $res->fetch_assoc();
$idUsuario = $linha_usuario['idUsuario'];
$nomeUsuario = $linha_usuario['nomeUsuario'];
$idUsuarioEncaminhado = $con->escape_string($_POST['idUsuario']);
$descricao = $con->escape_string($_POST['descricao']);
$dataPrazo = $con->escape_string($_POST['dataPrazo']);
$prioridade = $con->escape_string($_POST['prioridade']);

if($idUsuarioEncaminhado == null){
    echo "<script>alert('Erro!');window.location='diligencia_gm.php'</script>";
    exit;
}

$INSERT_DILIGENCIA = "INSERT INTO diligencia (descricao, idUsuario, dataPrazo, prioridade, situacao, idCriador)
VALUES('$descricao', '$idUsuarioEncaminhado', '$dataPrazo', '$prioridade', 3, '$idUsuario')";

if($con->query($INSERT_DILIGENCIA) === true){

    echo "<script>alert('Encaminhado com sucesso!');window.location='diligencia_gm.php'</script>";
    exit;
}

?>