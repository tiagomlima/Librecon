<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<div class="span12" style="margin-left: 0; margin-top: 0">
    <div class="span12" style="margin-left: 0">
        <form action="<?php echo current_url()?>">
        <div class="span10" style="margin-left: 0">
            <input type="text" class="span12" name="termo" placeholder="Digite o termo a pesquisar" />
        </div>
        <div class="span2">
            <button class="span12 btn"><i class=" icon-search"></i> Pesquisar</button>
        </div>
        </form>
    </div>
    <div class="span12" style="margin-left: 0; margin-top: 0">
    <!--Acervoss-->
    <div class="span6" style="margin-left: 0; margin-top: 0">
        <div class="widget-box" style="min-height: 200px">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-book"></i>
                </span>
                <h5>Acervos</h5>

            </div>

            <div class="widget-content nopadding">

               
                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Título</th>
                            <th>Exemplares</th>
                            <th>Visualizar/Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($acervos == null){
                            echo '<tr><td colspan="4">Nenhum acervo foi encontrado.</td></tr>';
                        }
                        foreach ($acervos as $a) {
                            echo '<tr>';
                            echo '<td style="text-align:center">' . $a->idAcervos . '</td>';
                            echo '<td style="text-align:center"><a href="'.base_url().'index.php/acervos/visualizar/'.$a->idAcervos.'">' . $a->titulo . '</a></td>';
							echo '<td style="text-align:center">' . $a->estoque . '</td>';

                            echo '<td style="text-align:center">';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/acervos/visualizar/' . $a->idAcervos . '" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                            }
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
                                echo '<a href="' . base_url() . 'index.php/acervos/editar/' . $a->idAcervos . '" class="btn btn-info tip-top" title="Editar Acervo"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                            
                            echo '</td>';
                            echo '</tr>';
                        } ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--Leitores-->
    <div class="span6">
        <div class="widget-box" style="min-height: 200px">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Leitores</h5>

            </div>

            <div class="widget-content nopadding">


                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Curso</th>
                            <th>Visualizar/Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($usuarios == null){
                            echo '<tr><td colspan="4">Nenhum leitor foi encontrado.</td></tr>';
                        }
                        foreach ($usuarios as $u) {
                            echo '<tr>';
                            echo '<td style="text-align:center">' . $u->idUsuarios . '</td>';
                            echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$u->idUsuarios.'">' . $u->nome . '</a></td>';
                            echo '<td style="text-align:center">' . $u->matricula . '</td>';
							
							$this->db->where('idCursos',$u->curso_id);
							$curso = $this->db->get('cursos')->row();
							
							echo '<td style="text-align:center">' . $curso->nomeCurso . '</td>';
                            echo '<td style="text-align:center">';

                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/leitores/visualizar/' . $u->idUsuarios . '" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                            } 
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eLeitor')){
                                echo '<a href="' . base_url() . 'index.php/leitores/editar/' . $u->idUsuarios . '" class="btn btn-info tip-top" title="Editar Leitor"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                            
                            
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    </div>
    
    <!--Reservas-->
    <div class="span6" style="margin-left: 0">
        <div class="widget-box" style="min-height: 200px">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-calendar"></i>
                </span>
                <h5>Reservas</h5>

            </div>

            <div class="widget-content nopadding">


                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Leitor</th>
                            <th>Data Reserva</th>
                            <th>Data Prazo</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($reservas == null){
                            echo '<tr><td colspan="4">Nenhuma reserva foi encontrada.</td></tr>';
                        }
                        foreach ($reservas as $r) {
                            echo '<tr>';
                            echo '<td style="text-align:center">' . $r->idReserva . '</td>';
							
							$this->db->where('idUsuarios',$r->usuario_id);
							$leitor = $this->db->get('usuarios')->row();
							
							echo '<td style="text-align:center">' . $leitor->nome . '</td>';
                            echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataReserva)). '</td>';
                            echo '<td style="text-align:center">' . date('d/m/Y', strtotime($r->dataPrazo)) . '</td>';
                            echo '<td style="text-align:center">';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
                                echo '<a href="' . base_url() . 'index.php/reservas/editar/' . $r->idReserva . '" class="btn btn-info tip-top" title="Editar Reserva"><i class="icon-pencil icon-white"></i></a>'; 
                            } 
                                
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--Emprestimos-->
    <div class="span6">
         <div class="widget-box" style="min-height: 200px">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list"></i>
                </span>
                <h5>Emprestimos</h5>

            </div>

            <div class="widget-content nopadding">


                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Leitor</th>
                            <th>Data Vencimento</th>
                            <th>Status</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($emprestimos == null){
                            echo '<tr><td colspan="4">Nenhum emprestimo foi encontrado.</td></tr>';
                        }
                        foreach ($emprestimos as $e) {
							$dataVencimento = date('d/m/Y', strtotime($e->dataVencimento));
                            echo '<tr>';
                            echo '<td style="text-align:center">' . $e->idEmprestimos . '</td>';
							
							$this->db->where('idUsuarios',$e->leitor_id);
							$leitor = $this->db->get('usuarios')->row();
							
							echo '<td style="text-align:center"><a href="'.base_url().'index.php/leitores/visualizar/'.$leitor->idUsuarios.'">' . $leitor->nome . '</a></td>';
							echo '<td style="text-align:center">' . $dataVencimento . '</td>';
                            echo '<td style="text-align:center">' . $e->status . '</td>';

                            echo '<td style="text-align:center">';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){
                                echo '<a style="margin-right: 1%" href="' . base_url() . 'index.php/emprestimos/visualizar/' . $e->idEmprestimos . '" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
                            } 
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimos')){
                                echo '<a href="' . base_url() . 'index.php/emprestimos/editar/' . $e->idEmprestimos . '" class="btn btn-info tip-top" title="Editar Empréstimo"><i class="icon-pencil icon-white"></i></a>'; 
                            }  
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>

