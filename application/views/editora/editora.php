<a href="<?php echo base_url()?>index.php/editora/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Editora</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Editora</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Editora</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma Editora Cadastrada</td>
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
        <h5>Editora</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome da Editora</th>
            <th>Email</th>
            <th>Site</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idEditora.'</td>';
            echo '<td>'.$r->editora.'</td>';
			echo '<td>'.$r->email_editora.'</td>';
			echo '<td>'.$r->site.'</td>';
            echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eEditora')){
                		echo '<a href="'.base_url().'index.php/editora/editar/'.$r->idEditora.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Editora"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dEditora')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" editora="'.$r->idEditora.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Editora"><i class="icon-remove icon-white"></i></a>'; 
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
  <form action="<?php echo base_url() ?>index.php/editora/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Editora</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idEditora" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta editora e os dados associados a ela?</h5>
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
        
        var editora = $(this).attr('editora');
        $('#idEditora').val(editora);

    });

});

</script>

