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
                          <h4 style="text-align: center">Empréstimos</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1em; padding: 5px; text-align:center">Leitor</th>
                              <th style="font-size: 1em; padding: 5px; text-align:center">Data Empréstimo</th>
                              <th style="font-size: 1em; padding: 5px; text-align:center">Quantidade</th>
                              <th style="font-size: 1em; padding: 5px; text-align:center">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($emprestimos as $e) {

                              echo '<tr>';
                              echo '<td style="text-align:center; font-size: 1em">' . $e->nome . '</td>';
                              echo '<td style="text-align:center; font-size: 1em">' . date('d/m/Y',  strtotime($e->dataEmprestimo)). '</td>';                                              
                              echo '<td style="text-align:center; font-size: 1em">' . $e->qtde_item. '</td>';
                              echo '<td style="text-align:center; font-size: 1em">' . $e->status. '</td>';
                              echo '</tr>';
                          }
                          ?>
                          <tr>
                          <?php 
							$totalEmprestimos = $this->db->get('emprestimos')->result();							
                          ?>
	                          <td colspan="4" style="text-align: right; font-size: 1em"><strong>Total de registros:</strong></td>	                          
	                          <td><strong><?php echo count($totalEmprestimos) ?></strong></td>
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







