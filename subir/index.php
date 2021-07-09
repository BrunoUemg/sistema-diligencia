<?php 

include_once "header.php";

include_once "dao/conexao.php";
$result_recebida = "SELECT COUNT(idUsuario) 'cont'
FROM diligencia
WHERE idUsuario = $_SESSION[idUsuario] AND situacao = 3";
$res = $con->query($result_recebida);
$linha = $res->fetch_assoc();

$result_recebida2 = "SELECT COUNT(idCriador) 'cont'
FROM diligencia
WHERE idCriador = $_SESSION[idUsuario] AND situacao = 1";
$res = $con->query($result_recebida2);
$linha2 = $res->fetch_assoc();

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Notificação de diligência pendente</h4>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
            <h4>Diligência recebida pelo eminente</h4>
            <div class="alert alert-primary" role="alert">
            <p>Possui <?php echo $linha['cont'];?> diligência pendente</p>
            </div>
            <h4>Diligência para finalizar </h4>
            <div class="alert alert-primary" role="alert">
            <p>Possui <?php echo $linha2['cont'];?> diligência pendente para finalizar</p>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            


<?php 

include_once "footer.php";


?>