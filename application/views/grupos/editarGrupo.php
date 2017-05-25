<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Grupo</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo current_url(); ?>" id="formGrupo" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('idGrupo',$result->idGrupo) ?>
                        <label for="nomeGrupo" class="control-label">Nome do grupo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeGrupo" type="text" name="nomeGrupo" value="<?php echo $result->nomeGrupo; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="duracao_dias" class="control-label">Duração (dias) <span class="required">*</span></label>
                        <div class="controls">
                            <input id="duracao_dias" type="text" name="duracao_dias" value="<?php echo $result->duracao_dias; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="qtde_max_exemplares" class="control-label">Quantidade Máxima de Itens<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_item" type="text" name="qtde_max_item" value="<?php echo $result->qtde_max_item; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="qtde_max_renovacao" class="control-label">Quantidade Máxima de Renovação<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_renovacao" type="text" name="qtde_max_renovacao" value="<?php echo $result->qtde_max_renovacao; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="qtde_max_reserva" class="control-label">Quantidade Máxima de Reserva<span class="required">*</span></label>
                        <div class="controls">
                            <input id="qtde_max_reserva" type="text" name="qtde_max_reserva" value="<?php echo $result->qtde_max_reserva; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="validade_reserva" class="control-label">Validade da Reserva (dias) <span class="required">*</span></label>
                        <div class="controls">
                            <input id="validade_reserva" type="text" name="validade_reserva" value="<?php echo $result->validade_reserva; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="multa" class="control-label">Valor da Multa R$<span class="required">*</span></label>
                        <div class="controls">
                            <input id="multa" type="text" name="multa" value="<?php echo $result->multa; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="observacoes" class="control-label">Observações</label>
                        <div class="controls">
                            <input id="observacoes" type="text" name="observacoes" value="<?php echo $result->observacoes; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
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

           $('#formCurso').validate({
            rules : {
                  nomeGrupo:{ required: true},
                  duracao_dias:{ required: true},
                  qtde_max_item:{ required: true},
                  qtde_max_renovacao:{ required: true},
                  qtde_max_reserva:{ required: true},
                  validade_reserva:{ required: true},
                  multa:{ required: true},            
   
            },
            messages: {
                  nomeGrupo :{ required: 'Campo Requerido.'},
                  duracao_dias :{ required: 'Campo Requerido.'},
                  qtde_max_item :{ required: 'Campo Requerido.'},
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


