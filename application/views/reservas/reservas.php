<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aReserva') && $this->session->userdata('tipo_usuario') == 1){ ?>
    <a href="<?php echo base_url()?>index.php/acervos/gerenciar" class="btn btn-success"><i class="icon-plus icon-white"></i> Fazer uma reserva</a>
<?php } ?>

<?php

if(!$results){?>

    <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-wrench"></i>
         </span>
        <h5>Serviços</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Leitor</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Data Reserva</th>
            <th>Data Validade/th>
            <th>Status</th>
            <th></th>
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
            <i class="icon-wrench"></i>
         </span>
        <h5>Reservas</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Leitor</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Editora</th>
            <th>Data Reserva</th>
            <th>Data Validade</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
        		foreach ($leitor as $l){
        			foreach ($acervo as $a){
            echo '<tr>';
            echo '<td>'.$r->idReserva.'</td>';
			echo '<td>'.$l->leitor.'</td>';
            echo '<td>'.$a->acervo.'</td>';
			echo '<td>'.$r->Autor.'</td>';
            echo '<td>'.$r->Editora.'</td>';
			echo '<td>'.$r->dataReserva.'</td>';
			echo '<td>'.$r->dataPrazo.'</td>';
			echo '<td>'.$r->status.'</td>';
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/servicos/editar/'.$r->idReserva.'" class="btn btn-info tip-top" title="Editar Serviço"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dReserva')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" servico="'.$r->idReserva.'" class="btn btn-danger tip-top" title="Excluir Serviço"><i class="icon-remove icon-white"></i></a>  '; 
            }    
                      
                      
            echo '</td>';
            echo '</tr>';
            }
          }
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
        



<?php echo $this->pagination->create_links();}?>


<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/servicos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Serviço</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idServico" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este serviço?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var servico = $(this).attr('servico');
        $('#idServico').val(servico);

    });

});

</script>