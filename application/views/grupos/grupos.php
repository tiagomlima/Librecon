<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<a href="<?php echo base_url()?>index.php/grupos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Grupo</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Grupos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome do Grupo</th>
            <th>Duração</th>
            <th>Quantidade Máxima de Itens</th>
            <th>Quantidade Máxima de Renovação</th>
            <th>Quantidade Máxima de Reserva</th>
            <th>Validade da Reserva</th>
            <th>Valor da Multa</th>
            <th>Observações</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhum Grupo Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Grupos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome do Grupo</th>
            <th>Duração</th>
            <th>Quantidade Máxima de Itens</th>
            <th>Quantidade Máxima de Renovação</th>
            <th>Quantidade Máxima de Reserva</th>
            <th>Validade da Reserva</th>
            <th>Valor da Multa</th>
            <th>Observações</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idGrupo.'</td>';
            echo '<td>'.$r->nomeGrupo.'</td>';
			echo '<td>'.$r->duracao_dias.'</td>';
			echo '<td>'.$r->qtde_max_item.'</td>';
			echo '<td>'.$r->qtde_max_renovacao.'</td>';
			echo '<td>'.$r->qtde_max_reserva.'</td>';
			echo '<td>'.$r->validade_reserva.'</td>';
			echo '<td>'. 'R$ '.$r->multa.'</td>';
			echo '<td>'.$r->observacoes.'</td>';
            echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eGrupo')){
                		echo '<a href="'.base_url().'index.php/grupos/editar/'.$r->idGrupo.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Grupo"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dGrupo')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" grupos="'.$r->idGrupo.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Grupo"><i class="icon-remove icon-white"></i></a>'; 
            		  }
                  '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>

	
<?php echo $this->pagination->create_links();}?>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/grupos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Grupo</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idGrupo" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>




<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var grupos = $(this).attr('grupos');
        $('#idGrupo').val(grupos);

    });

});

</script>

