<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Reserva </h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divAcervosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da Reserva</a></li>
						
                    </ul>
                    <div class="tab-content">
                    		                                   	                      	     
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarReserva">                                                                                                 
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Reserva: <?php echo $result->idReserva; 
                                        if($result->status == 'Retirado'){
                                        	echo ' (Retirado em: '.date('d/m/y', strtotime($result->dataRetirada)).')';
                                        }
                                        
                                        ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataPrazo">Data de Vencimento</label>
                                            <?php if($result->status == 'Retirado'){
                                            	$disabled = 'disabled';
											}else{
												$disabled = '';
											} 																																																					
											?>
                                            <input id="dataPrazo" class="span12 datepicker" type="text" name="dataPrazo" value="<?php echo date('d/mY', strtotime($result->dataPrazo)); ?>" readonly="true" />
                                            <label  class="control-label">Status</span></label>
						                        <div class="controls">
						                            <select name="status" id="status">
						                                  <?php  {						                                     
						                                      echo '<option value="'.$result->status.'"selected>'.$result->status.'</option>';
						                                  } ?>						                                  
						                            </select>
						                        </div>
                                       		 </div>
                                       		 	
                                        <div class="span3" style="margin-left: 20">
                                           
                                             <label for="leitor">Leitor</label>
                                            <input id="leitor" class="span12" type="text" name="leitor" value="<?php echo $leitor->nome ?>" <?php echo $disabled ?> readonly />
                                            <input id="leitor_id" class="span12" type="hidden" name="leitor_id" value="<?php echo $result->usuario_id ?>"  />
                                        </div>
                                                                                                                     
                                    </div>                                                                                                                                                                             
                                                              
                                    <div class="span12" id="divAcervos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblAcervos">
                                            <thead>
                                                <tr>                                              
                                                   <th>Acervo</th>                                                  
                                                   <?php if($result->status != 'Retirado' && $this->session->userdata('tipo_usuario') == 1){ ?>
                                                   <th>Remover</th>  
                                                   <?php } ?>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($acervos as $p) {
                                                	                                                                                                   
                                                    echo '<tr>';
                                                    echo '<td style="text-align: center"><a href="'.base_url().'index.php/acervos/visualizar/'.$p->idAcervos.'">'.$p->titulo.'</a></td>';
													if($result->status != 'Retirado' && $this->session->userdata('tipo_usuario') == 1){
                                                    echo '<td style="text-align: center"><a href="" idAcao="'.$p->idItem.'" prodAcao="'.$p->idAcervos.'" idEmprestimo="'.$p->reserva_id.'" title="Excluir Acervo" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
													}                                                   
                                                    echo '</tr>';
                                                }?>
                                                                        
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
  <form id="formReservar" action="<?php echo base_url(); ?>index.php/reservas/reservar" method="post">
  <input id="qtde_atual" class="span12" type="hidden" name="qtde_atual" value="<?php echo $result->qtde_item ?>"  />
  <input id="idReserva" class="span12" type="hidden" name="idReserva" value="<?php echo $result->idReserva ?>"  /> 
  <a href="<?php echo base_url() ?>index.php/reservas" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
  <?php if($result->status != 'Retirado' && $result->status !='Reservado' && $this->session->userdata('tipo_usuario') == 1 && $result->status != 'Recusado'){ ?>
  <button class="btn btn-primary">Reservar</button>
  <?php } ?>
  <?php if($this->session->userdata('tipo_usuario') == 1 && $result->status != 'Retirado'){?>
  <a href="<?php echo base_url(); ?>index.php/reservas/cancelar"><span class="btn btn-danger">Cancelar</span></a>   
  <?php } ?>
  </form>
  
</div>
</form>
</div>




 

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			$("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
    
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/emprestimos/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar realizar emprestimo.');
                    $('#progress-fatura').hide();
                }
              }
              });
              return false;
          }
     });
     $("#acervos").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteAcervo",
            minLength: 2,
            select: function( event, ui ) {
                 $("#acervos_id").val(ui.item.id);
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
            var idReserva = $(this).attr('idEmprestimo');
            var acervo = $(this).attr('prodAcao');
            if((idAcervo % 1) == 0){
                $("#divAcervos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/reservas/excluirAcervo",
                  data: "idAcervo="+idAcervo+"&idReserva="+idReserva+"&acervo="+acervo,
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
