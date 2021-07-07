<?php
include_once "header.php";

include_once "dao/conexao.php";

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
session_start();
$data_hoje = date("Y-m-d");
$hora = date("H:i:s");

$result_consultaDiligencia2 = "SELECT *  FROM diligencia D INNER JOIN usuario U ON D.idUsuario = U.idUsuario where situacao = 2 and D.idUsuario = '$_SESSION[idUsuario]'   ";
$resultado_consultaDiligencia2 = mysqli_query($con, $result_consultaDiligencia2);

while($rows_visualizacao = mysqli_fetch_assoc($resultado_consultaDiligencia2)){

  $resul_historico = "SELECT * FROM historico_diligencia where idDiligencia = '$rows_visualizacao[idDiligencia]'";
  $resultado_historico = mysqli_query($con, $resul_historico);


  if(mysqli_num_rows($resultado_historico) < 1){
    $con->query("INSERT INTO historico_diligencia (dataAlteracao,horaAlteracao,situacao,idUsuario, idDiligencia)VALUES
    ('$data_hoje', '$hora', 'Visualizado por $rows_visualizacao[nomeUsuario]', '$_SESSION[idUsuario]', '$rows_visualizacao[idDiligencia]')");
  }

}

$result_consultaDiligencia = "SELECT *  FROM diligencia D INNER JOIN usuario U ON D.idUsuario = U.idUsuario where situacao = 2 and D.idUsuario = '$_SESSION[idUsuario]'   ";
$resultado_consultaDiligencia = mysqli_query($con, $result_consultaDiligencia);

?>



<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Diligência</h4>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
           

      
      
      </div>
      
      


            <div class="card-body">
            <center><h3>Diligências encaminhadas</h3></center>
           
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Número Diligência</th>
                      <th>Descrição</th>
                      <th>Prazo para entregar</th>
                      <th>Prioridade</th>
                      <th>GM</th>
                        <th>Situação</th>
                      <th>Informação</th>
                      
                    </tr>
                  </thead>
                
                  <tbody>


                    <?php 
                    

                    
                    while ($rows_diligencia = mysqli_fetch_assoc($resultado_consultaDiligencia)) {
                      
                        $query = mysqli_query($con, "SELECT Max(idHistorico_diligencia)  AS codigo FROM historico_diligencia WHERE idDiligencia = '$rows_diligencia[idDiligencia]'");
                        $result2 = mysqli_fetch_array($query);
  
                        $idHistorico_diligencia = $result2['codigo'];
  
                        $select_Recente_historico = mysqli_query($con,"SELECT H.horaAlteracao, H.dataAlteracao, H.situacao, U.nomeUsuario  from historico_diligencia H 
                        INNER JOIN usuario U ON U.idUsuario = H.idUsuario WHERE idHistorico_diligencia = '$idHistorico_diligencia'");
                        $result2 = mysqli_fetch_array($select_Recente_historico);
                      

                      ?>
                      <tr>
                      <td><?php echo $rows_diligencia['idDiligencia']; ?></td>
                        <td><?php echo $rows_diligencia['descricao']; ?></td>
                        <td><?php 
                        $data = date("d/m/Y", strtotime($rows_diligencia['dataPrazo']));
                        echo $data; ?></td>
                        <td><?php echo $rows_diligencia['prioridade']; ?></td>
                       

                        <td><?php echo $rows_diligencia['nomeUsuario']; ?></td>
                        <td><?php 
                        if($result2['situacao'] == null){
                          echo  "Encaminhado para $rows_diligencia[nomeUsuario]";
                        }else{
                            echo $result2['situacao'];
                        }
                        ?></td>
                        <td>
                        <?php echo "<a class='btn btn-default' title='Informações sobre'  href='consultar_administrativo.php?id=" . $rows_diligencia['idDiligencia'] . "' data-toggle='modal' data-target='#ModalInfo" . $rows_diligencia['idDiligencia'] . "'>" ?><i class="fas fa-info"></i><?php echo "</a>"; ?>
                        <?php echo "<a class='btn btn-default' title='Concluir'  href='consultar_administrativo.php?id=" . $rows_diligencia['idDiligencia'] . "' data-toggle='modal' data-target='#ModalConcluir" . $rows_diligencia['idDiligencia'] . "'>" ?><i class="fas fa-check"></i><?php echo "</a>"; ?>
                      
                          <?php // echo "<a  class='btn btn-default' title='Excluir ' href='excluir_administrativo.php?idAdministrativo=" .$rows_consultaProtocolo['idProtocolo']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <!--<i class='fas fa-trash-alt'></i> --><?php echo "</a>";  ?>

                          <!-- Modal-->

                         


                        <div class="modal fade" id="ModalInfo<?php echo $rows_diligencia['idDiligencia']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Informações da diligência</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form action="alterar_diligencia.php" method="POST">

                                   
                                <?php  $query = mysqli_query($con, "SELECT Max(idHistorico_diligencia)  AS codigo FROM historico_diligencia WHERE idDiligencia = '$rows_diligencia[idDiligencia]'");
                                        $result = mysqli_fetch_array($query);
  
                                        $idHistorico_protocolo = $result['codigo'];

                                         $select_Recente_historico = mysqli_query($con,"SELECT H.horaAlteracao, H.dataAlteracao, H.situacao, U.nomeUsuario  from historico_diligencia H 
                                         INNER JOIN usuario U ON U.idUsuario = H.idUsuario WHERE idHistorico_diligencia = '$idHistorico_diligencia'");
                                         $result = mysqli_fetch_array($select_Recente_historico);
                                    

                                    ?>
                                    <input type="text" readonly hidden class="form-control" required name="idDiligencia" value="<?php echo $rows_diligencia['idDiligencia']; ?>">
                                    
                                    
                                    <label>Data da última modificação</label>
                                    <input type="date" readonly class="form-control"  required name="dtNascimento" value="<?php echo $result['dataAlteracao']; ?>">

                                    <label>Hora da última modificação</label>
                                    <input type="time" readonly class="form-control" required name="dtNascimento" value="<?php echo $result['horaAlteracao']; ?>">
                                     
                                    <label for="">Quem modificou</label>
                                    <input type="text" name="" readOnly class="form-control" placeholder="Não houve modificação" value="<?php echo $result['nomeUsuario']; ?>" id="">
                                   


                                    


                                  <label for="">Situação</label>
                                    <select name="situacao" class="form-control" id="">
                                    <option value="">Selecione</option>
                                    <option value="Pendente">Pendente</option>
                                    <option value="Em andamento">Em andamento</option>
                                    <option value="Pré concluída">Pré concluída</option>
                                    </select>
                           
                               
                                 

                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                  <input type="submit" name="enviar" class="btn btn-success" value="Alterar">
                                  </form>

                                </div>
                              </div>
                            </div>
                          </div>
                        </td>

                        <div class="modal fade" id="ModalConcluir<?php echo $rows_diligencia['idDiligencia']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Conclusão da diligência</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                <form action="concluir_diligencia.php" method="POST">


                                <input type="text" readonly hidden class="form-control" required name="idDiligencia" value="<?php echo $rows_diligencia['idDiligencia']; ?>">
                               <input type="checkbox" required="required" name="concluir" id="">
                               
                               <label for="">Confimo a conclusão dessa diligência.</label>    
                               <br>
                               <br>
                                 <label for="">Senha para validação</label>
                                <input type="password" class="form-control" required="required" name="senhaValidacao" id="">
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                                  <input type="submit" name="enviar" class="btn btn-success" value="Concluir">
                                  </form>

                                </div>
                              </div>
                            </div>
                          </div>
                        </td>


                      

                        
                      </tr>
                    <?php   } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

      </div>
  <script src="jquery/jquery-3.4.1.min.js"></script>
  <script src="js/states.js"></script>
  <script src="js/mascaras.js"></script>

  <?php
  include_once "footer.php"
  ?>
  <script>
    $(document).ready(function() {
      $('#basic-datatables').DataTable({
        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
          },
          "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        }
      });
    });
  </script>
