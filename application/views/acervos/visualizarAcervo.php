<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Acervo</a></li>
            <?php if($this->session->userdata('tipo_usuario') == 0 && $this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){ ?>
            <li><a data-toggle="tab" href="#tab2">Empréstimos</a></li>
            <li><a data-toggle="tab" href="#tab3">Reservas</a></li>
            <?php } ?>
            <a href="<?php echo base_url() ?>index.php/acervos" id="" class="btn btn-mini" style="float:right;margin-top:0.6%;margin-right: 0.5%"><i class="icon-arrow-left"></i> Voltar</a>
            <div class="buttons">
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/acervos/editar/'.$result->idAcervos.'"><i class="icon-pencil icon-white"></i> Editar</a>'; 
                    } ?>
                    
            </div>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">

            <div class="accordion" id="collapse-group">
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Dados</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content">
                                    		<span style="float:left;width:50%"><img src="<?php echo $result->img_acervo ?>" alt="imagem do acervo" style="width:40%;height:40%"/></span>
								            <span><h5>Descrição: </h5></span><br>
								            <span style="position: relative; right: 17%;width: 45%"><p style="text-align:justify"><?php echo $result->descricao ?></p></span>
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
						                            <td style="text-align: right"><strong>ISBN</strong></td>
						                            <td><?php echo $result->isbn ?></td>
						                        </tr> 
						                        <?php if($this->session->userdata('tipo_usuario') == 0){ ?>  
						                        <tr>                       	 
						                            <td style="text-align: right"><strong>Tabela Cutter</strong></td>
						                            <td><?php echo $result->tabelaCutter ?></td>
						                               
						                        </tr>
						                         <?php } ?>  
						                        <tr>
						                            <td style="text-align: right"><strong>Tombo</strong></td>
						                            <td><?php echo $result->tombo ?></td>
						                        </tr> 
						                        <tr>
						                            <td style="text-align: right"><strong>Categoria</strong></td>
						                            <td><?php echo $categoria->categoria ?></td>
						                        </tr>
						                        <tr>
						                            <td style="text-align: right"><strong>Tipo:</strong></td>
						                            <td><?php echo $tipo->tipo ?></td>
						                        </tr>     
						                        <?php if($this->session->userdata('tipo_usuario') == 0){ ?>    
						                        <tr>
						                            <td style="text-align: right"><strong>Seção:</strong></td>
						                            <td><?php echo $secao->secao ?></td>
						                        </tr> 	
						                        <tr>
						                            <td style="text-align: right"><strong>Data Aquisição:</strong></td>
						                            <td><?php echo date('d/m/Y', strtotime($result->dataAquisicao)) ?></td>
						                        </tr>
						                        <tr>
						                            <td style="text-align: right"><strong>Origem Aquisição:</strong></td>
						                            <td><?php echo $result->origemAquisicao ?></td>
						                        </tr>    
						                        <tr>
						                            <td style="text-align: right"><strong>Observação Aquisição:</strong></td>
						                            <td><?php echo $result->observacaoAquisicao ?></td>
						                        </tr>   
						                        <tr>
						                            <td style="text-align: right"><strong>Preço:</strong></td>
						                            <?php 
						                            	$preco = $result->preco;
														$preco = str_replace(".",",",$preco);
														
														if($preco == 0){ ?>
															<td>Desconhecido</td>
										    	 <?php }else{ ?>
															<td><?php echo 'R$: '.$preco ?></td>
														<?php } ?>                                                  
						                        </tr>                         
						                        <tr>
						                            <td style="text-align: right"><strong>Edição</strong></td>
						                            <td><?php echo $result->edicao ?></td>
						                        </tr>                             
						                        <tr>
						                            <td style="text-align: right"><strong>Classificação</strong></td>
						                            <td><?php echo $result->classificacao ?></td>
						                        </tr> 
												<?php } ?>       
						                        <tr>
						                            <td style="text-align: right"><strong>Idioma</strong></td>
						                            <td><?php echo $result->idioma; ?></td>
						                        </tr>
						                        <tr>
						                            <td style="text-align: right"><strong>Nº de Páginas</strong></td>
						                            <td><?php echo $result->numero_paginas ?></td>
						                        </tr> 
						                        <tr>
						                            <td style="text-align: right"><strong>Ano de Edição</strong></td>
						                            <td><?php echo $result->anoEdicao ?></td>
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
							                 
							               	 if($this->session->userdata('tipo_usuario') == 1){
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
        </div>
		<?php if($this->session->userdata('tipo_usuario') == 0){ ?>
        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
            <?php if (!$emprestimos) { ?>
                
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Emprestimo</th>
                                    <th>Data Vencimento</th>
                                    <th>Status</th>
                                    <th>Visualizar/Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="6">Nenhum empréstimo cadastrado</td>
                                </tr>
                            </tbody>
                        </table>
                
                <?php } else { ?>
           
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Emprestimo</th>
                                    <th>Data Vencimento</th>
                                    <th>Status</th>
                                    <th>Visualizar/Editar</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                foreach ($emprestimos as $r) {
                    
                    echo '<tr>';
                    echo '<td>' . $r->idEmprestimos . '</td>';
                    echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataEmprestimo)) . '</td>';
                    echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataVencimento)) . '</td>';
                    echo '<td style="text-align:center">' . $r->status . '</td>';

                    echo '<td style="text-align:center">';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){
                        echo '<a href="' . base_url() . 'index.php/emprestimos/visualizar/' . $r->idEmprestimos . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
                        echo '<a href="' . base_url() . 'index.php/emprestimos/editar/' . $r->idEmprestimos . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>'; 
                    }
                    
                    echo  '</td>';
                    echo '</tr>';
                } ?>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
            

            <?php  } ?>

        </div>
        
        
               <!--Tab 3-->
        <div id="tab3" class="tab-pane" style="min-height: 300px">
            <?php if (!$reservas) { ?>
                
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Reserva</th>
                                    <th>Data Prazo</th>
                                    <th>Status</th>
                                    <th>Visualizar/Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="6">Nenhuma reserva cadastrada</td>
                                </tr>
                            </tbody>
                        </table>
                
                <?php } else { ?>
           
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Reserva</th>
                                    <th>Data Prazo</th>
                                    <th>Status</th>
                                    <th>Visualizar/Editar</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                foreach ($reservas as $r) {
                    
                    echo '<tr>';
                    echo '<td>' . $r->idReserva . '</td>';
                    echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataReserva)) . '</td>';
                    echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataPrazo)) . '</td>';
                    echo '<td style="text-align:center">' . $r->status . '</td>';

                    echo '<td style="text-align:center">';
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){
                        echo '<a href="' . base_url() . 'index.php/reservas/visualizar/' . $r->idReserva . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                    }
                    if($this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
                        echo '<a href="' . base_url() . 'index.php/reservas/editar/' . $r->idReserva . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>'; 
                    }
                    
                    echo  '</td>';
                    echo '</tr>';
                } ?>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
            

            <?php  } ?>

        </div>
        <?php } ?>
    </div>
</div>