<?php 

include_once "dao/conexao.php";

$idUsuario = $_GET['idUsuario'];

$delete = "DELETE FROM usuario where idUsuario = '$idUsuario'";

if($con->query($delete) === true){
    echo "<script>alert('Excluido com sucesso!');window.location='consultar_usuario.php'</script>";
}else{
    echo "<script>alert('Usuário possui relações com as diligências!');window.location='consultar_usuario.php'</script>";
}