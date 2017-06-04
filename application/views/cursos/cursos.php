<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<a href="<?php echo base_url()?>index.php/cursos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Curso</a>
<?php
if(!$results){?>
        <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
        </span>
        <h5>Cursos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome do Curso</th>
            <th></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td colspan="5">Nenhum Curso Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>


<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Cursos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome do Curso</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
           
            echo '<tr>';
            echo '<td>'.$r->idCursos.'</td>';
            echo '<td>'.$r->nomeCurso.'</td>';
            echo '<td>';
                      if($this->permission->checkPermission($this->session->userdata('permissao'),'eCurso')){
                		echo '<a href="'.base_url().'index.php/cursos/editar/'.$r->idCursos.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Curso"><i class="icon-pencil icon-white"></i></a>'; 
           		 	  }
            		  if($this->permission->checkPermission($this->session->userdata('permissao'),'dCurso')){
                		echo '<a href="#modal-excluir" role="button" data-toggle="modal" cursos="'.$r->idCursos.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Curso"><i class="icon-remove icon-white"></i></a>'; 
            		  }
                  '</td>';
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
  <form action="<?php echo base_url() ?>index.php/cursos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Curso</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idCursos" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele?</h5>
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
        
        var cursos = $(this).attr('cursos');
        $('#idCursos').val(cursos);

    });

});

</script>

