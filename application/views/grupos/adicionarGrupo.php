<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Grupo</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">'.$custom_error.'</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formGrupo" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <label for="nomeGrupo" class="control-label">Nome do Grupo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeGrupo" type="text" name="nomeGrupo" value="<?php echo set_value('nomeGrupo'); ?>"  />
                        </div>
                    </div>
                    
                     <div class="control-group">
                        <label for="duracao_dias" class="control-label">Duração<span class="required">*</span></label>
                        <div class="controls">
                            <input id="duracao_dias" type="text" name="duracao_dias" value="<?php echo set_value('duracao_dias'); ?>"  />
                        </div>
                    </div>
                    
                     <div class="control-group">
                        <label for="qtde_max_exemplares" class="control-label">Quantidade Máxima de Exemplares<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_exemplares" type="text" name="qtde_max_exemplares" value="<?php echo set_value('qtde_max_exemplares'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="qtde_max_renovacao" class="control-label">Quantidade Máxima de Renovação<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_renovacao" type="text" name="qtde_max_renovacao" value="<?php echo set_value('qtde_max_renovacao'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="qtde_max_reserva" class="control-label">Quantidade Máxima de Reserva<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_reserva" type="text" name="qtde_max_reserva" value="<?php echo set_value('qtde_max_reserva'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="validade_reserva" class="control-label">Validade da Reserva<span class="required">*</span></label>
                        <div class="controls">
                            <input id="validade_reserva" type="text" name="validade_reserva" value="<?php echo set_value('validade_reserva'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="multa" class="control-label">Valor da Multa<span class="required">*</span></label>
                        <div class="controls">
                            <input id="multa" type="text" name="multa" value="<?php echo set_value('multa'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="observacoes" class="control-label">Observações</label>
                        <div class="controls">
                            <input id="observacoes" type="text" name="observacoes" value="<?php echo set_value('observacoes'); ?>"  />
                        </div>
                    </div>
 
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/grupos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

           $('#formGrupo').validate({
            rules : {
                  nomeGrupo:{ required: true},
                  duracao_dias:{ required: true},
                  qtde_max_exemplares:{ required: true},
                  qtde_max_renovacao:{ required: true},
                  qtde_max_reserva:{ required: true},
                  validade_reserva:{ required: true},
                  multa:{ required: true},
            },
            messages: {
                  nomeGrupo :{ required: 'Campo Requerido.'},
                  duracao_dias :{ required: 'Campo Requerido.'},
                  qtde_max_exemplares :{ required: 'Campo Requerido.'},
                  qtde_max_renovacao :{ required: 'Campo Requerido.'},
                  qtde_max_reserva :{ required: 'Campo Requerido.'},
				  validade_reserva :{ required: 'Campo Requerido.'},
				  multa :{ required: 'Campo Requerido.'},
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



