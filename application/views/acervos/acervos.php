<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aAcervo')){ ?>
    <a href="<?php echo base_url();?>index.php/acervos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Acervo</a>
<?php } ?>

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Acervos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Tombo</th>
            <th>Quantidade</th>
            <th>Idioma</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhum Acervo Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Acervos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Título</th>
            <th>Tombo</th>
            <th>Quantidade</th>
            <th>Idioma</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->idAcervos.'</td>';
            echo '<td>'.$r->titulo.'</td>';
            echo '<td>'.$r->tombo.'</td>';
			echo '<td>'.$r->quantidade.'</td>';
			echo '<td>'.$r->idioma.'</td>';
            
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/acervos/visualizar/'.$r->idAcervos.'" class="btn tip-top" title="Visualizar Acervo"><i class="icon-eye-open"></i></a>  '; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/acervos/editar/'.$r->idAcervos.'" class="btn btn-info tip-top" title="Editar Acervo"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dAcervo')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" acervo="'.$r->idAcervos.'" class="btn btn-danger tip-top" title="Excluir Acervo"><i class="icon-remove icon-white"></i></a>'; 
            }
                     
            echo '</td>';
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
  <form action="<?php echo base_url() ?>index.php/acervos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Acervo</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idAcervo" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este acervo?</h5>
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
        
        var acervo = $(this).attr('acervo');
        $('#idAcervo').val(acervo);

    });

});

</script>