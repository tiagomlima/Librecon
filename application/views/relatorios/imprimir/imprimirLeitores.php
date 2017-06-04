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
                          <h4 style="text-align: center">Leitores</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1.2em; padding: 5px;">Nome</th>
                              <th style="font-size: 1.2em; padding: 5px;">Matricula</th>
                              <th style="font-size: 1.2em; padding: 5px;">Curso</th>
                              <th style="font-size: 1.2em; padding: 5px;">Email</th>
                              <th style="font-size: 1.2em; padding: 5px;">Telefone</th>
                              <th style="font-size: 1.2em; padding: 5px;">Cadastro</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($leitores as $l) {
                              $dataCadastro = date('d/m/Y', strtotime($l->dataCadastro));
                              echo '<tr>';
                              echo '<td>' . $l->nome . '</td>';
                              echo '<td>' . $l->matricula . '</td>';
							  $this->db->where('idCursos',$l->curso_id);
							  $curso = $this->db->get('cursos')->result();
							  foreach($curso as $c){
                              echo '<td>' . $c->nomeCurso . '</td>';
                              echo '<td>' . $l->email . '</td>';
							  echo '<td>' . $l->telefone . '</td>';
                              echo '<td>' . $dataCadastro . '</td>';
                              echo '</tr>';
                              
							}							  
                          }
                          ?>
                          <tr>
                          <?php 
                          	$this->db->where('tipo_usuario',1);
							$totalLeitores = $this->db->get('usuarios')->result();							
                          ?>
	                          <td colspan="2" style="text-align: right"><strong>Total de cadastros:</strong></td>	                          
	                          <td><strong><?php echo count($totalLeitores) ?></strong></td>
                          </tr>
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







