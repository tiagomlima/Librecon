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
                <h5>Cadastro de Empréstimo</h5>
            </div>
            <div class="widget-content nopadding">
                

                <div class="span12" id="divAcervosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Empréstimo</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                <?php if($custom_error == true){ ?>
                                <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" id="formEmprestimo">

                                    <div class="span12" style="padding: 1%">

                                        <div class="span0">
                                            <input id="dataVencimento" type="hidden" name="dataVencimento" value="<?php echo date('d/m/Y'); ?>" />
                                            <input id="dataEmprestimo" class="span12 datepicker" type="hidden" name="dataEmprestimo" value="<?php echo date('d/m/Y'); ?>" />
                                        </div>
                                       
                                        <div class="span4">
                                            <label for="leitor">Leitor<span class="required">*</span></label>
                                            <input id="leitor" class="span12" type="text" name="leitor" value=""  />
                                            <input id="leitor_id" class="span12" type="hidden" name="leitor_id" value=""  /> 
                                            <input id="grupo_id" class="span12" type="hidden" name="grupo_id" value=""  />                       
                                        </div>
                                        <div class="span4">
                                            <label for="usuario">Usuário<span class="required">*</span></label>
                                            <input id="usuario" class="span12" type="text" name="usuario" value=""  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value=""  />
                                            <input id="status" type="hidden" name="status" value="Não emprestado"  />
                                        </div>
                                        
                                    </div>
                              
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                            <a href="<?php echo base_url() ?>index.php/emprestimos" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
                 $("#leitor_id").val(ui.item.id);
                 $("#grupo_id").val(ui.item.grupo);                                 
            }
      });
      $("#usuario").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteUsuario",
            minLength: 1,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      });
      
      
      $("#formEmprestimo").validate({
          rules:{
             leitor_id: {required:true},
             usuario: {required:true},
             dataEmprestimo: {required:true}
             
          },
          messages:{
             leitor_id: {required: 'Campo Requerido.'},
             usuario: {required: 'Campo Requerido.'},
             dataEmprestimo: {required: 'Campo Requerido.'}
            
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
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
   
});
</script>