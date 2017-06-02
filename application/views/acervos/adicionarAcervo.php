<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Acervo</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formAcervo" method="post" enctype="multipart/form-data" class="form-horizontal" >
                     <div class="control-group">
                        <label for="titulo" class="control-label">Titulo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="titulo" type="text" name="titulo" value="<?php echo set_value('titulo'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Autor<span class="required">*</span></label>
                        <div class="controls">
                            <select name="autor_id" id="autor_id">
                                  <?php foreach ($autor as $a) {
                                      echo '<option value="'.$a->idAutor.'">'.$a->autor.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Editora<span class="required">*</span></label>
                        <div class="controls">
                            <select name="editora_id" id="editora_id">
                                  <?php foreach ($editora as $e) {
                                      echo '<option value="'.$e->idEditora.'">'.$e->editora.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Tipo de Item<span class="required">*</span></label>
                        <div class="controls">
                            <select name="tipoItem_id" id="tipoItem_id">
                                  <?php foreach ($tipoItem as $t) {
                                      echo '<option value="'.$t->idTipoItem.'">'.$t->nomeTipo.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Categoria<span class="required">*</span></label>
                        <div class="controls">
                            <select name="categoria_id" id="categoria_id">
                                  <?php foreach ($categoria as $c) {
                                      echo '<option value="'.$c->idCategoria.'">'.$c->nomeCategoria.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Seção</label>
                        <div class="controls">
                            <select name="secao_id" id="secao_id">
                                  <?php foreach ($secao as $s) {
                                      echo '<option value="'.$s->idSecao.'">'.$s->secao.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Coleção</label>
                        <div class="controls">
                            <select name="colecao_id" id="colecao_id">
                                  <?php foreach ($colecao as $c) {
                                      echo '<option value="'.$c->idColecao.'">'.$c->colecao.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="dataAquisicao" class="control-label">Data de aquisição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="dataAquisicao" type="date" name="dataAquisicao" value="<?php echo set_value('dataAquisicao'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="origemAquisicao" class="control-label">Origem aquisição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="origemAquisicao" type="text" name="origemAquisicao" value="<?php echo set_value('origemAquisicao'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="observacaoAquisicao" class="control-label">Observação Aquisição</label>
                        <div class="controls">
                            <input id="observacaoAquisicao" type="text" name="observacaoAquisicao" value=""  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="preco" class="control-label">Preço</label>
                        <div class="controls">
                            <input id="preco" type="text" name="preco" value=""  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="tabelaCutter" class="control-label">Tabela Cutter<span class="required">*</span></label>
                        <div class="controls">
                            <input id="tabelaCutter" type="text" name="tabelaCutter" value="<?php echo set_value('tabelaCutter'); ?>"  />
                        </div>
                    </div>
                    
                     <div class="control-group">
                        <label for="isbn" class="control-label">ISBN<span class="required">*</span></label>
                        <div class="controls">
                            <input id="isbn" type="text" name="isbn" value="<?php echo set_value('isbn'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="anoEdicao" class="control-label">Ano Edição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="anoEdicao" type="date" name="anoEdicao" value="<?php echo set_value('anoEdicao'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="artigo" class="control-label">Artigo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="artigo" type="text" name="artigo" value="<?php echo set_value('artigo'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="notas" class="control-label">Notas</label>
                        <div class="controls">
                            <input id="notas" type="text" name="notas" value=""  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="numero_paginas" class="control-label">Nº Páginas<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero_paginas" type="text" name="numero_paginas" value="<?php echo set_value('numero_paginas'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="formato" class="control-label">Formato<span class="required">*</span></label>
                        <div class="controls">
                            <input id="formato" type="text" name="formato" value="<?php echo set_value('formato'); ?>"  />
                        </div>
                    </div>                                        
                                    
                    <div class="control-group">
                        <label for="tombo" class="control-label">Tombo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="tombo" type="text" name="tombo" value="<?php echo set_value('tombo'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="estoque" class="control-label">Quantidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo set_value('estoque'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="idioma" class="control-label">Idioma<span class="required">*</span></label>
                        <div class="controls">
                            <input id="idioma" type="text" name="idioma" value="<?php echo set_value('idioma'); ?>"  />
                        </div>
                    </div>
                                                          
                    <div class="control-group">
                        <label for="palavra_chave" class="control-label">Palavra Chave</label>
                        <div class="controls">
                            <input id="palavra_chave" type="text" name="palavra_chave" value=""  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <div class="controls">
                            <textarea name="descricao" rows="8" cols="40" placeholder="Digite uma breve descrição ou resumo do livro" style="width: 30%">
								
							</textarea>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="logo" class="control-label">Imagem do Livro</label>
                        <div class="controls">
                            <input type="file" name="userfile" value="" />
                        </div>
                    </div>	
                                  
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
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
                  estoque: { required: true},
                  idioma: { required: true},
                  dataAquisicao: { required: true},
                  origemAquisicao: { required: true},
                  tabelaCutter: { required: true},
                  isbn: { required: true},
                  anoEdicao: { required: true},
                  artigo: { required: true},
                  numero_paginas: { required: true},
                  formato: { required: true}
                  
            },
            messages:{
                  titulo: { required: 'Campo Requerido.'},
                  tombo: {required: 'Campo Requerido.'},
                  estoque: { required: 'Campo Requerido.'},
                  idioma: { required: 'Campo Requerido.'},
                  dataAquisicao: { required: 'Campo Requerido.'},
                  origemAquisicao: { required: 'Campo Requerido.'},
                  preco: { required: 'Campo Requerido.'},
                  tabelaCutter: { required: 'Campo Requerido.'},
                  isbn: { required: 'Campo Requerido.'},
                  anoEdicao: { required: 'Campo Requerido.'},
                  artigo: { required: 'Campo Requerido.'},
                  numero_paginas:{ required: 'Campo Requerido.'},
                  formato: { required: 'Campo Requerido.'}
                  
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



