<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Empréstimo </h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divAcervosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Empréstimo</a></li>
						
                    </ul>
                    <div class="tab-content">
                    	
	                    <div style="float:right;width: 17%">
	                    	<form action="<?php echo base_url();?>index.php/emprestimos/finalizarEmprestimo" method="post">
	                    		<input type="hidden" id="idEmprestimos" name="idEmprestimos" value="<?php echo $result->idEmprestimos ?>">
	                    		<input type="hidden" id="status" name="status" value="<?php echo $result->status ?>">
	                    		<?php if($result->status == 'Emprestado'){?>	                   		
	                    		<button class="btn btn-success " id="btnFinalizarEmprestimo"><i class="icon-ok"></i> Finalizar Empréstimo</button>
	                    		<?php } ?>
	                    		<?php if($result->status == 'Renovado'){?>	                   		
	                    		<button class="btn btn-success " id="btnFinalizarEmprestimo"><i class="icon-ok"></i> Finalizar Empréstimo</button>
	                    		<?php } ?>
	                    	</form>	                   	                    	                        		                    	                   			                   			                	 	
	                   	 </div>
                   	     <div style="width: 31%;float:left">
                   	     	<form action="<?php echo base_url();?>index.php/emprestimos/renovar" method="post">
                   	     		<input type="hidden" id="idEmprestimos" name="idEmprestimos" value="<?php echo $result->idEmprestimos ?>">
                   	     		<input type="hidden" id="status" name="status" value="Renovado">
                   	     		<input type="hidden" id="qtde_max_renovacao" name="qtde_max_renovacao" value="<?php echo $grupos->qtde_max_renovacao ?>">
                   	     		<input type="hidden" id="qtde_renovacao" name="qtde_renovacao" value="<?php echo $result->qtde_renovacao ?>">
                   	     		<input type="hidden" id="duracao_dias" name="duracao_dias" value="<?php echo $grupos->duracao_dias ?>">                 	     		
                   	     		<?php if($result->status == 'Emprestado'){?>	                   		
	                    		<button class="btn btn-warning " id="btnRenovar"><i class="icon-repeat"></i> Renovar Empréstimo</button>
	                    		<?php } ?>
	                    		<?php if($result->status == 'Renovado'){?>	                   		
	                    		<button class="btn btn-warning " id="btnRenovar"><i class="icon-repeat"></i> Renovar Empréstimo</button>
	                    		<?php } ?>
                   	     	</form>                  	     
                   	     </div>
                   	     
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarEmprestimo">
                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formEmprestimo">
                                    <?php echo form_hidden('idEmprestimos',$result->idEmprestimos) ?>
                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Emprestimo: <?php echo $result->idEmprestimos; 
                                        if($result->status == 'Devolvido'){
                                        	echo ' (Finalizado)';
                                        }
                                        
                                        ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataVencimento">Data de Vencimento</label>
                                            <?php if($result->status == 'Devolvido'){
                                            	$disabled = 'disabled';
											}else{
												$disabled = '';
											} 
											
											$duracao = $grupos->duracao_dias;
																						
																						
											?>
                                            <input id="dataVencimento" class="span12 datepicker" type="text" name="dataVencimento" value="<?php echo date('d/m/Y', strtotime("+".$duracao." days")); ?>" readonly="true" />
                                            <label  class="control-label">Status</span></label>
						                        <div class="controls">
						                            <select name="status" id="status">
						                                  <?php  {						                                     
						                                      echo '<option value="'.$result->status.'"selected>'.$result->status.'</option>';
						                                  } ?>						                                  
						                            </select>
						                        </div>
                                        </div>
                                        <div class="span0" style="margin-left: 0">
                                           
                                            <input id="dataEmprestimo" class="span12 datepicker" type="hidden" name="dataEmprestimo" value="<?php echo date('d/m/Y', strtotime($result->dataEmprestimo)); ?>"  />
                                        </div>
                                        <div class="span5" style="margin-left: 0">
                                            <label for="leitor">Leitor<span class="required">*</span></label>
                                            <input id="leitor" class="span12" type="text" name="leitor" value="<?php echo $leitor->nome ?>" <?php echo $disabled ?>  />
                                            <input id="leitor_id" class="span12" type="hidden" name="leitor_id" value="<?php echo $result->leitor_id ?>"  />
                                                                                     
                                        </div>
                                        <div class="span5">
                                            <label for="usuario">Usuário</label>
                                            <input id="usuario" class="span12" type="text" name="usuario" value="<?php echo $result->nome ?>" <?php echo $disabled ?> readonly />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                        
                                    </div>
                                                                                                                                             
                                    <div class="span12" style="padding: 1%; margin-left: 0">
            
                                        <div class="span8 offset2" style="text-align: center">
                                            <?php if($result->status != 'Devolvido'){ ?>                                                                                                                                                                                                                                                                                                                                                           
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <?php } ?>
                                            <?php if($result->status != 'Não emprestado'&& $result->status != 'Devolvido') { ?>
                                            <a href="<?php echo base_url() ?>index.php/emprestimos/visualizar/<?php echo $result->idEmprestimos; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Gerar Comprovante</a>
                                            <?php } ?>
                                            <?php if($result->status == 'Devolvido') { ?>
                                            <a href="<?php echo base_url() ?>index.php/emprestimos/visualizar/<?php echo $result->idEmprestimos; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Ver Comprovante</a>
                                            <?php } ?>
                                            <a href="<?php echo base_url() ?>index.php/emprestimos" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>

                                    </div>

                                </form>
                                
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                        
                                        <form id="formAcervos" action="<?php echo base_url(); ?>index.php/emprestimos/adicionarAcervo" method="post">
                                            <div class="span12">
                                                <input type="hidden" name="idAcervo" id="idAcervo" value=""/>
                                                <input type="hidden" name="idEmprestimosAcervo" id="idEmprestimosAcervo" value="<?php echo $result->idEmprestimos?>" />
                                                <?php if($result->status != 'Devolvido'){ ?>
                                                <label for="">Acervo</label>
                                                <input type="text"  name="acervos" id="acervos" placeholder="Digite o nome do acervo" value=""/>
                                                <input type="hidden"  name="acervos_id" id="acervos_id" value=""/>
                                                <input type="hidden"  name="idExemplar" id="idExemplar" value=""/>
                                                <?php } ?>
                                                <input type="hidden"  name="estoque" id="estoque" value=""/>
                                                <input type="hidden" id="qtde_max_item"  name="qtde_max_item" value="<?php echo $grupos->qtde_max_item ?>" />
  												<input type="hidden" id="$qtde_atual" name="qtde_atual" value="<?php echo $result->qtde_item ?> />
                                                
                                            </div>
                                                                                                                                                                          
                                            <div class="span2">
                                                <label for="">&nbsp</label>
                                                <?php if($result->status != 'Devolvido'){ ?>
                                                <button class="btn btn-success span2" id="btnAdicionarAcervo"><i class="icon-white icon-plus"></i> Adicionar</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="span12" id="divAcervos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblAcervos">
                                            <thead>
                                                <tr>                                              
                                                   <th>Título</th>
                                                   <th>Tombo</th>
                                                   <?php if($result->status != 'Devolvido'){ ?>
                                                   <th>Remover</th>  
                                                   <?php } ?>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php                                                                                                													
													foreach ($acervos as $p) {
                                                	                                                                                                   
                                                    echo '<tr>';
                                                    echo '<td style="text-align:center"><a href="'.base_url().'index.php/acervos/visualizar/'.$p->idAcervos.'">'.$p->titulo.'</a></td>';
													
													$this->db->where('emprestimos_id',$result->idEmprestimos);
													$this->db->where('acervos_id',$p->idAcervos);
													$itens = $this->db->get('itens_de_emprestimos')->result();
													
													foreach ($itens as $i){
														$this->db->where('idExemplar',$i->exemplar_id);
														$this->db->where('acervos_id',$p->idAcervos);
														$exemplar = $this->db->get('exemplares')->row();
														
														echo '<td style="text-align:center">'.$exemplar->tombo.'</td>';
														if($result->status != 'Devolvido'){
	                                                    echo '<td style="text-align:center"><a href="" idAcao="'.$p->idItens.'" prodAcao="'.$p->idAcervos.'" idEmprestimo="'.$p->emprestimos_id.'" title="Excluir Acervo" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
														}                                                   
	                                                    echo '</tr>';
													}																										
                                                }  
												?>
                                                                                                                                                                        
                                            </tbody>
                                        </table> 
                                        
                                                                                                                                                              
                                    </div>

                            </div>

                        </div>

                    </div>

                </div>


.

        </div>

    </div>
</div>
</div>

    
</div>
<div class="modal-footer">
  <form id="formEmprestar" action="<?php echo base_url(); ?>index.php/emprestimos/emprestar" method="post">
  
  <input id="idEmprestimos" class="span12" type="hidden" name="idEmprestimos" value="<?php echo $result->idEmprestimos ?>"  />
  <input type="hidden" id="status" name="status" value="Emprestado"/>
  <input type="hidden" id="leitor_id" name="leitor_id" value="<?php echo $result->leitor_id ?>"/>
  <?php
  	$duracao = $grupos->duracao_dias;  
   ?>
  <input type="hidden" id="dataVencimento" name="dataVencimento" value="<?php echo date('d/m/Y', strtotime("+".$duracao." days")); ?> "/>
  
  <a href="<?php echo base_url() ?>index.php/emprestimos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
  <?php if($result->status != 'Devolvido' && $result->status !='Emprestado' && $result->status != 'Renovado'){ ?>
  <button class="btn btn-primary">Emprestar</button>
  <?php } ?>
  </form>
</div>
</form>
</div>



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/emprestimos/excluirAcervo" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Item</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="acervos_id" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este item da lista?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>
 

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			
     $("#acervos").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteAcervo",
            minLength: 2,
            select: function( event, ui ) {
                 $("#acervos_id").val(ui.item.id);
                 $("#idExemplar").val(ui.item.exemplar);
                 $("#estoque").val(ui.item.estoque);                                 
            }
      });
      $("#leitor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteLeitor",
            minLength: 2,
            select: function( event, ui ) {
                 $("#leitor_id").val(ui.item.id);
            }
      });
      $("#usuario").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      });
      $("#formEmprestimo").validate({
          rules:{
             leitor: {required:true},
             usuario: {required:true},
             dataEmprestimo: {required:true},
             dataVencimento: {required:true}
          },
          messages:{
             leitor: {required: 'Campo Requerido.'},
             usuario: {required: 'Campo Requerido.'},
             dataEmprestimo: {required: 'Campo Requerido.'},
             dataVencimento: {required: 'Campo Requerido.'}
          },
            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });
 
     
       $(document).on('click', 'a', function(event) {
            var idAcervo = $(this).attr('idAcao');
            var idEmprestimo = $(this).attr('idEmprestimo');
            var acervo = $(this).attr('prodAcao');
            if((idAcervo % 1) == 0){
                $("#divAcervos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/emprestimos/excluirAcervo",
                  data: "idAcervo="+idAcervo+"&idEmprestimo="+idEmprestimo+"&acervo="+acervo,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divAcervos" ).load("<?php echo current_url();?> #divAcervos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir acervo.');
                    }
                  }
                  });
                  return false;
            }
            
       });
   
       $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>
