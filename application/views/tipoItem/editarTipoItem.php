<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Curso</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formCurso" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('idCursos',$result->idCursos) ?>
                        <label for="nomeCurso" class="control-label">Nome do curso<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeCurso" type="text" name="nomeCurso" value="<?php echo $result->nomeCurso; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="disciplina" class="control-label">Disciplina<span class="required">*</span></label>
                        <div class="controls">
                            <input id="disciplina" type="text" name="disciplina" value="<?php echo $result->disciplina; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/cursos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formCurso').validate({
            rules : {
                  nomeCurso:{ required: true},
                  
                  disciplina:{ required: true},
                  
                  
            },
            messages: {
                  nomeCurso :{ required: 'Campo Requerido.'},
                  
                  disciplina:{ required: 'Campo Requerido.'},
                  
                  

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


