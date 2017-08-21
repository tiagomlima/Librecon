<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>

<div class="row-fluid" style="margin-top: 0">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Etiquetas</h5>
			</div>
			<div class="widget-content">
				<label>
	                <input name="" type="checkbox" value="1" id="marcarTodos" />
	                <span class="lbl"> Marcar Todos</span>
                </label>
                <br/>
                
                <div class="control-group">
                	<div class="controls">
                		<form action="<?php echo base_url();?>index.php/librecon/gerarEtiqueta" id="formEtiqueta" method="post" />              			
                		<table class="table table-bordered">
                			<tbody>
                				
                			<?php $i = 0; ?>
                			<?php $y = 0; ?>
                			<?php foreach($acervos as $a){?>
                				<tr>
                					<td>
                						<b><?php echo $a->titulo; ?></b>  <a href="#demo<?php echo $i; ?>" class="btn-mini btn-warning" data-toggle="collapse"><i class="icon-plus icon-white"></i></a>
										  <div id="demo<?php echo $i; ?>" class="collapse">
										  	<br/>
										    <?php 
										    	$this->db->where('acervos_id',$a->idAcervos);
												$tombo = $this->db->get('exemplares')->result();
												$x = 0;
												
												foreach($tombo as $t){ ?>
													<label>
                                            			<input name="tombo[<?php echo $y; ?>]" class="marcar" type="checkbox" value="<?php echo $t->tombo; ?>" />
                                            			<span class="lbl">Exemplar <?php echo $x + 1; ?>/ Tombo: <?php echo $t->tombo ;?></span>
                                        			</label>	
												<?php $x++; ?>	
												<?php $y ++; ?>	
												<?php };
										    	?>	
										    	<br/>									    
										  </div>
                					</td>
                				</tr>
                			<?php $i++ ;?>
                			<?php }; ?>
                				
                			</tbody>
                		</table>
                		
                	</div>
                </div>
                <button type="submit" class="btn btn-success">Gerar</button>
			</div>			
		</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $("#marcarTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });  
       

    });
</script>