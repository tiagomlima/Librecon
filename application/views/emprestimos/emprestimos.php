<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aEmprestimo')){ ?>
    <a href="<?php echo base_url();?>index.php/emprestimos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Empréstimo</a>
<?php } ?>

<?php
if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Emprestimos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data do Empréstimo</th>
            <th>Data da Devolução</th>
            <th>Leitor</th>
            <th>Situação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhum emprestimo cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else{?>


<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Empréstimos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data do Empréstimo</th>
            <th>Data de Vencimento</th>
            <th>Leitor</th>
            <th>Situação</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            $dataEmprestimo = date(('d/m/Y'),strtotime($r->dataEmprestimo));
			$dataVencimento = date(('d/m/Y'),strtotime($r->dataVencimento));
			$dataAtual = date(('d/m/Y'),strtotime(date('d/m/Y')));
						
			if($dataAtual > $dataVencimento){
				$status = 'ATRASADO';
			}else{
				$status = $r->status;
			}
                     
            echo '<tr>';
            echo '<td>'.$r->idEmprestimos.'</td>';
            echo '<td>'.$dataEmprestimo.'</td>';
			echo '<td>'.$dataVencimento.'</td>';
            echo '<td><a href="'.base_url().'index.php/leitores/visualizar/'.$r->leitor_id.'">'.$r->nome.'</a></td>';
			echo '<td>'.$status.'</td>';
            
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo') && $r->status != 'Não emprestado'){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/emprestimos/visualizar/'.$r->idEmprestimos.'" class="btn tip-top" title="Ver comprovante"><i class="icon-eye-open"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/emprestimos/editar/'.$r->idEmprestimos.'" class="btn btn-info tip-top" title="Editar emprestimo"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dEmprestimo')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" status="'.$r->status.'" emprestimo="'.$r->idEmprestimos.'" class="btn btn-danger tip-top" title="Excluir Emprestimo"><i class="icon-remove icon-white"></i></a>'; 
            }
            echo '</td>';
            echo '</tr>';
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
  <form action="<?php echo base_url() ?>index.php/emprestimos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Empréstimo</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idEmprestimo" name="id" value="" />
    <input type="hidden" id="status" name="status" value=""/>
    <h5 style="text-align: center">Deseja realmente excluir este empréstimo?</h5>
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
        
        var emprestimo = $(this).attr('emprestimo');
        $('#idEmprestimo').val(emprestimo);
        var status = $(this).attr('status');
        $('#status').val(status);
    });
});
</script>
