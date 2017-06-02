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
            <th>Imagem</th>
            <th>Título</th>           
            <th>Tombo</th>
            <?php if($this->session->userdata('tipo_usuario') == 0){ ?>
            <th>Estoque</th>
            <?php } ?>
            <th>Idioma</th>
            <th>Status</th>
            <?php if($this->session->userdata('tipo_usuario') == 0){ ?>
            <th>Visualizar/Editar/Excluir</th>
            <?php } ?>
            
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
     <div class="widget-title" >
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Acervos</h5>
        	
        	<form style="margin-left:15%" action="<?php base_url() ?>acervos/pesquisar" method="post">       		
	            <select name="categoria_id" id="categoria_id" style="width:15%">                                 
	            	<option value="">Categoria</option>
	            	<?php foreach ($categoria as $c) {
                           echo '<option value="'.$c->idCategoria.'">'.$c->nomeCategoria.'</option>';
                    } ?>                                  
	            </select>                                        	                       
                <select name="autor_id" id="autor_id" style="width:15%">                                 
                	<option value="">Autor</option>
                	<?php foreach ($autor as $a) {
                           echo '<option value="'.$a->idAutor.'">'.$a->autor.'</option>';
                    } ?>                                  
                </select>
                <input type="text" id="nome" name="nome" value="" placeholder="Procurar por nome" style="width:15%">
                <input type="text" id="palavra_chave" name="palavra_chave" value="" placeholder="Procurar por palavra-chave" style="width:18%">
                <button style="margin-bottom:1%"><i class="icon-search icon-white"></i></button>     
        	</form>
        	
     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Imagem</th>
            <th>Título</th>            
            <th>Tombo</th>
            <?php if($this->session->userdata('tipo_usuario') == 0){ ?>
            <th>Estoque</th>
            <?php } ?>
            <th>Idioma</th>
            <th>Status</th>
            <?php if($this->session->userdata('tipo_usuario') == 0){ ?>
            <th>Visualizar/Editar/Excluir</th>
            <?php } ?>
            
        </tr>
    </thead>
    <tbody>
        <?php 	   
        	foreach ($results as $r) {  	
			            echo '<tr>';
			            echo '<td>'.$r->idAcervos.'</td>';
						echo '<td style="text-align:center"><a href="'.base_url().'index.php/acervos/visualizar/'.$r->idAcervos.'"><img src="'.$r->img_acervo.'" alt="imagem do acervo" style="width:108px;height:118px"/></td></a>';
						echo '<td><a href="'.base_url().'index.php/acervos/visualizar/'.$r->idAcervos.'">'.$r->titulo.'</a></td>';						
			            echo '<td>'.$r->tombo.'</td>';
						if($this->session->userdata('tipo_usuario') == 0){
						echo '<td>'.$r->estoque.'</td>';
						}
						echo '<td>'.$r->idioma.'</td>';
						if($r->estoque <= 1){
				        	$status = 'Não disponivel';
				        }else{
				        	$status = 'Disponivel';
				        }
			            echo '<td>'.$status.'</td>';
			            
						if($this->session->userdata('tipo_usuario') == 0){
			            echo '<td style="text-align:center">';
			            if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo') && $this->session->userdata('tipo_usuario') != 1){
			                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/acervos/visualizar/'.$r->idAcervos.'" class="btn tip-top" title="Visualizar Acervo"><i class="icon-eye-open"></i></a>  '; 
			            }
			            if($this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
			                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/acervos/editar/'.$r->idAcervos.'" class="btn btn-info tip-top" title="Editar Acervo"><i class="icon-pencil icon-white"></i></a>'; 
			            }
			            if($this->permission->checkPermission($this->session->userdata('permissao'),'dAcervo')){
			                echo '<a href="#modal-excluir" role="button" data-toggle="modal" acervo="'.$r->idAcervos.'" class="btn btn-danger tip-top" title="Excluir Acervo"><i class="icon-remove icon-white"></i></a>'; 
			            }
			                     
			            echo '</td>';
			            }
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