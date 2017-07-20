<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>

<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

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
                <form action="<?php echo current_url() ?>" id="formAcervo" method="post" enctype="multipart/form-data" class="form-horizontal" >
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
                            	<option disabled selected>Selecione</option>
                            	   <?php foreach($autor as $a){
                            	   		echo '<option value="'.$a->idAutor.'">'.$a->autor.'</option>';
                            	   } ?>                 	                               
                            </select>
                            <button type="button" id="btnRefreshAutor" class="btn btn-primary"><i class="icon-refresh icon-white"></i></button>
                            <button type="button" id="btnExpAutor" class="btn btn-success" onclick="document.getElementById('cadAutor').style.display='inline';document.getElementById('minusAutor').style.display='inline'"><i class="icon-plus icon-white"></i></button>
                            <button type="button" class="btn btn-danger" id="minusAutor" onclick="document.getElementById('cadAutor').style.display='none';document.getElementById('minusAutor').style.display='none'" style="display:none"><i class="icon-minus icon-white"></i></button><br>
                            
                            
                            <div class="control-group" style="display: none" id="cadAutor">
                            	<label class="control-label" for="autor">Autor<span class="required">*</span></label>
                            	<div class="controls">
                            		<input type="text" id="autor" name="autor" value="" /><button type="button" id="btnAddAutor" class="btn btn-success" style="margin-left: 0.5%"><i class="icon-plus icon-white"></i></button>
                            	</div>                          	
                            </div>
 
                        </div>
                        
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Editora<span class="required">*</span></label>
                        <div class="controls">
                            <select name="editora_id" id="editora_id">
                            	<option disabled selected>Selecione</option>                           
                                  <?php foreach ($editora as $e) {
                                      echo '<option value="'.$e->idEditora.'">'.$e->editora.'</option>';
                                  } ?>
                            </select>
                            <button type="button" id="btnRefreshEditora" class="btn btn-primary"><i class="icon-refresh icon-white"></i></button>
                            <button type="button" id="btnExpEditora" class="btn btn-success" onclick="document.getElementById('cadEditora').style.display='inline';document.getElementById('minusEditora').style.display='inline'"><i class="icon-plus icon-white"></i></button>
                            <button type="button"  class="btn btn-danger" id="minusEditora" onclick="document.getElementById('cadEditora').style.display='none';document.getElementById('minusEditora').style.display='none'" style="display:none"><i class="icon-minus icon-white"></i></button><br>
                            
                            
                            <div class="control-group" style="display: none" id="cadEditora">
                            	<label class="control-label" for="editora">Editora<span class="required">*</span></label>
                            	<div class="controls">
                            		<input type="text" id="editora" name="editora" value="" /><button type="button" id="btnAddEditora" class="btn btn-success" style="margin-left: 0.5%"><i class="icon-plus icon-white"></i></button>
                            	</div>                          	
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Tipo de Item<span class="required">*</span></label>
                        <div class="controls">
                            <select name="tipoItem_id" id="tipoItem_id">
                            	<option disabled selected>Selecione</option> 
                                  <?php foreach ($tipoItem as $t) {
                                      echo '<option value="'.$t->idTipoItem.'">'.$t->nomeTipo.'</option>';
                                  } ?>
                            </select>
                            <button type="button" id="btnRefreshTipo" class="btn btn-primary"><i class="icon-refresh icon-white"></i></button>
                            <button type="button" id="btnExpTipo" class="btn btn-success" onclick="document.getElementById('cadTipo').style.display='inline';document.getElementById('minusTipo').style.display='inline'"><i class="icon-plus icon-white"></i></button>
                            <button type="button"  class="btn btn-danger" id="minusTipo" onclick="document.getElementById('cadTipo').style.display='none';document.getElementById('minusTipo').style.display='none'" style="display:none"><i class="icon-minus icon-white"></i></button><br>
                            
                            
                            <div class="control-group" style="display: none" id="cadTipo">
                            	<label class="control-label" for="tipo">Tipo<span class="required">*</span></label>
                            	<div class="controls">
                            		<input type="text" id="tipo" name="tipo" value="" /><button type="button" id="btnAddTipo" class="btn btn-success" style="margin-left: 0.5%"><i class="icon-plus icon-white"></i></button>
                            	</div>                          	
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Categoria<span class="required">*</span></label>
                        <div class="controls">
                            <select name="categoria_id" id="categoria_id">
                            	<option disabled selected>Selecione</option> 
                                  <?php foreach ($categoria as $c) {
                                      echo '<option value="'.$c->idCategoria.'">'.$c->nomeCategoria.'</option>';
                                  } ?>
                            </select>
                            <button type="button" id="btnRefreshCategoria" class="btn btn-primary"><i class="icon-refresh icon-white"></i></button>
                            <button type="button" id="btnExpCategoria" class="btn btn-success" onclick="document.getElementById('cadCategoria').style.display='inline';document.getElementById('minusCategoria').style.display='inline'"><i class="icon-plus icon-white"></i></button>
                            <button type="button"  class="btn btn-danger" id="minusCategoria" onclick="document.getElementById('cadCategoria').style.display='none';document.getElementById('minusCategoria').style.display='none'" style="display:none"><i class="icon-minus icon-white"></i></button><br>
                            
                            
                            <div class="control-group" style="display: none" id="cadCategoria">
                            	<label class="control-label" for="categoria">Categoria<span class="required">*</span></label>
                            	<div class="controls">
                            		<input type="text" id="categoria" name="categoria" value="" /><button type="button" id="btnAddCategoria" class="btn btn-success" style="margin-left: 0.5%"><i class="icon-plus icon-white"></i></button>
                            	</div>                          	
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Seção</label>
                        <div class="controls">                        	
                            <select name="secao_id" id="secao_id">
                            	<option value="">Selecione</option>
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
                            	<option value="">Selecione</option>
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
                        <label for="preco" class="control-label">Preço R$</label>
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
                        <label for="edicao" class="control-label">Edição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="edicao" type="text" name="edicao" value="<?php echo set_value('edicao'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="anoEdicao" class="control-label">Ano Edição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="anoEdicao" type="text" name="anoEdicao" value="<?php echo set_value('anoEdicao'); ?>"  />
                        </div>
                    </div>                                        
                                                            
                    <div class="control-group">
                        <label for="numero_paginas" class="control-label">Nº Páginas<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero_paginas" type="text" name="numero_paginas" value="<?php echo set_value('numero_paginas'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="tombo" class="control-label">Classificação<span class="required">*</span></label>
                        <div class="controls">
                            <input id="classificacao" type="text" name="classificacao" value="<?php echo set_value('classificaco'); ?>"  />
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
                            <textarea name="descricao" id="descricao" rows="8" cols="40" placeholder="Digite uma breve descrição ou resumo do livro" style="width: 30%">								
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
                                <button type="submit" class="btn btn-success"><i class="icon-arrow-right icon-white"></i> Continuar</button>
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
	//cadastra autor
	$(document).on('click', '#btnAddAutor', function(event){
		var autor = $("#autor").val();
			if(autor != ""){
				$.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/acervos/addAutor",
                  data: "autor="+autor,
                  success: function(data)
                  {
                  	alert('Autor cadastrado!');
                  }
                  });
			}else{
				alert('Campo autor vazio!');
			}								 		
	});
	
	//cadastra editora
	$(document).on('click', '#btnAddEditora', function(event){
		var editora = $("#editora").val();
			if(editora != ""){
				$.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/acervos/addEditora",
                  data: "editora="+editora,
                  success: function(data)
                  {
                  	alert('Editora cadastrada!');
                  }
                  });
			}else{
				alert('Campo editora vazio!');
			}								 		
	});	
	
	//cadastra tipo
	$(document).on('click', '#btnAddTipo', function(event){
		var tipo = $("#tipo").val();
			if(tipo != ""){
				$.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/acervos/addTipo",
                  data: "tipo="+tipo,
                  success: function(data)
                  {
                  	alert('Tipo de item cadastrado!');
                  }
                  });
			}else{
				alert('Tipo de item vazio!');
			}								 		
	});	
	
	//cadastra categoria
	$(document).on('click', '#btnAddCategoria', function(event){
		var categoria = $("#categoria").val();
			if(categoria != ""){
				$.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/acervos/addCategoria",
                  data: "categoria="+categoria,
                  success: function(data)
                  {
                  	alert('Categoria cadastrada!');
                  }
                  });
			}else{
				alert('Campo cateogoria vazio!');
			}								 		
	});	
	
	//botao de refresh autor
	$(document).on('click', '#btnRefreshAutor', function(event){	
		$.ajax({
			url: "<?php echo base_url();?>index.php/acervos/getAutor",
			type: "POST",
			dataType: "json",
			success: function(autores)
			{	
				var name, select, option;
				
				select = document.getElementById('autor_id');
				select.options.length = 0;
				
				var o1 = new Option("Selecione", "");
				select.options[select.options.length] = o1;
				o1.setAttribute('disabled', 'selected');						
				
				if(autores.error != true){
					
					$.each(autores, function(key, value) {
						
						var o = new Option(value['autor'], value['idAutor']);
						select.options[select.options.length] = o;
						o.setAttribute("key","value");
					
					});
				}
							
			}
			
		});
	});
	
	//botao de refresh editora
	$(document).on('click', '#btnRefreshEditora', function(event){	
		$.ajax({
			url: "<?php echo base_url();?>index.php/acervos/getEditora",
			type: "POST",
			dataType: "json",
			success: function(editoras)
			{	
				var name, select, option;
				
				select = document.getElementById('editora_id');
				select.options.length = 0;
				
				var o1 = new Option("Selecione", "");
				select.options[select.options.length] = o1;
				o1.setAttribute('disabled', 'selected');						
				
				if(editoras.error != true){
					
					$.each(editoras, function(key, value) {
						
						var o = new Option(value['editora'], value['idEditora']);
						select.options[select.options.length] = o;
						o.setAttribute("key","value");
					
					});
				}
							
			}
			
		});
	});
	
	//botao de refresh tipoItem
	$(document).on('click', '#btnRefreshTipo', function(event){	
		$.ajax({
			url: "<?php echo base_url();?>index.php/acervos/getTipo",
			type: "POST",
			dataType: "json",
			success: function(tipos)
			{	
				var name, select, option;
				
				select = document.getElementById('tipoItem_id');
				select.options.length = 0;
				
				var o1 = new Option("Selecione", "");
				select.options[select.options.length] = o1;
				o1.setAttribute('disabled', 'selected');						
				
				if(tipos.error != true){
					
					$.each(tipos, function(key, value) {

						var o = new Option(value['nomeTipo'], value['idTipoItem']);
						select.options[select.options.length] = o;
						o.setAttribute("key","value");
					
					});
				}
							
			}
			
		});
	});
	
	//botao de refresh categoria
	$(document).on('click', '#btnRefreshCategoria', function(event){	
		$.ajax({
			url: "<?php echo base_url();?>index.php/acervos/getCategoria",
			type: "POST",
			dataType: "json",
			success: function(categorias)
			{	
				var name, select, option;
				
				select = document.getElementById('categoria_id');
				select.options.length = 0;
				
				var o1 = new Option("Selecione", "");
				select.options[select.options.length] = o1;
				o1.setAttribute('disabled', 'selected');						
				
				if(categorias.error != true){
					
					$.each(categorias, function(key, value) {

						var o = new Option(value['nomeCategoria'], value['idCategoria']);
						select.options[select.options.length] = o;
						o.setAttribute("key","value");
					
					});
				}
							
			}
			
		});
	});

    $(document).ready(function(){
		var foo = document.getElementById('yourSelect');
		
        $('#formAcervo').validate({
            rules :{
                  titulo: { required: true},
                  autor_id: { required: true},
                  editora_id: { required: true},
                  estoque: { required: true},
                  idioma: { required: true},
                  dataAquisicao: { required: true},
                  origemAquisicao: { required: true},
                  tabelaCutter: { required: true},
                  isbn: { required: true},
                  anoEdicao: { required: true},
                  categoria_id: { required: true},
                  edicao: { required: true},
                  classificacao: { required: true},
                  tipoItem_id: { required: true},
                  numero_paginas: { required: true}
                  
            },
            messages:{
                  titulo: { required: 'Campo Requerido.'},
                  autor_id: { required: 'Campo Requerido.'},
                  editora_id: { required: 'Campo Requerido.'},
                  tipoItem_id: { required: 'Campo Requerido.'},
                  estoque: { required: 'Campo Requerido.'},
                  idioma: { required: 'Campo Requerido.'},
                  dataAquisicao: { required: 'Campo Requerido.'},
                  origemAquisicao: { required: 'Campo Requerido.'},                  
                  tabelaCutter: { required: 'Campo Requerido.'},
                  isbn: { required: 'Campo Requerido.'},
                  anoEdicao: { required: 'Campo Requerido.'},
                  edicao: { required: 'Campo Requerido.'},
                  classificacao: { required: 'Campo Requerido.'},
                  categoria_id: { required: 'Campo Requerido.'},
                  numero_paginas:{ required: 'Campo Requerido.'}
                  
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