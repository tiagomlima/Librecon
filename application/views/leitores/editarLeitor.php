<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>

<script src="<?php echo base_url()?>js/jquery.mask.min.js"></script>
<script type="text/javascript">
	jQuery(function($){
      		$("#telefone").mask("(99)9999-9999");
      		$("#celular").mask("(99)99999-9999");
      		$("#cep").mask("99999-999");
      		$("#cpf").mask("999.999.999-99");
      	});
</script>

<script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Leitor</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                } ?>
                <form action="<?php echo base_url() ?>index.php/leitores/editar" id="formLeitor" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <?php echo form_hidden('idUsuarios',$result->idUsuarios) ?>
                        <label for="nomeLeitor" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="nomeLeitor" type="text" name="nomeLeitor" value="<?php echo $result->nome; ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="cpf" class="control-label">CPF<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cpf" type="text" name="cpf" value="<?php echo $result->cpf; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="datanasc" class="control-label">Data de Nascimento</label>
                        <div class="controls">
                            <input id="datanasc" type="date" name="datanasc" value="<?php echo $result->datanasc; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label  class="control-label">Sexo<span class="required">*</span></label>
                        <div class="controls">
                            <select name="sexo" id="sexo">
                            <?php
                            	if($result->sexo == 'Masculino'){
                            		$op1 = 'Masculino';
									$op2 = 'Feminino';
                            	}
								if($result->sexo == 'Feminino'){
                            		$op1 = 'Feminino';
									$op2 = 'Masculino';
                            	}
                            	
                             ?>
                                <option value="<?php echo $op1 ?>"><?php echo $op1 ?></option>
                                <option value="<?php echo $op2 ?>"><?php echo $op2 ?></option>
                            </select>
                        </div>
                    </div>
                    
   					<div class="control-group">
                        <label for="matricula" class="control-label">Matricula R.A</label>
                        <div class="controls">
                            <input id="matricula" type="text" name="matricula" value="<?php echo $result->matricula; ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="senha" class="control-label">Senha</label>
                        <div class="controls">
                            <input id="senha" type="password" name="senha" value=""  placeholder="Não preencha se não quiser alterar."  />
                            <i class="icon-exclamation-sign tip-top" title="Se não quiser alterar a senha, não preencha esse campo."></i>
                        </div>
                    </div>
   					
                    <div class="control-group">
                        <label for="telefone" class="control-label">Telefone<span class="required">*</span></label>
                        <div class="controls">
                            <input id="telefone" type="text" name="telefone" value="<?php echo $result->telefone; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="celular" class="control-label">Celular</label>
                        <div class="controls">
                            <input id="celular" type="text" name="celular" value="<?php echo $result->celular; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email" class="control-label">Email<span class="required">*</span></label>
                        <div class="controls">
                            <input id="email" type="text" name="email" value="<?php echo $result->email; ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="rua" class="control-label">Rua<span class="required">*</span></label>
                        <div class="controls">
                            <input id="rua" type="text" name="rua" value="<?php echo $result->rua; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="numero" class="control-label">Número<span class="required">*</span></label>
                        <div class="controls">
                            <input id="numero" type="text" name="numero" value="<?php echo $result->numero; ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="bairro" type="text" name="bairro" value="<?php echo $result->bairro; ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cidade" type="text" name="cidade" value="<?php echo $result->cidade; ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <input id="estado" type="text" name="estado" value="<?php echo $result->estado; ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                        <div class="controls">
                            <input id="cep" type="text" name="cep" value="<?php echo $result->cep; ?>"  />
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
                    
                    <div class="control-group">
                        <label  class="control-label">Grupo<span class="required">*</span></label>
                        <div class="controls">
                            <select name="grupo_id" id="grupo_id">
                                  <?php foreach ($grupos as $g) {
                                     if($g->idGrupo == $result->grupo_id){ $selected = 'selected';}else{$selected = '';}
                                      echo '<option value="'.$g->idGrupo.'"'.$selected.'>'.$g->nomeGrupo.'</option>';
                                  } ?>
                            </select>
                        </div>
                    </div>

					<div class="control-group">
                        <label  class="control-label">Situação*</label>
                        <div class="controls">
                            <select name="situacao" id="situacao">
                                <?php if($result->situacao == 1){$ativo = 'selected'; $inativo = '';} else{$ativo = ''; $inativo = 'selected';} ?>
                                <option value="1" <?php echo $ativo; ?>>Ativo</option>
                                <option value="0" <?php echo $inativo; ?>>Inativo</option>
                            </select>
                        </div>
                    </div>			
					
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="#modalImg" data-toggle="modal" role="button" class="btn btn-inverse">Alterar Imagem</a>
                                <a href="<?php echo base_url() ?>index.php/leitores" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalImg" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url(); ?>index.php/leitores/editarImg" id="formImg" enctype="multipart/form-data" method="post" class="form-horizontal" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="">Librecon - Alterar a foto do leitor</h3>
  </div>
  <div class="modal-body">
         <div class="span12 alert alert-info">Selecione uma nova imagem do leitor. Tamanho indicado (130 X 130).</div>          
         <div class="control-group">
            <label for="logo" class="control-label"><span class="required">Imagem*</span></label>
            <div class="controls">
                <input type="file" name="userfile" value="" />
                <input id="idUsuarios" type="hidden" name="idUsuarios" value="<?php echo $result->idUsuarios; ?>"  />
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
<script type="text/javascript">
      $(document).ready(function(){
           $('#formLeitor').validate({
            rules :{
                  nomeLeitor:{ required: true},
                  cpf:{ required: true},
                  telefone:{ required: true},
                  email:{ required: true},
                  rua:{ required: true},
                  numero:{ required: true},
                  bairro:{ required: true},
                  cidade:{ required: true},
                  estado:{ required: true},
                  cep:{ required: true},
                  sexo:{ required: true},
                  situacao:{ required: true},
                  matricula:{ required: true}
            },
            messages:{
            
                  nomeLeitor :{ required: 'Campo Requerido.'},
                  cpf :{ required: 'Campo Requerido.'},
                  telefone:{ required: 'Campo Requerido.'},
                  email:{ required: 'Campo Requerido.'},
                  rua:{ required: 'Campo Requerido.'},
                  numero:{ required: 'Campo Requerido.'},
                  bairro:{ required: 'Campo Requerido.'},
                  cidade:{ required: 'Campo Requerido.'},
                  estado:{ required: 'Campo Requerido.'},
                  cep:{ required: 'Campo Requerido.'},
                  sexo:{ required: 'Campo Requerido.'},
                  situacao:{ required: 'Campo Requerido.'},
                  matricula:{ required: 'Campo Requerido.'}

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

