
<!DOCTYPE html>
<html lang="en">
<head>
<title>Librecon</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" /> 

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="">Librecon</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
   
    <li class=""><a title="" href="<?php echo base_url();?>index.php/librecon/minhaConta"><i class="icon icon-star"></i> <span class="text">Minha Conta</span></a></li>
    <li class=""><a title="" href="<?php echo base_url();?>index.php/librecon/sair"><i class="icon icon-share-alt"></i> <span class="text">Sair do Sistema</span></a></li>
  </ul>
</div>

<!--start-top-serch-->
<div id="search">
  <form action="<?php echo base_url()?>index.php/librecon/pesquisar">
    <input type="text" name="termo" placeholder="Pesquisar..."/>
    <button type="submit"  class="tip-bottom" title="Pesquisar"><i class="icon-search icon-white"></i></button>
    
  </form>
</div>
<!--close-top-serch--> 

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
  <ul>


    <li class="<?php if(isset($menuPainel)){echo 'active';};?>"><a href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span>Dashboard</span></a></li>
    
    
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor') || $this->permission->checkPermission($this->session->userdata('permissao'), 'vCurso') || $this->permission->checkPermission($this->session->userdata('permissao'), 'vDisciplina') || $this->permission->checkPermission($this->session->userdata('permissao'), 'vGrupo')){ ?>
        <li class="submenu <?php if(isset($menuLeitores)){echo 'active open';};?>">
          <a href="#"><i class="icon icon-group"></i> <span>Leitores</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){ ?>
                <li><a href="<?php echo base_url()?>index.php/leitores">Leitores</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vCurso')){ ?>
                <li><a href="<?php echo base_url()?>index.php/cursos">Cursos</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vDisciplina')){ ?>
                <li><a href="<?php echo base_url()?>index.php/disciplinas">Disciplinas</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vGrupo')){ ?>
                <li><a href="<?php echo base_url()?>index.php/grupos">Grupos</a></li>
            <?php } ?>
          </ul>
        </li>
    <?php } ?>
    
    
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo') || $this->permission->checkPermission($this->session->userdata('permissao'),'vAutor') || $this->permission->checkPermission($this->session->userdata('permissao'),'vEditora') || $this->permission->checkPermission($this->session->userdata('permissao'),'vTipoItem') || $this->permission->checkPermission($this->session->userdlata('permissao'),'vSecao') || $this->permission->checkPermission($this->session->userdata('permissao'),'vColecao')){ ?>
        
        <li class="submenu <?php if(isset($menuAcervos)){echo 'active open';};?>" >
          <a href="#"><i class="icon icon-book"></i> <span>Acervo</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){ ?>
                <li><a href="<?php echo base_url()?>index.php/acervos">Acervo</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vAutor')){ ?>
                <li><a href="<?php echo base_url()?>index.php/autor">Autor</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vEditora')){ ?>
                <li><a href="<?php echo base_url()?>index.php/editora">Editora</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vTipoItem')){ ?>
                <li><a href="<?php echo base_url()?>index.php/tipoItem">Tipo de Item</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vCategoria')){ ?>
                <li><a href="<?php echo base_url()?>index.php/categoria">Categoria</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vSecao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/secao">Seção</a></li>
            <?php } ?>
            
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vColecao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/colecao">Coleção</a></li>
            <?php } ?>
            
          </ul>
        </li>

    <?php } ?>
    
	<?php 
		if($this->session->userdata('tipo_usuario') == 1){
			$reserva = $this->reservas_model->getReservaById($this->session->userdata('id'));
			
			if(count($reserva) > 0){ ?>
				<li class="<?php if(isset($menuReserva)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/reservas"><i class="icon icon-calendar"></i> <span>Reservas</span></a></li>
		<?php	}
		} ?>		
		
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva') && $this->session->userdata('tipo_usuario') == 0){ ?>
        <li class="<?php if(isset($menuReserva)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/reservas"><i class="icon icon-calendar"></i> <span>Reservas</span></a></li>
    <?php } ?>


    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){ ?>
        <li class="<?php if(isset($menuEmprestimos)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/emprestimos"><i class="icon icon-book"></i> <span>Emprestimos</span></a></li>
    <?php } ?>
    
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vArquivo')){ ?>
        <li class="<?php if(isset($menuArquivos)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/arquivos"><i class="icon icon-hdd"></i> <span>Arquivos</span></a></li>
    <?php } ?>

    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vLancamento')){ ?>
        <li class="submenu <?php if(isset($menuFinanceiro)){echo 'active open';};?>">
          <a href="#"><i class="icon icon-money"></i> <span>Financeiro</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>
            <li><a href="<?php echo base_url()?>index.php/financeiro/lancamentos">Lançamentos</a></li>
          </ul>
        </li>
    <?php } ?>

    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rLeitor') || $this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo') || $this->permission->checkPermission($this->session->userdata('permissao'),'rServico') || $this->permission->checkPermission($this->session->userdata('permissao'),'rOs') || $this->permission->checkPermission($this->session->userdata('permissao'),'rFinanceiro') || $this->permission->checkPermission($this->session->userdata('permissao'),'rEmprestimo')){ ?>
        
        <li class="submenu <?php if(isset($menuRelatorios)){echo 'active open';};?>" >
          <a href="#"><i class="icon icon-list-alt"></i> <span>Relatórios</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>

            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rLeitor')){ ?>
                <li><a href="<?php echo base_url()?>index.php/relatorios/leitores">Leitores</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){ ?>
                <li><a href="<?php echo base_url()?>index.php/relatorios/acervos">Acervos</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rServico')){ ?>
                <li><a href="<?php echo base_url()?>index.php/relatorios/servicos">Serviços</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rOs')){ ?>
                 <li><a href="<?php echo base_url()?>index.php/relatorios/os">Ordens de Serviço</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rEmprestimo')){ ?>
                <li><a href="<?php echo base_url()?>index.php/relatorios/emprestimos">Emprestimos</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'rFinanceiro')){ ?>
                <li><a href="<?php echo base_url()?>index.php/relatorios/financeiro">Financeiro</a></li>
            <?php } ?>
            
          </ul>
        </li>

    <?php } ?>

    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')  || $this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente') || $this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao') || $this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
        <li class="submenu <?php if(isset($menuConfiguracoes)){echo 'active open';};?>">
          <a href="#"><i class="icon icon-cog"></i> <span>Configurações</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
          <ul>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')){ ?>
                <li><a href="<?php echo base_url()?>index.php/usuarios">Usuários</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){ ?>
                <li><a href="<?php echo base_url()?>index.php/librecon/emitente">Emitente</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao')){ ?>
                <li><a href="<?php echo base_url()?>index.php/permissoes">Permissões</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){ ?>
                <li><a href="<?php echo base_url()?>index.php/librecon/backup">Backup</a></li>
            <?php } ?>
            <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'cCurso')){ ?>
                <li><a href="<?php echo base_url()?>index.php/cursos">Cursos</a></li>
            <?php } ?>
            
             
 
          </ul>
        </li>
    <?php } ?>
    
    
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url()?>" title="Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a> <?php if($this->uri->segment(1) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1)?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1));?>"><?php echo ucfirst($this->uri->segment(1));?></a> <?php if($this->uri->segment(2) != null){?><a href="<?php echo base_url().'index.php/'.$this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));} ?></a> <?php }?></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
          <?php if($this->session->flashdata('error') != null){?>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('error');?>
                           </div>
                      <?php }?>

                      <?php if($this->session->flashdata('success') != null){?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('success');?>
                           </div>
                      <?php }?>
                          
                      <?php if(isset($view)){echo $this->load->view($view);}?>


      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date('Y'); ?> &copy; </div>
</div>
<!--end-Footer-part-->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 


</body>
</html>







