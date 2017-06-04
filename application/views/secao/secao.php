<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<a href="<?php echo base_url()?>index.php/secao/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Seção</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Seção</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Seção</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma Seção Cadastrada</td>
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
        <h5>Seção</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Seção</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idSecao.'</td>';
            echo '<td>'.$r->secao.'</td>';
            echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eSecao')){
                		echo '<a href="'.base_url().'index.php/secao/editar/'.$r->idSecao.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Tipo de Item"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dSecao')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" secao="'.$r->idSecao.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Secao"><i class="icon-remove icon-white"></i></a>'; 
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
  <form action="<?php echo base_url() ?>index.php/secao/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Seção</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idSecao" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta seção e os dados associados a ela?</h5>
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
        
        var secao = $(this).attr('secao');
        $('#idSecao').val(secao);

    });

});

</script>

