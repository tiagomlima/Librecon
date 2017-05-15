<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Empréstimo</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divAcervosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Empréstimo</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarEmprestimo">
                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formEmprestimo">
                                    <?php echo form_hidden('idVendas',$result->idVendas) ?>
                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Emprestimo: <?php echo $result->idVendas ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataDevolucao">Data de Devolução</label>
                                            <input id="dataDevolucao" class="span12 datepicker" type="text" name="dataDevolucao" value="<?php echo date('d/m/Y', strtotime($result->dataDevolucao)); ?>"  />
                                        </div>
                                        <div class="span0" style="margin-left: 0">
                                           
                                            <input id="dataEmprestimo" class="span12 datepicker" type="hidden" name="dataEmprestimo" value="<?php echo date('d/m/Y', strtotime($result->dataEmprestimo)); ?>"  />
                                        </div>
                                        <div class="span5" style="margin-left: 0">
                                            <label for="leitor">Leitor<span class="required">*</span></label>
                                            <input id="leitor" class="span12" type="text" name="leitor" value="<?php echo $result->nomeLeitor ?>"  />
                                            <input id="leitores_id" class="span12" type="hidden" name="leitores_id" value="<?php echo $result->leitores_id ?>"  />
                                            
                                           <!-- <input id="valorTotal" type="hidden" name="valorTotal" value=""  />-->
                                        </div>
                                        <div class="span5">
                                            <label for="usuario">Usuário<span class="required">*</span></label>
                                            <input id="usuario" class="span12" type="text" name="usuario" value="<?php echo $result->nome ?>"  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                        
                                    </div>
                                    
                                    
                                   
                                   
                                    <div class="span12" style="padding: 1%; margin-left: 0">
            
                                        <div class="span8 offset2" style="text-align: center">
                                           <!-- <?php if($result->faturado == 0){ ?>
                                            <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="icon-file"></i> Faturar</a>
                                            <?php } ?>-->
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/vendas/visualizar/<?php echo $result->idVendas; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar Venda</a>
                                            <a href="<?php echo base_url() ?>index.php/vendas" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>

                                    </div>

                                </form>
                                
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                        
                                        <form id="formAcervos" action="<?php echo base_url(); ?>index.php/vendas/adicionarAcervo" method="post">
                                            <div class="span6">
                                                <input type="hidden" name="idAcervo" id="idAcervo" value=""/>
                                                <input type="hidden" name="idVendasAcervo" id="idVendasAcervo" value="<?php echo $result->idVendas?>" />
                                                
                                               <!-- <input type="hidden" name="estoque" id="estoque" value=""/>-->
                                                <!--<input type="hidden" name="preco" id="preco" value=""/>-->
                                                <label for="">Acervo</label>
                                                <input type="text" class="span12" name="acervos" id="acervos" placeholder="Digite o nome do acervo" value=""/>
                                                <input type="hidden" class="span12" name="acervos_id" id="acervos_id" value=""/>
                                            </div>
                                            <div class="span0">
                                              <!--  <label for="">Quantidade</label>-->
                                                <input type="hidden" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" value="" />
                                            </div>
                                            <div class="span2">
                                                <label for="">&nbsp</label>
                                                <button class="btn btn-success span12" id="btnAdicionarAcervo"><i class="icon-white icon-plus"></i> Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="span12" id="divAcervos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblAcervos">
                                            <thead>
                                                <tr>                                              
                                                   <th>Acervo</th>
                                                   <th>Tombo</th>
                                                   <th>Ações</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($acervos as $p) {
                                                	                                                                                                   
                                                    echo '<tr>';
                                                    echo '<td>'.$p->titulo.'</td>';
                                                    echo '<td>'.$p->tombo.'</td>';
                                                    echo '<td><a href="" idAcao="'.$p->idItens.'" prodAcao="'.$p->idAcervos.'" quantAcao="'.$p->quantidade.'" title="Excluir Acervo" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';                                                   
                                                    echo '</tr>';
                                                }?>
                                               
                                               <!-- <tr>
                                                    <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                                    <td><strong>R$ <?php echo number_format($total,2,',','.');?></strong> <input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></td>
                                                </tr> -->
                                                
                                            </tbody>
                                        </table>


                                        


                                    </div>

                            </div>

                        </div>

                    </div>

                </div>


.

        </div>

    </div>
</div>
</div>


<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="formFaturar" action="<?php echo current_url() ?>" method="post">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Faturar Venda</h3>
</div>
<div class="modal-body">
    
    <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    <div class="span12" style="margin-left: 0"> 
      <label for="descricao">Descrição</label>
      <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $result->idVendas; ?> "  />
      
    </div>  
    <div class="span12" style="margin-left: 0"> 
      <div class="span12" style="margin-left: 0"> 
        <label for="cliente">Leitor*</label>
        <input class="span12" id="leitor" type="text" name="leitor" value="<?php echo $result->nomeLeitor ?>" />
        <input type="hidden" name="leitores_id" id="leitores_id" value="<?php echo $result->leitores_id ?>">
        <input type="hidden" name="vendas_id" id="vendas_id" value="<?php echo $result->idVendas; ?>">
      </div>
      
      
    </div>
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">  
        <label for="valor">Valor*</label>
        <input type="hidden" id="tipo" name="tipo" value="receita" /> 
        <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total,2); ?> "  />
      </div>
      <div class="span4" >
        <label for="vencimento">Data Vencimento*</label>
        <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
      </div>
      
    </div>
    
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">
        <label for="recebido">Recebido?</label>
        &nbsp &nbsp &nbsp &nbsp<input  id="recebido" type="checkbox" name="recebido" value="1" /> 
      </div>
      <div id="divRecebimento" class="span8" style=" display: none">
        <div class="span6">
          <label for="recebimento">Data Recebimento</label>
          <input class="span12 datepicker" id="recebimento" type="text" name="recebimento" /> 
        </div>
        <div class="span6">
          <label for="formaPgto">Forma Pgto</label>
          <select name="formaPgto" id="formaPgto" class="span12">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Cheque">Cheque</option>
            <option value="Boleto">Boleto</option>
            <option value="Depósito">Depósito</option>
            <option value="Débito">Débito</option>        
          </select>
        </div>
      </div>
      
    </div>
    
    
</div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
  <button class="btn btn-primary">Faturar</button>
</div>
</form>
</div>

<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/vendas/excluirAcervo" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Item</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="acervos_id" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este item da lista?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>
 

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
$(document).ready(function(){
     $(".money").maskMoney(); 
     $('#recebido').click(function(event) {
        var flag = $(this).is(':checked');
        if(flag == true){
          $('#divRecebimento').show();
        }
        else{
          $('#divRecebimento').hide();
        }
     });
     $(document).on('click', '#btn-faturar', function(event) {
       event.preventDefault();
         valor = $('#total-venda').val();
         valor = valor.replace(',', '' );
         $('#valor').val(valor);
     });
     
     $("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/vendas/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar venda.');
                    $('#progress-fatura').hide();
                }
              }
              });
              return false;
          }
     });
     $("#acervos").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteAcervo",
            minLength: 2,
            select: function( event, ui ) {
                 $("#acervos_id").val(ui.item.id);
                
                 
                 
            }
      });
      $("#leitor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteLeitor",
            minLength: 2,
            select: function( event, ui ) {
                 $("#leitores_id").val(ui.item.id);
            }
      });
      $("#usuario").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      });
      $("#formEmprestimo").validate({
          rules:{
             leitor: {required:true},
             usuario: {required:true},
             dataEmprestimo: {required:true},
             dataDevolucao: {required:true}
          },
          messages:{
             leitor: {required: 'Campo Requerido.'},
             usuario: {required: 'Campo Requerido.'},
             dataEmprestimo: {required: 'Campo Requerido.'},
             dataDevolucao: {required: 'Campo Requerido.'}
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
 
     
       $(document).on('click', 'a', function(event) {
            var idAcervo = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var acervo = $(this).attr('prodAcao');
            if((idAcervo % 1) == 0){
                $("#divAcervos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/vendas/excluirAcervo",
                  data: "idAcervo="+idAcervo+"&quantidade="+quantidade+"&acervo="+acervo,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divAcervos" ).load("<?php echo current_url();?> #divAcervos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir acervo.');
                    }
                  }
                  });
                  return false;
            }
            
       });
   
       $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>
