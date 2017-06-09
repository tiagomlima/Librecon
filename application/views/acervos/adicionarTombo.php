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
                <h5>Atribuir tombo aos exemplares </h5>
                	<span style="margin-left: 60%">                            	                	
                		 <b style="margin-right: 0.2%">Quantidade</b>
                		
                		<a href="<?php echo base_url();?>index.php/acervos/addQTombo/<?php echo $acervo->idAcervos ?>"><button class="btn btn-success" style="margin-bottom: 0.6%"><i class="icon-plus icon-white"></i></button></a>   
                		<a href="<?php echo base_url();?>index.php/acervos/removeQTombo/<?php echo $acervo->idAcervos ?>"><button class="btn btn-danger" style="margin-bottom: 0.6%"><i class="icon-minus icon-white"></i></button></a>                           	
               	    </span>
            </div>
            <div class="widget-content nopadding">
            	<?php echo $custom_error; ?>           	                    	 
                <form action="<?php echo current_url() ?>" id="formTombo" method="post" class="form-horizontal" >
                	<?php 
                     	$i = 1;
						$x = $acervo->estoque;
                     	for($i; $i <= $x; $i++){ ?>
                     <div class="control-group">
                     	
                        <label for="titulo" class="control-label">Exemplar <?php echo $i ?> <span class="required">*</span></label>
                        <div class="controls">
                            <input id="tombo<?php echo $i ?>" type="text" name="tombo<?php echo $i ?>" placeholder="Tombo" value="" class="span2" />
                            <input type="hidden" name="teste" id="teste" value="<?php set_value('teste'); ?>"/>
                        </div>
                    </div>                    	
                    	<?php } ?>               
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Atribuir</button>
                                <a href="<?php echo base_url() ?>index.php/acervos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>													                    
                </form>
            </div>

         </div>
     </div>
</div>

<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#formTombo').validate({
            rules :{                 
                  tombo: { required: true}
                  
            },
            messages:{               
                  tombo:{ required: 'Campo Requerido.'}
                  
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
    });
</script>
