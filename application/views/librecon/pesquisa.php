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
                    <i class="icon-barcode"></i>
                </span>
                <h5>Acervos</h5>

            </div>

            <div class="widget-content nopadding">

               
                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Nome</th>
                            <th>Tombo</th>
                            <th>Estoque</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($acervos == null){
                            echo '<tr><td colspan="4">Nenhum acervo foi encontrado.</td></tr>';
                        }
                        foreach ($acervos as $a) {
                            echo '<tr>';
                            echo '<td>' . $a->idAcervos . '</td>';
                            echo '<td>' . $a->titulo . '</td>';
                            echo '<td>' . $a->tombo . '</td>';
							echo '<td>' . $a->estoque . '</td>';

                            echo '<td>';
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($usuarios == null){
                            echo '<tr><td colspan="4">Nenhum leitor foi encontrado.</td></tr>';
                        }
                        foreach ($usuarios as $u) {
                            echo '<tr>';
                            echo '<td>' . $u->idUsuarios . '</td>';
                            echo '<td>' . $u->nome . '</td>';
                            echo '<td>' . $u->matricula . '</td>';
                            echo '<td>';

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
    
    <!--Serviços-->
    <div class="span6" style="margin-left: 0">
        <div class="widget-box" style="min-height: 200px">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-wrench"></i>
                </span>
                <h5>Reservas</h5>

            </div>

            <div class="widget-content nopadding">


                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($servicos == null){
                            echo '<tr><td colspan="4">Nenhum serviço foi encontrado.</td></tr>';
                        }
                        foreach ($servicos as $r) {
                            echo '<tr>';
                            echo '<td>' . $r->idServicos . '</td>';
                            echo '<td>' . $r->nome . '</td>';
                            echo '<td>' . $r->preco . '</td>';
                            echo '<td>';
                            if($this->permission->checkPermission($this->session->userdata('permissao'),'eServico')){
                                echo '<a href="' . base_url() . 'index.php/servicos/editar/' . $r->idServicos . '" class="btn btn-info tip-top" title="Editar Serviço"><i class="icon-pencil icon-white"></i></a>'; 
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
                    <i class="icon-tags"></i>
                </span>
                <h5>Emprestimos</h5>

            </div>

            <div class="widget-content nopadding">


                <table class="table table-bordered ">
                    <thead>
                        <tr style="backgroud-color: #2D335B">
                            <th>#</th>
                            <th>Data Emprestimo</th>
                            <th>Data Vencimento</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($emprestimos == null){
                            echo '<tr><td colspan="4">Nenhum emprestimo foi encontrado.</td></tr>';
                        }
                        foreach ($emprestimos as $e) {
                            $dataEmprestimo = date(('d/m/Y'), strtotime($r->$dataEmprestimo));
                            $dataVencimento = date(('d/m/Y'), strtotime($r->$dataVencimento));
                            echo '<tr>';
                            echo '<td>' . $e->idEmprestimos . '</td>';
                            echo '<td>' . $dataEmprestimo . '</td>';
                            echo '<td>' . $e->status . '</td>';

                            echo '<td>';
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

