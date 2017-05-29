<?php $permissoes = unserialize($result->permissoes);?>
<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/editar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Editar Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span4">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" value="<?php echo $result->nome; ?>" />
                    <input type="hidden" name="idPermissao" value="<?php echo $result->idPermissao; ?>">

                </div>

                <div class="span3">
                    <label>Situação</label>
                    
                    <select name="situacao" id="situacao" class="span12">
                        <?php if($result->situacao == 1){$sim = 'selected'; $nao ='';}else{$sim = ''; $nao ='selected';}?>
                        <option value="1" <?php echo $sim;?>>Ativo</option>
                        <option value="0" <?php echo $nao;?>>Inativo</option>
                    </select>

                </div>
                <div class="span4">
                    <br/>
                    <label>
                        <input name="" type="checkbox" value="1" id="marcarTodos" />
                        <span class="lbl"> Marcar Todos</span>

                    </label>
                    <br/>
                </div>

                <div class="control-group">
                    <label for="documento" class="control-label"></label>
                    <div class="controls">

                        <table class="table table-bordered">
                            <tbody>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vLeitor'])){ if($permissoes['vLeitor'] == '1'){echo 'checked';}}?> name="vLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aLeitor'])){ if($permissoes['aLeitor'] == '1'){echo 'checked';}}?> name="aLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eLeitor'])){ if($permissoes['eLeitor'] == '1'){echo 'checked';}}?> name="eLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Leitor</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dLeitor'])){ if($permissoes['dLeitor'] == '1'){echo 'checked';}}?> name="dLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Leitor</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vAcervo'])){ if($permissoes['vAcervo'] == '1'){echo 'checked';}}?> name="vAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aAcervo'])){ if($permissoes['aAcervo'] == '1'){echo 'checked';}}?> name="aAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eAcervo'])){ if($permissoes['eAcervo'] == '1'){echo 'checked';}}?> name="eAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dAcervo'])){ if($permissoes['dAcervo'] == '1'){echo 'checked';}}?> name="dAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Acervo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vDisciplina'])){ if($permissoes['vDisciplina'] == '1'){echo 'checked';}}?> name="vDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aDisciplina'])){ if($permissoes['aDisciplina'] == '1'){echo 'checked';}}?> name="aDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eDisciplina'])){ if($permissoes['eDisciplina'] == '1'){echo 'checked';}}?> name="eDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dDisciplina'])){ if($permissoes['dDisciplina'] == '1'){echo 'checked';}}?> name="dDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Disciplina</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vGrupo'])){ if($permissoes['vGrupo'] == '1'){echo 'checked';}}?> name="vGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aGrupo'])){ if($permissoes['aGrupo'] == '1'){echo 'checked';}}?> name="aGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eGrupo'])){ if($permissoes['eGrupo'] == '1'){echo 'checked';}}?> name="eGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dGrupo'])){ if($permissoes['dGrupo'] == '1'){echo 'checked';}}?> name="dGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Grupo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vCurso'])){ if($permissoes['vCurso'] == '1'){echo 'checked';}}?> name="vCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aCurso'])){ if($permissoes['aCurso'] == '1'){echo 'checked';}}?> name="aCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eCurso'])){ if($permissoes['eCurso'] == '1'){echo 'checked';}}?> name="eCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dCurso'])){ if($permissoes['dCurso'] == '1'){echo 'checked';}}?> name="dCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Curso</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vReserva'])){ if($permissoes['vReserva'] == '1'){echo 'checked';}}?> name="vReserva" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Reserva</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aReserva'])){ if($permissoes['aReserva'] == '1'){echo 'checked';}}?> name="aReserva" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Reserva</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eReserva'])){ if($permissoes['eReserva'] == '1'){echo 'checked';}}?> name="eReserva" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Reserva</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dReserva'])){ if($permissoes['dReserva'] == '1'){echo 'checked';}}?> name="dReserva" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Reserva</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vTipoItem'])){ if($permissoes['vTipoItem'] == '1'){echo 'checked';}}?> name="vTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar TipoItem</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aTipoItem'])){ if($permissoes['aTipoItem'] == '1'){echo 'checked';}}?> name="aTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar TipoItem</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eTipoItem'])){ if($permissoes['eTipoItem'] == '1'){echo 'checked';}}?> name="eTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar TipoItem</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dTipoItem'])){ if($permissoes['dTipoItem'] == '1'){echo 'checked';}}?> name="dTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir TipoItem</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vAutor'])){ if($permissoes['vAutor'] == '1'){echo 'checked';}}?> name="vAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Autor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aAutor'])){ if($permissoes['aAutor'] == '1'){echo 'checked';}}?> name="aAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Autor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eAutor'])){ if($permissoes['eAutor'] == '1'){echo 'checked';}}?> name="eAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Autor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dAutor'])){ if($permissoes['dAutor'] == '1'){echo 'checked';}}?> name="dAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Autor</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vEditora'])){ if($permissoes['vEditora'] == '1'){echo 'checked';}}?> name="vEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Editora</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aEditora'])){ if($permissoes['aEditora'] == '1'){echo 'checked';}}?> name="aEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Editora</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eEditora'])){ if($permissoes['eEditora'] == '1'){echo 'checked';}}?> name="eEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Editora</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dEditora'])){ if($permissoes['dEditora'] == '1'){echo 'checked';}}?> name="dEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Editora</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vSecao'])){ if($permissoes['vSecao'] == '1'){echo 'checked';}}?> name="vSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Seção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aSecao'])){ if($permissoes['aSecao'] == '1'){echo 'checked';}}?> name="aSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Seção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eSecao'])){ if($permissoes['eSecao'] == '1'){echo 'checked';}}?> name="eSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Seção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dSecao'])){ if($permissoes['dSecao'] == '1'){echo 'checked';}}?> name="dSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Seção</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vColecao'])){ if($permissoes['vColecao'] == '1'){echo 'checked';}}?> name="vColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Coleção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aColecao'])){ if($permissoes['aColecao'] == '1'){echo 'checked';}}?> name="aColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Coleção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eColecao'])){ if($permissoes['eColecao'] == '1'){echo 'checked';}}?> name="eColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Coleção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dColecao'])){ if($permissoes['dColecao'] == '1'){echo 'checked';}}?> name="dColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Coleção</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                 <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vAcervo'])){ if($permissoes['vAcervo'] == '1'){echo 'checked';}}?> name="vAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Acervo <span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aAcervo'])){ if($permissoes['aAcervo'] == '1'){echo 'checked';}}?> name="aAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eAcervo'])){ if($permissoes['eAcervo'] == '1'){echo 'checked';}}?> name="eAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dAcervo'])){ if($permissoes['dAcervo'] == '1'){echo 'checked';}}?> name="dAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Acervo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vOs'])){ if($permissoes['vOs'] == '1'){echo 'checked';}}?> name="vOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aOs'])){ if($permissoes['aOs'] == '1'){echo 'checked';}}?> name="aOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eOs'])){ if($permissoes['eOs'] == '1'){echo 'checked';}}?> name="eOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dOs'])){ if($permissoes['dOs'] == '1'){echo 'checked';}}?> name="dOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir OS</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vEmprestimo'])){ if($permissoes['vEmprestimo'] == '1'){echo 'checked';}}?> name="vEmprestimo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Emprestimo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aEmprestimo'])){ if($permissoes['aEmprestimo'] == '1'){echo 'checked';}}?> name="aEmprestimo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Emprestimo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eEmprestimo'])){ if($permissoes['eEmprestimo'] == '1'){echo 'checked';}}?> name="eEmprestimo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Emprestimo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dEmprestimo'])){ if($permissoes['dEmprestimo'] == '1'){echo 'checked';}}?> name="dEmprestimo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Emprestimo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vArquivo'])){ if($permissoes['vArquivo'] == '1'){echo 'checked';}}?> name="vArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aArquivo'])){ if($permissoes['aArquivo'] == '1'){echo 'checked';}}?> name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eArquivo'])){ if($permissoes['eArquivo'] == '1'){echo 'checked';}}?> name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dArquivo'])){ if($permissoes['dArquivo'] == '1'){echo 'checked';}}?> name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Arquivo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['vLancamento'])){ if($permissoes['vLancamento'] == '1'){echo 'checked';}}?> name="vLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Visualizar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['aLancamento'])){ if($permissoes['aLancamento'] == '1'){echo 'checked';}}?> name="aLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['eLancamento'])){ if($permissoes['eLancamento'] == '1'){echo 'checked';}}?> name="eLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['dLancamento'])){ if($permissoes['dLancamento'] == '1'){echo 'checked';}}?> name="dLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Lançamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rLeitor'])){ if($permissoes['rLeitor'] == '1'){echo 'checked';}}?> name="rLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rReserva'])){ if($permissoes['rReserva'] == '1'){echo 'checked';}}?> name="rReserva" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Reserva</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rTeste'])){ if($permissoes['rTeste'] == '1'){echo 'checked';}}?> name="rTeste" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Teste</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rAcervo'])){ if($permissoes['rAcervo'] == '1'){echo 'checked';}}?> name="rAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Acervo</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rEmprestimo'])){ if($permissoes['rEmprestimo'] == '1'){echo 'checked';}}?> name="rEmprestimo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Emprestimo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['rFinanceiro'])){ if($permissoes['rFinanceiro'] == '1'){echo 'checked';}}?> name="rFinanceiro" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Financeiro</span>
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cUsuario'])){ if($permissoes['cUsuario'] == '1'){echo 'checked';}}?> name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cEmitente'])){ if($permissoes['cEmitente'] == '1'){echo 'checked';}}?> name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cPermissao'])){ if($permissoes['cPermissao'] == '1'){echo 'checked';}}?> name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input <?php if(isset($permissoes['cBackup'])){ if($permissoes['cBackup'] == '1'){echo 'checked';}}?> name="cBackup" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Backup</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

              
    
            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
                        <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                        <a href="<?php echo base_url() ?>index.php/permissoes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </div>
           
            </div>
        </div>

                   
    </div>

</form>

</div>


<script type="text/javascript" src="<?php echo base_url()?>assets/js/validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $("#marcarTodos").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });   

 
    $("#formPermissao").validate({
        rules :{
            nome: {required: true}
        },
        messages:{
            nome: {required: 'Campo obrigatório'}
        }
    });     

        

    });
</script>
