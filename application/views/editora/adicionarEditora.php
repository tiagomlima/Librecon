<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Editora</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formEditora" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <label for="editora" class="control-label">Editora<span class="required">*</span></label>
                        <div class="controls">
                            <input id="editora" type="text" name="editora" value="<?php echo set_value('editora'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="email_editora" class="control-label">Email</label>
                        <div class="controls">
                            <input id="email_editora" type="email" name="email_editora" value="<?php echo set_value('email_editora'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="site" class="control-label">Site</label>
                        <div class="controls">
                            <input id="site" type="text" name="site" value="<?php echo set_value('site'); ?>"  />
                        </div>
                    </div>

 
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/editora" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formEditora').validate({
            rules : {
                  editora:{ required: true},
                  
                  
            },
            messages: {
                  editora :{ required: 'Campo Requerido.'},
                  
                  
                  

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




