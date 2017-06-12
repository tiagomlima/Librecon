<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/


?>
<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aLeitor')){ ?>
    <a href="<?php echo base_url();?>index.php/leitores/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Leitor</a>    
<?php } ?>

<?php
if(!$results){?>

        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Leitores</h5>
            
				<form style="margin-left:15%" action="<?php base_url() ?>leitores/pesquisar" method="post">       		
	            <select name="curso_id" id="curso_id" style="width:15%">                                 
	            	<option value="">Curso</option>
	            	<?php foreach ($cursos as $c) {
                           echo '<option value="'.$c->idCursos.'">'.$c->nomeCurso.'</option>';
                    } ?>                                  
	            </select>                                        	                       
                <select name="grupo_id" id="grupo_id" style="width:15%">                                 
                	<option value="">Grupo</option>
                	<?php foreach ($grupos as $g) {
                           echo '<option value="'.$g->idGrupo.'">'.$g->nomeGrupo.'</option>';
                    } ?>                                  
                </select>
                <select name="status" id="status" style="width:15%">                                 
                	<option value="">Status</option>
                	<option value="1">Multado</option> 
                	<option value="0">Inativo</option>               	                              
                </select>
                <input type="text" id="nome" name="nome" value="" placeholder="Procurar por nome" style="width:15%">
                <input type="text" id="matricula" name="matricula" value="" placeholder="Procurar por R.A" style="width:18%">
                <button style="margin-bottom:1%"><i class="icon-search icon-white"></i></button>     
        	</form>
        	
        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    	<th></th>
                        <th>Nome</th>
			            <th>R.A</th>
			            <th>Curso</th>
			            <th>E-mail</th>
			            <th>Telefone</th>
						<th>Grupo</th>
			            <th>Visualizar/Editar/Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Leitor Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{
	

?>
<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Leitores</h5>
        	<form style="margin-left:15%" action="<?php base_url() ?>leitores/pesquisar" method="post">       		
	            <select name="curso_id" id="curso_id" style="width:15%">                                 
	            	<option value="">Curso</option>
	            	<?php foreach ($cursos as $c) {
                           echo '<option value="'.$c->idCursos.'">'.$c->nomeCurso.'</option>';
                    } ?>                                  
	            </select>                                        	                       
                <select name="grupo_id" id="grupo_id" style="width:15%">                                 
                	<option value="">Grupo</option>
                	<?php foreach ($grupos as $g) {
                           echo '<option value="'.$g->idGrupo.'">'.$g->nomeGrupo.'</option>';
                    } ?>                                  
                </select>
                <select name="status" id="status" style="width:15%">                                 
                	<option value="">Status</option>
                	<option value="Multado">Multado</option> 
                	<option value="Inativo">Inativo</option>               	                              
                </select>
                <input type="text" id="nome" name="nome" value="" placeholder="Procurar por nome" style="width:15%">
                <input type="text" id="matricula" name="matricula" value="" placeholder="Procurar por R.A" style="width:18%">
                <button style="margin-bottom:1%"><i class="icon-search icon-white"></i></button>     
        	</form>
		
     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
        	<th></th>
            <th>Nome</th>
            <th>R.A</th>
            <th>Curso</th>
            <th>E-mail</th>
            <th>Telefone</th>
			<th>Grupo</th>
            <th>Visualizar/Editar/Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php 
                    
        	foreach ($results as $r){     										
        		echo '<tr>';
				echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$r->idUsuarios.'"><img src="'.$r->img_leitor.'" alt="foto do leitor" style="width:108px;height:118px"/></td></a>';
				echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$r->idUsuarios.'">'.$r->nome.'</a></td>';
				echo '<td style="text-align:center">'.$r->matricula.'</td>';
				
				$this->db->where('idCursos',$r->curso_id);
				$curso = $this->db->get('cursos')->result();
				foreach ($curso as $c){
					echo '<td style="text-align:center">'.$c->nomeCurso.'</td>';
					echo '<td style="text-align:center">'.$r->email.'</td>';
					echo '<td style="text-align:center">'.$r->telefone.'</td>';
					
					$this->db->where('idGrupo',$r->grupo_id);
					$grupo = $this->db->get('grupos')->result();
					foreach ($grupo as $g) {
					echo '<td style="text-align:center">'.$g->nomeGrupo.'</td>';
					echo '<td style="text-align:center">';
					
					if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){
		                echo '<a href="'.base_url().'index.php/leitores/visualizar/'.$r->idUsuarios.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
		            }
		            if($this->permission->checkPermission($this->session->userdata('permissao'),'eLeitor')){
		                echo '<a href="'.base_url().'index.php/leitores/editar/'.$r->idUsuarios.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Leitor"><i class="icon-pencil icon-white"></i></a>'; 
		            }
		            if($this->permission->checkPermission($this->session->userdata('permissao'),'dLeitor')){
		                echo '<a href="#modal-excluir" role="button" data-toggle="modal" leitor="'.$r->idUsuarios.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Leitor"><i class="icon-remove icon-white"></i></a>'; 
		            }
					
					echo '</td>';						
					echo '</tr>';
					}
				}
        	}
        ?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/leitores/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Leitor</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idUsuarios" name="idUsuarios" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este leitor e os dados associados a ele?</h5>
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
        
        var leitor = $(this).attr('leitor');
        $('#idUsuarios').val(leitor);

    });

});

</script>
