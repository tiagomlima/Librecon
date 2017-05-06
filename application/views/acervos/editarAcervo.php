<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Editar Acervo</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formAcervo" method="post" class="form-horizontal" >
                     <div class="control-group">
                        <?php echo form_hidden('idAcervos',$result->idAcervos) ?>
                        <label for="titulo" class="control-label">Titulo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="titulo" type="text" name="titulo" value="<?php echo $result->titulo; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="tombo" class="control-label">Tombo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="tombo" type="text" name="tombo" value="<?php echo $result->tombo; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="quantidae" class="control-label">Quantidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="quantidade" type="text" name="quantidade" value="<?php echo $result->quantidade; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="idioma" class="control-label">Idioma<span class="required">*</span></label>
                        <div class="controls">
                            <input id="idioma" type="text" name="idioma" value="<?php echo $result->idioma; ?>"  />
                        </div>
                    </div>

                    <!--<div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="precoCompra" class="money" type="text" name="precoCompra" value="<?php echo $result->precoCompra; ?>"  />
                        </div>
                    </div>-->

                    

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/acervos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>

         </div>
     </div>
</div>


<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formAcervo').validate({
            rules :{
                  titulo: { required: true},
                  tombo: { required: true},
                  quantidade: { required: true},
                  idioma: { required: true},
                  
            },
            messages:{
                  titulo: { required: 'Campo Requerido.'},
                  tombo: {required: 'Campo Requerido.'},
                  quantidade: { required: 'Campo Requerido.'},
                  idioma: { required: 'Campo Requerido.'},
                  
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




