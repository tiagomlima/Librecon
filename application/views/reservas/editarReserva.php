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
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Reserva </h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divAcervosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da Reserva</a></li>
						
                    </ul>
                    <div class="tab-content">
                    		                                   	                      	     
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarReserva">                                                                                                 
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Reserva: <?php echo $result->idReserva; 
                                        
                                        
                                        ?></h3>
                                        <div class="span2" style="margin-left: 0">
                                            <label for="dataPrazo">Data de Vencimento</label>                                        
                                            <input id="dataPrazo" class="span12 datepicker" type="text" name="dataPrazo" value="<?php echo date('d/mY', strtotime($result->dataPrazo)); ?>" readonly="true" />
                                            <label  class="control-label">Status</span></label>
						                        <div class="controls">
						                            <select name="status" id="status">
						                                  <?php  {						                                     
						                                      echo '<option value="'.$result->status.'"selected>'.$result->status.'</option>';
						                                  } ?>						                                  
						                            </select>
						                        </div>
                                       		 </div>
                                       		 	
                                        <div class="span3" style="margin-left: 20">
                                           
                                             <label for="leitor">Leitor</label>
                                            <input id="leitor" class="span12" type="text" name="leitor" value="<?php echo $leitor->nome ?>"  readonly />
                                            <input id="leitor_id" class="span12" type="hidden" name="leitor_id" value="<?php echo $result->usuario_id ?>"  />
                                        </div>                                    
                                                                                                                     
                                    </div>    
                                    
                                    <?php if($this->session->userdata('tipo_usuario') == 0){?>
                                    <div class="span12 well" style="padding: 1%; margin-left: 0">
                                        
                                        <form id="formAcervos" action="<?php echo base_url(); ?>index.php/reservas/adicionarAcervo" method="post">
                                            <div class="span8" style="width: 30%">
                                                <input type="hidden" name="idAcervo" id="idAcervo" value=""/>
                                                <input type="hidden" name="idReservaAcervo" id="idReservaAcervo" value="<?php echo $result->idReserva ?>" />
                                                <?php if($result->status != 'Reservado'){ ?>
                                                <label for="">Acervo</label>
                                                <input type="text"  name="acervos" id="acervos" placeholder="Digite o nome do acervo" value=""/>
                                                <input type="hidden"  name="acervos_id" id="acervos_id" value=""/>
                                                <?php } ?>
                                                <?php 
                                                	$grupo_id = $leitor->grupo_id;
													$this->db->where('idGrupo',$grupo_id);
													$grupo = $this->db->get('grupos')->row();
													$qtde_max_reserva = $grupo->qtde_max_reserva;
                                                
                                                ?>
                                                <input type="hidden" id="qtde_max_reserva"  name="qtde_max_reserva" value="<?php echo $qtde_max_reserva ?>" />
  												<input type="hidden" id="$qtde_atual" name="qtde_atual" value="<?php echo $result->qtde_item ?>" />
                                                
                                                <label for="">&nbsp</label>
                                                <?php if($result->status != 'Reservado'){ ?>
                                                <button class="btn btn-success span2" id="btnAdicionarAcervo" style="margin-left: 70%;margin-top: -20.5%"><i class="icon-white icon-plus"></i></button>
                                                <?php } ?>
                                            </div>
                                                                                                                                                                          
                                            
                                                
                                            
                                        </form>
                                    </div>                                                                                                                                                                         
                                     <?php } ?>                         
                                    <div class="span12" id="divAcervos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblAcervos">
                                            <thead>
                                                <tr>                                              
                                                   <th>Acervo</th>                                                                                                  
                                                   <th>Remover</th>                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($acervos as $p) {
                                                	                                                                                                   
                                                    echo '<tr>';
                                                    echo '<td style="text-align: center"><a href="'.base_url().'index.php/acervos/visualizar/'.$p->idAcervos.'">'.$p->titulo.'</a></td>';													
                                                    echo '<td style="text-align: center"><a href="" idAcao="'.$p->idItem.'" prodAcao="'.$p->idAcervos.'" idEmprestimo="'.$p->reserva_id.'" title="Excluir Acervo" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';											                                                  
                                                    echo '</tr>';
                                                }?>
                                                                        
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

    
</div>
<div class="modal-footer">
  <form id="formReservar" action="<?php echo base_url(); ?>index.php/reservas/reservar" method="post">
  <input id="qtde_atual" class="span12" type="hidden" name="qtde_atual" value="<?php echo $result->qtde_item ?>"  />
  <input id="idReserva" class="span12" type="hidden" name="idReserva" value="<?php echo $result->idReserva ?>"  /> 
  <a href="<?php echo base_url() ?>index.php/reservas" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
  <?php if($result->status !='Reservado' && $result->status != 'Recusado'){ ?>
  <button class="btn btn-primary">Reservar</button>
  <?php } ?>
  
  <a href="<?php echo base_url(); ?>index.php/reservas/cancelar/<?php echo $result->usuario_id?>"><span class="btn btn-danger">Cancelar</span></a>   
  </form>
  
</div>
</form>
</div>




 

<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			
     $("#acervos").autocomplete({
            source: "<?php echo base_url(); ?>index.php/emprestimos/autoCompleteAcervo",
            minLength: 2,
            select: function( event, ui ) {
                 $("#acervos_id").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                
                 
                 
            }
      });
 
     
       $(document).on('click', 'a', function(event) {
            var idAcervo = $(this).attr('idAcao');
            var idReserva = $(this).attr('idEmprestimo');
            var acervo = $(this).attr('prodAcao');
            if((idAcervo % 1) == 0){
                $("#divAcervos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/reservas/excluirAcervo",
                  data: "idAcervo="+idAcervo+"&idReserva="+idReserva+"&acervo="+acervo,
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
