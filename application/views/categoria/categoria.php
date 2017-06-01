<a href="<?php echo base_url()?>index.php/categoria/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Categoria</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Categoria</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Categoria</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhuma categoria cadastrada</td>
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
        <h5>Categoria</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Categoria</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idCategoria.'</td>';
            echo '<td>'.$r->nomeCategoria.'</td>';
            echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eCategoria')){
                		echo '<a href="'.base_url().'index.php/categoria/editar/'.$r->idCategoria.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Tipo de Item"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dCategoria')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" categoria="'.$r->idCategoria.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Categoria"><i class="icon-remove icon-white"></i></a>'; 
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
  <form action="<?php echo base_url() ?>index.php/categoria/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Categoria</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idCategoria" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir essa categoria?</h5>
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
        
        var categoria = $(this).attr('categoria');
        $('#idCategoria').val(categoria);

    });

});

</script>

