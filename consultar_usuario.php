<?php
include_once "header.php";

include_once "dao/conexao.php";





$result_consultaUsuario = "SELECT *  FROM Usuario where acesso !=1 ";
$resultado_consultaUsuario = mysqli_query($con, $result_consultaUsuario);

?>



<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Consultar usuário</h4>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
           

      
      
      </div>
      
      


            <div class="card-body">
           
           
              <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Nome do usuário</th>
                      <th>User de acesso</th>
                     <th></th>
                      
                    </tr>
                  </thead>
                
                  <tbody>


                    <?php 
                    

                    
                    while ($rows_usuario = mysqli_fetch_assoc($resultado_consultaUsuario)) {
                      
                       

                      
                      

                      ?>
                      <tr>
                      <td><?php echo $rows_usuario['nomeUsuario']; ?></td>
                        <td><?php echo $rows_usuario['userAcesso']; ?></td>
                        

                      <td>
                      
                          <?php  echo "<a  class='btn btn-default' title='Excluir ' href='excluir_usuario.php?idUsuario=" .$rows_usuario['idUsuario']. "' onclick=\"return confirm('Tem certeza que deseja deletar esse registro?');\">"?> <i class='fas fa-trash-alt'></i> <?php echo "</a>";  ?>

                          <!-- Modal-->
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
