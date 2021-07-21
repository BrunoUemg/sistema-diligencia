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
$senha_db = $linha_usuario['senha'];


$idDiligencia = $con->escape_string($_POST['idDiligencia']);
$senhaValidacao = $con->escape_string($_POST['senhaValidacao']);

if(password_verify($senhaValidacao,$senha_db)){
        
    $con->query("UPDATE diligencia set situacao = 1 where idDiligencia = '$idDiligencia'");
    $con->query("INSERT INTO historico_diligencia (dataAlteracao,horaAlteracao,situacao,idUsuario, idDiligencia)VALUES('$data_hoje', '$hora', 'Encaminhado para a conclusão', '$idUsuario', '$idDiligencia')");
    
    if($linha_usuario['acesso'] == 1){
        echo "<script>alert('Concluído com sucesso!');window.location='diligencia_gm.php'</script>";
    }else{
        echo "<script>alert('Concluído com sucesso!');window.location='consultar_diligencia.php'</script>";
    }
    

}else{
    echo "<script>alert('Senha Invalida!');window.location='consultar_diligencia.php'</script>";
}





    



?>