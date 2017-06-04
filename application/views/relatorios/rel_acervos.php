<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<div class="row-fluid" style="margin-top: 0;margin-left:15%">
    <div class="span8">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Relatórios Rápidos</h5>
            </div>
            <div class="widget-content">
                <ul class="site-stats">
                    <li><a target="_blank" href="<?php echo base_url()?>index.php/relatorios/acervosRapid"><i class="icon-book"></i> <small>Todos os Acervos</small></a></li>
                    <li><a target="_blank" href="<?php echo base_url()?>index.php/relatorios/acervosRapidMin"><i class="icon-book"></i> <small>Com Estoque Mínimo</small></a></li>
                    <li><a target="_blank" href="<?php echo base_url()?>index.php/relatorios/acervosMaisEmprestados"><i class="icon-book"></i> <small>Mais emprestados</small></a></li>
                    <li><a target="_blank" href="<?php echo base_url()?>index.php/relatorios/acervosDataAquisicao"><i class="icon-book"></i> <small>Data de Aquisição</small></a></li>
                </ul>
            </div>
        </div>
    </div>

</div>


<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

      
    });
</script>