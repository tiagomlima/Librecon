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
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Reserva</h5>
            </div>
            <div class="widget-content nopadding">
                

                <div class="span12" id="divAcervosReservas" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Selecionar o leitor</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarReserva">
                               
                                <form action="<?php echo base_url(); ?>index.php/reservas/adicionar" method="post" id="formReserva">

                                    <div class="span12" style="padding: 1%">

                                        <div class="span0">
                                            <input id="dataReserva" type="hidden" name="dataReserva" value="<?php echo date('Y-m-d H:i:s'); ?>" />
                                        </div>
                                       
                                        <div class="span4">
                                            <label for="leitor" style="margin-left:140%"><h5>Leitor</h5></label>
                                            <input id="leitor" class="span8" type="text" name="leitor" value="" style="margin-left:115%"  />
                                            <input id="usuario_id" class="span12" type="hidden" name="usuario_id" value=""  /> 
                                            <input id="grupo_id" type="hidden" name="grupo_id" value=""  /> 
                                            <input id="status" type="hidden" name="status" value="Em andamento"  />                      
                                        </div>                                   
                                    </div>
                              
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                            <a href="<?php echo base_url() ?>index.php/reservas" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>

                
.
             
        </div>
        
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
      $("#leitor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteLeitor",
            minLength: 1,
            select: function( event, ui ) {
                 $("#usuario_id").val(ui.item.id);
                 $("#grupo_id").val(ui.item.grupo);                                 
            }
      });      
            
      $("#formReserva").validate({
          rules:{
             usuario_id: {required:true},
             grupo_id: {required:true},
             status: {required:true},
             dataReserva: {required:true}
             
          },
          messages:{
             usuario_id: {required: 'Campo Requerido.'},
             grupo_id: {required: 'Campo Requerido.'},
             status: {required: 'Campo Requerido.'},
             dataReserva: {required: 'Campo Requerido.'}
            
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


