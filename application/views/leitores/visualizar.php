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
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Leitor</a></li>
            <li><a data-toggle="tab" href="#tab2">Empréstimos</a></li>
            <li><a data-toggle="tab" href="#tab3">Reservas</a></li>
            <div class="buttons">
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eLeitor')){
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/leitores/editar/'.$result->idUsuarios.'"><i class="icon-pencil icon-white"></i> Editar</a>'; 
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
                                            <span class="icon"><i class="icon-list"></i></span><h5>Dados Pessoais</h5>
                                        </a>
                                    </div>
                                </div>
                                <img src="<?php echo $result->img_leitor ?>" alt="foto do leitor" width="15%" height="15%" style="margin-left: 1.5%;margin-top:1%"/>
                                <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                                    <td><?php echo $result->nome ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>CPF</strong></td>
                                                    <td><?php echo $result->cpf ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Sexo</strong></td>
                                                    <td><?php echo $result->sexo ?></td>
                                                </tr>
                                                 <tr>
                                                    <td style="text-align: right"><strong>Curso</strong></td>
                                                    <td><?php echo $curso->curso ?></td>
                                                </tr>
                                                 <tr>
                                                    <td style="text-align: right"><strong>Grupo</strong></td>
                                                    <td><?php echo $grupo->grupo ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Matricula R.A</strong></td>
                                                    <td><?php echo $result->matricula ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Data de Nascimento</strong></td>
                                                   <td><?php echo date('d/m/Y',  strtotime($result->datanasc)) ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Situação</strong></td>
                                                    <td><?php 
                                                    if($result->situacao == 1){
                                                    	echo 'Ativo';
                                                    }else{
                                                    	echo 'Inativo';
                                                    }
                                                    
													 ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                                                    <td><?php echo date('d/m/Y',  strtotime($result->dataCadastro)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Contatos</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGTwo">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Telefone</strong></td>
                                                    <td><?php echo $result->telefone ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Celular</strong></td>
                                                    <td><?php echo $result->celular ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Email</strong></td>
                                                    <td><?php echo $result->email ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Endereço</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGThree">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Rua</strong></td>
                                                    <td><?php echo $result->rua ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Número</strong></td>
                                                    <td><?php echo $result->numero ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Bairro</strong></td>
                                                    <td><?php echo $result->bairro ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Cidade</strong></td>
                                                    <td><?php echo $result->cidade ?> - <?php echo $result->estado ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>CEP</strong></td>
                                                    <td><?php echo $result->cep ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
          
        </div>

        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
            <?php if (!$results) { ?>
                
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
                foreach ($results as $r) {
                    
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
                                    <th>Visualizar/Editar/Adicionar</th>
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
                        echo '<a href="' . base_url() . 'index.php/reservas/editar/' . $r->idReserva . '" class="btn btn-info tip-top" title="Editar Reserva"><i class="icon-pencil icon-white"></i></a>'; 
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
    </div>
</div>