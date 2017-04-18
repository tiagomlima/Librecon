<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Disciplina</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formDisciplina" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('idDisciplina',$result->idDisciplina) ?>
                        <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeDisciplina" type="text" name="nomeDisciplina" value="<?php echo $result->nomeDisciplina; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Curso<span class="required">*</span></label>
                        <div class="controls">
                            <select name="curso_id" id="curso_id">
                                  <?php foreach ($cursos as $c) {
                                     if($c->idCursos == $result->curso_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$c->idCursos.'"'.$selected.'>'.$c->nomeCurso.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/disciplinas" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formDisciplina').validate({
            rules : {
                  nomeDisciplina:{ required: true},
                  
                  curso_id:{ required: true},
                  
                  
            },
            messages: {
                  nome :{ required: 'Campo Requerido.'},
                  
                  curso_id:{ required: 'Campo Requerido.'},
                  
                  

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


