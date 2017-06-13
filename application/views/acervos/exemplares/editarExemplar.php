<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Exemplares </h5>
                	<span style="margin-left: 84%">                            	                	                		
                		<a href="<?php echo base_url();?>index.php/acervos/addExemplar/<?php echo $acervo->idAcervos ?>"><button class="btn btn-success" style="margin-top: 0.2%"><i class="icon-plus icon-white"></i></button></a>   
                		                           	
               	    </span>
            </div>
            <div class="widget-content nopadding">
            	<?php  
            	$i = 1 ?>           	                    	 
	           <form  method="post" class="form-horizontal" >    
	           	   <?php foreach($tombo as $t){ ?>
	           	   		    	
			         <div class="control-group">		                     	
				         <label for="titulo" class="control-label">Tombo - Exemplar <?php echo $i ?> <span class="required">*</span></label>
				         <div class="controls">			                        	
				         <input id="tombo<?php echo $i ?>" type="text" name="tombo<?php echo $i ?>" placeholder="Tombo" value="<?php echo $t->tombo; ?>" class="span2" readonly />
				         <a href="#modal-editar" role="button" data-toggle="modal" exemplar="<?php echo $t->idExemplar ?>" acervo="<?php echo $t->acervos_id ?>"><button class="btn btn-primary"><i class="icon-edit icon-white"></i></button></a>
				         <a href="<?php echo base_url(); ?>index.php/acervos/excluirExemplar/<?php echo $t->idExemplar ?>/<?php echo $t->acervos_id ?>"><button type="button" class="btn btn-danger"><i class="icon-remove icon-white"></i></button></a>				         			                            
				         <input type="hidden" name="teste" id="teste" value="<?php set_value('teste'); ?>"/>
			          </div>
			        <?php $i++ ?>
			       <?php } ?>   
		     </div> 
                  			              
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <a href="<?php echo base_url() ?>index.php/acervos/visualizar/<?php echo $acervo->idAcervos ?>" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>													                    
                </form>
            </div>

         </div>
     </div>
</div>

<!-- Modal excluir 
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/acervos/excluirExemplar" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Exemplar</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idExemplar" name="idExemplar" value="" />
    <input type="hidden" id="idAcervo" name="idAcervo" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este exemplar?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>

<!-- Modal editar -->
<div id="modal-editar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/acervos/editExemplar" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Editar Exemplar</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idExemplar" name="idExemplar" value="" />
    <input type="hidden" id="idAcervo" name="idAcervo" value="" />
    
    <label>Tombo:</label><input type="text" name="tombo" id="tombo" style="margin-left: 11%;margin-top:-7.8%;width:15%"/>
	
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-primary">Editar</button>
  </div>
  </form>
</div>

<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
           
           $(document).on('click', 'a', function(event) {
        
	        var exemplar = $(this).attr('exemplar');
	        $('#idExemplar').val(exemplar);
	        var idAcervo = $(this).attr('acervo');
	        $('#idAcervo').val(idAcervo);
	    });	    	    
    	
    });
</script>
