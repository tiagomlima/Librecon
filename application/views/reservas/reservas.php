<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aReserva') && $this->session->userdata('tipo_usuario') == 1){ ?>
    <a href="<?php echo base_url()?>index.php/acervos/gerenciar" class="btn btn-success"><i class="icon-plus icon-white"></i> Fazer uma reserva</a>
<?php } ?>

<?php

if(!$results){?>

    <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-book"></i>
         </span>
         <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
        <h5>Reservas</h5>
		<?php }else { ?>
		<h5>Minhas reservas</h5>
		<?php } ?>
     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Reserva</th>
            <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
            <th>Leitor</th>
            <?php } ?>           
            <th>Data Reserva</th>
            <th>Data Prazo</th>
            <th>Status</th>
            <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
            <th>Aprovar/Recusar</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhuma reserva realizada</td>
        </tr>
    </tbody>
</table>
</div>
</div>



<?php }
else{ ?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-book"></i>
         </span>
        <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
        <h5>Reservas</h5>
		<?php }else { ?>
		<h5>Minhas reservas</h5>
		<?php } ?>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Reserva</th>
            <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
            <th>Leitor</th>
            <?php } ?>                   
            <th>Data Reserva</th>
            <th>Data Prazo</th>
            <th>Status</th>
            <?php if($this->session->userdata('tipo_usuario') != 1){ ?>
            <th>Aprovar/Recusar</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    	<?php
    	if($this->session->userdata('tipo_usuario') == 0){
    		foreach ($results as $r){
	    		echo '<tr>';
				echo '<td style="text-align:center"><a href="'.base_url().'index.php/reservas/editar/'.$r->idReserva.'">Ver Reserva</a></td>';
				
				$this->db->where('idUsuarios',$r->usuario_id);
				$leitor = $this->db->get('usuarios')->result();
				
				foreach($leitor as $l){
					echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$l->idUsuarios.'">'.$l->nome.'</a></td>';											
					echo '<td style="text-align:center">'.date('d/m/Y', strtotime($r->dataReserva)).'</td>';
					echo '<td style="text-align:center">'.date('d/m/Y', strtotime($r->dataPrazo)).'</td>';
					echo '<td style="text-align:center">'.$r->status.'</td>';								
					echo '<td style="text-align:center">';
					
					if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){
						echo '<a role="button" data-toggle="modal" data-target="#modal-aprovar" leitor_id="'.$l->idUsuarios.'" idReserva="'.$r->idReserva.'" class="btn btn-success tip-top" title="Aprovar Reserva"><i class="icon-ok icon-white"></i></a>';						
					}
					if($this->permission->checkPermission($this->session->userdata('permissao'),'dReserva')){
					  	echo '<a href="'.base_url().'index.php/reservas/recusar/'.$r->idReserva.'" role="button" class="btn btn-danger tip-top"><i class="icon-remove icon-white"></i></a>  '; 
				    }    
					
					echo '</td>';		
					echo '</tr>';	
				}		
    		}
    	} else {
    		$this->db->where('usuario_id',$this->session->userdata('id'));
			$reserva = $this->db->get('reserva')->result();
    		foreach ($reserva as $r){
	    		echo '<tr>';
				echo '<td style="text-align:center"><a href="'.base_url().'index.php/reservas/editar/'.$r->idReserva.'">Ver Reserva</a></td>';
				
				$this->db->where('idUsuarios',$r->usuario_id);
				$leitor = $this->db->get('usuarios')->result();
				
				foreach($leitor as $l){											
					echo '<td style="text-align:center">'.date('d/m/Y', strtotime($r->dataReserva)).'</td>';
					echo '<td style="text-align:center">'.date('d/m/Y', strtotime($r->dataPrazo)).'</td>';
					echo '<td style="text-align:center">'.$r->status.'</td>';								
					
					echo '</tr>';	
				}		
    		}
    	}
    		        	
	        ?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
        



<?php echo $this->pagination->create_links();}?>


<!-- Modal recusar
<div id="modal-recusar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/reservas/recusar" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Recusar Reserva</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="reserva" name="idReserva" value="" />
    <h5 style="text-align: center">Deseja realmente recusar o pedido de reserva?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Recusar</button>
  </div>
  </form>
</div>-->

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