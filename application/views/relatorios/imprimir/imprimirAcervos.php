<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
  <head>
    <title>LIBRECON</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/blue.css" class="skin-color" />
    <script type="text/javascript"  src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body style="background-color: transparent">



      <div class="container-fluid">

          <div class="row-fluid">
              <div class="span12">

                  <div class="widget-box">
                      <div class="widget-title">
                          <h4 style="text-align: center">Acervos</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1.2em; padding: 5px;">Título</th>
                              <th style="font-size: 1.2em; padding: 5px;">Autor</th>
                              <th style="font-size: 1.2em; padding: 5px;">Editora</th>
                              <th style="font-size: 1.2em; padding: 5px;">ISBN</th>
                              <th style="font-size: 1.2em; padding: 5px;">Tombo</th>
                              <?php if($tipo == 2){?>
                              <th style="font-size: 1.2em; padding: 5px;">Data Aquisição</th>
                              <?php } ?>
                              <?php if($tipo == 4){ ?>                              
                              <th style="font-size: 1.2em; padding: 5px;">Emprestimos</th>
                              <?php }else { ?>
                              <th style="font-size: 1.2em; padding: 5px;">Estoque</th>
                              <?php } ?>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($acervos as $a) {
                              echo '<tr>';
                              echo '<td>' . $a->titulo. '</td>';
							  
							  $this->db->where('idAutor',$a->autor_id);
							  $autor = $this->db->get('autor')->result();
							  
							  foreach ($autor as $at){
	                              echo '<td>' . $at->autor . '</td>';
	                              
								  $this->db->where('idEditora',$a->editora_id);								  
								  $editora = $this->db->get('editora')->result();	
							  foreach ($editora as $e){
							  	  echo '<td>' . $e->editora . '</td>';
	                              echo '<td>' . $a->isbn . '</td>';
	                              echo '<td>' . $a->tombo. '</td>';
								  if($tipo == 2){
								  	echo '<td>' .date('d/m/Y', strtotime($a->dataAquisicao)). '</td>';
								  }
								  if($tipo == 4){
								  	echo '<td>' . $a->total. '</td>';
								  } else {
								  	echo '<td>' . $a->estoque. '</td>';
								  }	                              
	                              echo '</tr>';
							 	}
						 	 }
                          }
						  $totalAcervos = $this->db->get('acervos')->result();
						  
						  if($tipo == 1){						  							  
                          ?>                         
                          <tr>
                          	<td><h6>Total de Acervos: <?php echo count($totalAcervos) ?> </h6></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>

                  </div>

              </div>
                  <h5 style="text-align: right">Data do Relatório: <?php echo date('d/m/Y');?></h5>

          </div>



      </div>
</div>




            <!-- Arquivos js-->

            <script src="<?php echo base_url();?>js/excanvas.min.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.flot.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.flot.resize.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.peity.min.js"></script>
            <script src="<?php echo base_url();?>js/fullcalendar.min.js"></script>
            <script src="<?php echo base_url();?>js/sosmc.js"></script>
            <script src="<?php echo base_url();?>js/dashboard.js"></script>
  </body>
</html>

