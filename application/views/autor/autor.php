<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

 ?>

<a href="<?php echo base_url()?>index.php/autor/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Autor</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Autor</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Autor</th>
            <th>Número do Sobrenome</th>
            <th>Descrição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma Autor Cadastrada</td>
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
        <h5>Autor</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Autor</th>
            <th>Número do Sobrenome</th>
            <th>Descrição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td style="text-align:center">'.$r->idAutor.'</td>';
            echo '<td style="text-align:center">'.$r->autor.'</td>';
			echo '<td style="text-align:center">'.$r->numero.'</td>';
			echo '<td style="text-align:center">'.$r->descricao.'</td>';
            echo '<td style="text-align:center">';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eAutor')){
                		echo '<a href="'.base_url().'index.php/autor/editar/'.$r->idAutor.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Autor"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dAutor')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" autor="'.$r->idAutor.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Autor"><i class="icon-remove icon-white"></i></a>'; 
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
  <form action="<?php echo base_url() ?>index.php/autor/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Autor</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idAutor" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta autor e os dados associados a ela?</h5>
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
        
        var autor = $(this).attr('autor');
        $('#idAutor').val(autor);

    });

});

</script>

