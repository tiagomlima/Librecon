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
                        <label  class="control-label">Autor<span class="required">*</span></label>
                        <div class="controls">
                            <select name="autor_id" id="autor_id">
                                  <?php foreach ($autor as $a) {
                                     if($a->idAutor == $result->autor_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$a->idAutor.'"'.$selected.'>'.$a->autor.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Editora<span class="required">*</span></label>
                        <div class="controls">
                            <select name="editora_id" id="editora_id">
                                  <?php foreach ($editora as $e) {
                                     if($e->idEditora == $result->editora_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$e->idEditora.'"'.$selected.'>'.$e->editora.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Tipo de Item<span class="required">*</span></label>
                        <div class="controls">
                            <select name="tipoItem_id" id="tipoItem_id">
                                  <?php foreach ($tipoItem as $t) {
                                     if($t->idTipoItem == $result->tipoItem_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$t->idTipoItem.'"'.$selected.'>'.$t->nomeTipo.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Categoria<span class="required">*</span></label>
                        <div class="controls">
                            <select name="categoria_id" id="categoria_id">
                                  <?php foreach ($categoria as $c) {
                                     if($c->idCategoria == $result->categoria_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$c->idCategoria.'"'.$selected.'>'.$c->nomeCategoria.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Seção<span class="required">*</span></label>
                        <div class="controls">
                            <select name="secao_id" id="secao_id">
                                  <?php foreach ($secao as $s) {
                                     if($s->idSecao == $result->secao_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$s->idSecao.'"'.$selected.'>'.$s->secao.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
					
					<div class="control-group">
                        <label  class="control-label">Coleção<span class="required">*</span></label>
                        <div class="controls">
                            <select name="colecao_id" id="colecao_id">
                                  <?php foreach ($colecao as $c) {
                                     if($c->idColecao == $result->colecao_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$c->idColecao.'"'.$selected.'>'.$c->colecao.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="dataAquisicao" class="control-label">Data de aquisição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="dataAquisicao" type="date" name="dataAquisicao" value="<?php echo $result->dataAquisicao; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="origemAquisicao" class="control-label">Origem aquisição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="origemAquisicao" type="text" name="origemAquisicao" value="<?php echo $result->origemAquisicao; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="observacaoAquisicao" class="control-label">Observação Aquisição</label>
                        <div class="controls">
                            <input id="observacaoAquisicao" type="text" name="observacaoAquisicao" value="<?php echo $result->observacaoAquisicao ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="preco" class="control-label">Preço R$</label>
                        <div class="controls">
                        	<?php
                        		$preco = $result->preco;
								$preco = str_replace(".",",",$preco);
                        	 ?>
                            <input id="preco" type="text" name="preco" value="<?php echo $preco; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="tabelaCutter" class="control-label">Tabela Cutter<span class="required">*</span></label>
                        <div class="controls">
                            <input id="tabelaCutter" type="text" name="tabelaCutter" value="<?php echo $result->tabelaCutter; ?>"  />
                        </div>
                    </div>
                    
                     <div class="control-group">
                        <label for="isbn" class="control-label">ISBN<span class="required">*</span></label>
                        <div class="controls">
                            <input id="isbn" type="text" name="isbn" value="<?php echo $result->isbn; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="anoEdicao" class="control-label">Ano Edição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="anoEdicao" type="text" name="anoEdicao" value="<?php echo $result->anoEdicao; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="artigo" class="control-label">Artigo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="artigo" type="text" name="artigo" value="<?php echo $result->artigo; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="notas" class="control-label">Notas</label>
                        <div class="controls">
                            <input id="notas" type="text" name="notas" value="<?php echo $result->notas; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="numero_paginas" class="control-label">Nº Páginas<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero_paginas" type="text" name="numero_paginas" value="<?php echo $result->numero_paginas; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="formato" class="control-label">Formato<span class="required">*</span></label>
                        <div class="controls">
                            <input id="formato" type="text" name="formato" value="<?php echo $result->formato; ?>"  />
                        </div>
                    </div>                     
					
                    <div class="control-group">
                        <label for="tombo" class="control-label">Tombo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="tombo" type="text" name="tombo" value="<?php echo $result->tombo; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="estoque" class="control-label">Quantidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estoque" type="text" name="estoque" value="<?php echo $result->estoque; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="idioma" class="control-label">Idioma<span class="required">*</span></label>
                        <div class="controls">
                            <input id="idioma" type="text" name="idioma" value="<?php echo $result->idioma; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="idioma" class="control-label">Palavra Chave</label>
                        <div class="controls">
                            <input id="palavra_chave" type="text" name="palavra_chave" value="<?php echo $result->palavra_chave; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <div class="controls">
                            <textarea name="descricao" rows="8" cols="40" placeholder="Digite uma breve descrição ou resumo do livro" style="width: 30%">
							<?php echo $result->descricao ?>	
							</textarea>
                        </div>
                    </div>
                                     
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="#modalImg" data-toggle="modal" role="button" class="btn btn-inverse">Alterar Imagem</a>
                                <a href="<?php echo base_url() ?>index.php/acervos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form> 
                                                               
            </div>
         </div>
     </div>
</div>

<div id="modalImg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url(); ?>index.php/acervos/editarImg" id="formImg" enctype="multipart/form-data" method="post" class="form-horizontal" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="">Librecon - Alterar Imagem do Item</h3>
  </div>
  <div class="modal-body">
         <div class="span12 alert alert-info">Selecione uma nova imagem do item. Tamanho indicado (130 X 130).</div>          
         <div class="control-group">
            <label for="logo" class="control-label"><span class="required">Imagem*</span></label>
            <div class="controls">
                <input type="file" name="userfile" value="" />
                <input id="idAcervos" type="hidden" name="idAcervos" value="<?php echo $result->idAcervos; ?>"  />
            </div>
        </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
    <button class="btn btn-primary">Alterar</button>
  </div>
  </form>
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
                  tabelaCutter: { required: 'Campo Requerido.'},
                  isbn: { required: 'Campo Requerido.'},
                  anoEdicao: { required: 'Campo Requerido.'},
                  artigo: { required: 'Campo Requerido.'},
                  numero_paginas: { required: 'Campo Requerido.'},
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




