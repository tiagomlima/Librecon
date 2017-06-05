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
   		<h2>Seja Bem-vindo <?php echo $usuario->nome ?> ao Librecon !</h2>
   		
   		<div class="span8" style="margin-left: 25%;margin-top: 10%">
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){ ?>
            <li class="bg_lg"> <a href="<?php echo base_url()?>index.php/acervos"> <i class="icon-book"></i> Acervos</a> </li>
        <?php } ?>
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){ ?>
            <li class="bg_ly"> <a href="<?php echo base_url()?>index.php/reservas"> <i class="icon-calendar"></i> Reservas</a> </li>
        <?php } ?>
        
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){ ?>
            <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/emprestimos"><i class="icon-book"></i> Emprestimos</a></li>
        <?php } ?>
        <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vLink')){ ?>
            <li class="bg_lb"> <a href="<?php echo base_url()?>index.php/links"> <i class="icon-link"></i>Links</a> </li>
        <?php } ?>
          </div>                             

      </ul>
    </div>
  </div>  
<!--End-Action boxes-->  

    

<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
