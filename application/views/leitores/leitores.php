<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aLeitor')){ ?>
    <a href="<?php echo base_url();?>index.php/leitores/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Leitor</a>    
<?php } ?>

<?php
if(!$results){?>

        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Leitores</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Matricula</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Leitor Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{
	

?>
<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Leitores</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Matricula</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->idLeitores.'</td>';
            echo '<td>'.$r->nomeLeitor.'</td>';
            echo '<td>'.$r->email.'</td>';
            echo '<td>'.$r->telefone.'</td>';
			echo '<td>'.$r->matricula.'</td>';
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){
                echo '<a href="'.base_url().'index.php/leitores/visualizar/'.$r->idLeitores.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eLeitor')){
                echo '<a href="'.base_url().'index.php/leitores/editar/'.$r->idLeitores.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Leitor"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dLeitor')){
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" leitor="'.$r->idLeitores.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Leitor"><i class="icon-remove icon-white"></i></a>'; 
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
  <form action="<?php echo base_url() ?>index.php/leitores/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Leitor</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idLeitor" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este leitor e os dados associados a ele?</h5>
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
        
        var leitor = $(this).attr('leitor');
        $('#idLeitor').val(leitor);

    });

});

</script>
