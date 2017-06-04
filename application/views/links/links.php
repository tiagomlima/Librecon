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

<div class="span12" style="margin-left: 0">
           <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aLink')){ ?>
             <div class="span3">
                <a href="<?php echo base_url();?>index.php/links/adicionar" class="btn btn-success span12"><i class="icon-plus icon-white"></i> Adicionar Link</a>
            </div>  
        <?php } ?>
                        
</div>

<?php
if(!$results){?>

<div class="span12" style="margin-left: 0">
        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
            </span>
            <h5>Links</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Link</th>                      
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum link cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="span12" style="margin-left: 0">
    <div class="widget-box">
         <div class="widget-title">
            <span class="icon">
                <i class="icon-hdd"></i>
             </span>
            <h5>Links</h5>

         </div>

    <div class="widget-content nopadding">


    <table class="table table-bordered ">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Link</th>                
                <th>Editar/Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r) {
                echo '<tr>';
                echo '<td>'.$r->descricao.'</td>';  
				echo '<td><a href="'.$r->link.'" target="_blank">'.$r->link.'</a></td>';                 
                echo '<td style="text-align:center">';                                      
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'eLink')){ 
                        echo  '<a href="'.base_url().'index.php/links/editar/'.$r->idLink.'" class="btn btn-info tip-top" style="margin-right: 1%" title="Editar"><i class="icon-pencil icon-white"></i></a>';
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'dLink')){
                         echo '<a href="#modal-excluir" style="margin-right: 1%" role="button" data-toggle="modal" link="'.$r->idLink.'" class="btn btn-danger tip-top" title="Excluir Link"><i class="icon-remove icon-white"></i></a>';
                    }
                echo  '</td>';
                echo '</tr>';
            }?>
            <tr>
                
            </tr>
        </tbody>
    </table>
    </div>
    </div>

</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/links/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Link</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idLink" name="idLink" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esse link?</h5>
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
        
        var link = $(this).attr('link');
        $('#idLink').val(link);

   });
});

</script>
