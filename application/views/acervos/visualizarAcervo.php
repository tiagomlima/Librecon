<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="icon-list"></i></span><h5>Dados do Acervo</h5>
                     <a href="<?php echo base_url() ?>index.php/acervos" id="" class="btn" style="float:right"><i class="icon-arrow-left"></i> Voltar</a>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
            <span style="float:left"><img src="<?php echo $result->img_acervo ?>" alt="imagem do acervo" style="width:60%;height:60%"/></span>
            <span><h5>Descrição: </h5></span><br>
            <span style="position: relative; right: 10%"><p style="text-align:justify"><?php echo $result->descricao ?></p></span>
                <table class="table table-bordered">
                    <tbody>
                    	
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Título</strong></td>
                            <td><?php echo $result->titulo ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Autor</strong></td>
                            <td><?php echo $autor->autor ?></td>
                        </tr> 
                        <tr>
                            <td style="text-align: right"><strong>Editora</strong></td>
                            <td><?php echo $editora->editora ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Coleção</strong></td>
                            <td><?php echo $colecao->colecao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Tombo</strong></td>
                            <td><?php echo $result->tombo ?></td>
                        </tr>                        
                        <tr>
                            <td style="text-align: right"><strong>Idioma</strong></td>
                            <td><?php echo $result->idioma; ?></td>
                        </tr>
                        <tr>
                        <?php 
                        	if($this->session->userdata('tipo_usuario') == 1){
                        		$titulo = 'Disponibilidade';
                        		if($result->estoque > 1){                       			
                        			$status = 'Disponível';
                        		}else {
                        			$status = 'Indisponível';
                        		}                      		
                        	}else{
                        		$titulo = 'Estoque';
								$status = $result->estoque;
                        	}
                        ?>
                            <td style="text-align: right"><strong><?php echo $titulo ?></strong></td>
                            <td> <?php echo $status ?></td>
                        </tr>                 
                    </tbody>
                    
                </table>              
               
                <?php
                 
               	 if($this->session->userdata('tipo_usuario') == 1 && $result->estoque > 1){
               	 ?>	
               	 <form action="<?php echo base_url() ?>index.php/acervos/reservar" method="post">
               	 	<input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $this->session->userdata('id') ?>"/>
               	 	<input type="hidden" id="acervos_id" name="acervos_id" value="<?php echo $result->idAcervos ?>"/>
               	 	<input type="hidden" id="validade_reserva" name="validade_reserva" value="<?php echo $grupo->validade_reserva ?>"/>
               	 	<button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Reservar</button>
               	 </form>
				 <?php	
               	 }				 
                ?>
                
            </div>
        </div>
    </div>
</div>

