<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.donutRenderer.min.js"></script>

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){ ?>
            <li class="bg_lb"> <a href="<?php echo base_url()?>index.php/leitores"> <i class="icon-group"></i> Leitores</a> </li>
        <?php } ?>
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){ ?>
            <li class="bg_lg"> <a href="<?php echo base_url()?>index.php/acervos"> <i class="icon-book"></i> Acervos</a> </li>
        <?php } ?>
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){ ?>
            <li class="bg_ly"> <a href="<?php echo base_url()?>index.php/reservas"> <i class="icon-calendar"></i> Reservas</a> </li>
        <?php } ?>
        
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){ ?>
            <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/emprestimos"><i class="icon-list"></i> Emprestimos</a></li>
        <?php } ?>

        
        
        
        
        

      </ul>
    </div>
  </div>  
<!--End-Action boxes-->  

<!-- Empréstimos -->
    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-list"></i></span><h5>Empréstimos Em Aberto</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data Empréstimo</th>
                            <th>Data Vencimento</th>
                            <th>Leitor</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($emprestimos != null){
                            foreach ($emprestimos as $e) {
                            	$dataEmprestimo = date(('d/m/Y'),strtotime($e->dataEmprestimo));
								$dataVencimento = date(('d/m/Y'),strtotime($e->dataVencimento));
								
                                echo '<tr>';
                                echo '<td>'.$e->idEmprestimos.'</td>';
                                echo '<td>'.$dataEmprestimo.'</td>';
                                echo '<td>'.$dataVencimento.'</td>';
                                echo '<td><a href="'.base_url().'index.php/leitores/visualizar/'.$e->leitor_id.'">'.$e->nome.'</a></td>';																						
								echo '<td>'.$e->status.'</td>';								
                                echo '<td>';
                                if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){
                                    echo '<a href="'.base_url().'index.php/emprestimos/visualizar/'.$e->idEmprestimos.'" class="btn"> <i class="icon-eye-open" ></i> </a> '; 
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="3">Nenhum empréstimo em aberto.</td></tr>';
                        }    

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Reservas em aberto -->

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-calendar"></i></span><h5>Reservas Em Aberto</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Reserva</th>
                            <th>Data Reserva</th>
                            <th>Data Prazo</th>
                            <th>Leitor</th>
                            <th>Status</th>
                            <th>Aprovar/Recusar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($reservas != null){
                            foreach ($reservas as $r) {
                            	$dataReserva = date(('d/m/Y'),strtotime($r->dataReserva));
								$dataPrazo = date(('d/m/Y'),strtotime($r->dataPrazo));
								
                                echo '<tr>';
                                echo '<td style="text-align:center"><a href="'.base_url().'index.php/reservas/editar/'.$r->idReserva.'">Ver Reserva</a></td>';
                                echo '<td style="text-align:center">'.$dataReserva.'</td>';
                                echo '<td style="text-align:center">'.$dataPrazo.'</td>';
                                echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$r->usuario_id.'">'.$r->nome.'</a></td>';																						
								echo '<td style="text-align:center">'.$r->status.'</td>';								
                                echo '<td style="text-align:center">';
                                if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){
									echo '<a href="#modal-aprovar" role="button" data-toggle="modal" data-target="#modal-aprovar" leitor_id="'.$r->usuario_id.'" idReserva="'.$r->idReserva.'" class="btn btn-success tip-top" title="Aprovar Reserva"><i class="icon-ok icon-white"></i></a>';						
								}
								if($this->permission->checkPermission($this->session->userdata('permissao'),'dReserva')){
								  	echo '<a href="'.base_url().'index.php/reservas/recusar/'.$r->idReserva.'" role="button" class="btn btn-danger tip-top"><i class="icon-remove icon-white"></i></a>  '; 
							    }    
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="3">Nenhuma reserva em aberto.</td></tr>';
                        }    

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
    
	    $(document).on('click', 'a', function(event) {
	        
	        var reserva = $(this).attr('idReserva');
	        $('#idReserva').val(reserva);
	        
	        var leitor = $(this).attr('leitor_id');
	        $('#leitor_id').val(leitor);
	
	    });

    });
 
</script>

<?php if($emp != null){ ?>
<div class="row-fluid" style="margin-top: 0">

    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas de emprestimo</h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                      <div id="chart-os" style=""></div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>



<div class="row-fluid" style="margin-top: 0">

    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas do Sistema</h5></div>
            <div class="widget-content">
                <div class="row-fluid">           
                    <div class="span12">
                        <ul class="site-stats">
                            <li class="bg_lh"><i class="icon-group"></i> <strong><?php $this->db->from('usuarios'); $this->db->where('tipo_usuario',1); echo count($this->db->get()->result());?></strong> <small>Leitores</small></li>
                            <li class="bg_lh"><i class="icon-book"></i> <strong><?php echo $this->db->count_all('acervos');?></strong> <small>Acervos </small></li>
                            <li class="bg_lh"><i class="icon-book"></i> <strong><?php echo $this->db->count_all('emprestimos');?></strong> <small>Emprestimos</small></li>
                            <li class="bg_lh"><i class="icon-calendar"></i> <strong><?php echo $this->db->count_all('reserva');?></strong> <small>Reservas</small></li>                            
                        </ul>
                 
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>


<?php if($emp != null) {?>
<script type="text/javascript">
    
    $(document).ready(function(){
      var data = [
        <?php foreach ($emp as $o) {
            echo "['".$o->status."', ".$o->total."],";
        } ?>
       
      ];
      var plot1 = jQuery.jqplot ('chart-os', [data], 
        { 
          seriesDefaults: {
            // Make this a pie chart.
            renderer: jQuery.jqplot.PieRenderer, 
            rendererOptions: {
              // Put data labels on the pie slices.
              // By default, labels show the percentage of the slice.
              showDataLabels: true
            }
          }, 
          legend: { show:true, location: 'e' }
        }
      );

    });
 
</script>

<?php } ?>

<!-- Modal aprovar-->
<div id="modal-aprovar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/emprestimos/emprestarReserva" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Aprovar Reserva</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="leitor_id" name="leitor_id" value="" />
    <input type="hidden" id="idReserva" name="idReserva" value="" />
    <h5 style="text-align: center">Deseja aprovar essa reserva?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success">Aprovar</button>
  </div>
  </form>
</div>



<?php   ?>