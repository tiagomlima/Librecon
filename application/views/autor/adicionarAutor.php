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
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Autor</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formAutor" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <label for="autor" class="control-label">Autor<span class="required">*</span></label>
                        <div class="controls">
                            <input id="autor" type="text" name="autor" value="<?php echo set_value('autor'); ?>"  />
                        </div>
                    </div>
                      
                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <div class="controls">
                            <textarea id="descricao" type="text" name="descricao"   value="" ></textarea>
                        </div>
                    </div>

 					<div class="control-group">
                        <label for="numero" class="control-label">Número do Sobrenome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero" type="text" name="numero" value="<?php echo set_value('numero'); ?>" ></textarea>
                        </div>
                    </div>
 
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/autor" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script  src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script type="text/javascript">
      $(document).ready(function(){

           $('#formAutor').validate({
            rules : {
                  autor:{ required: true},
                  numero:{ required: true},
                  
                  
            },
            messages: {
                  autor :{ required: 'Campo Requerido.'},
                  numero :{ required: 'Campo Requerido.'},
                  
                  

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




