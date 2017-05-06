<div class="span12" style="margin-left: 0">
    <form action="<?php echo base_url();?>index.php/permissoes/adicionar" id="formPermissao" method="post">

    <div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-lock"></i>
                </span>
                <h5>Cadastro de Permissão</h5>
            </div>
            <div class="widget-content">
                
                <div class="span6">
                    <label>Nome da Permissão</label>
                    <input name="nome" type="text" id="nome" class="span12" />

                </div>
                <div class="span6">
                    <br/>
                    <label>
                        <input name="marcarTodos" type="checkbox" value="1" id="marcarTodos" />
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
                                            <input name="vLeitor" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Leitor</span>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="dLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Leitor</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vAcervo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Acervo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vCurso" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Curso</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dCurso" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Curso</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vGrupo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Grupo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dGrupo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Grupo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vDisciplina" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Disciplina</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dDisciplina" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Disciplina</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vAcervo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Acervo</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Acervo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Acervo</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vAutor" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Autor</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Autor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Autor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dAutor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Autor</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vEditora" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Editora</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Editora</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Editora</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dEditora" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Editora</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vTipoItem" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar TipoItem</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar TipoItem</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar TipoItem</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dTipoItem" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir TipoItem</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vSecao" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Seção</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Seção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Seção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dSecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Seção</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vColecao" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Coleção</span>
                                        </label>
                                    </td>
                                   <td>
                                        <label>
                                            <input name="aColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Coleção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Coleção</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dColecao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Coleção</span>
                                        </label>
                                    </td>

                                </tr>
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vServico" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Serviço</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vOs" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir OS</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                 
                                <tr><td colspan="4"></td></tr>
                                
                                <tr>

                                    <td>
                                        <label>
                                            <input name="vVenda" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Venda</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vArquivo" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Arquivo</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dArquivo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Arquivo</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="vLancamento" class="marcar" type="checkbox" checked="checked" value="1" />
                                            <span class="lbl"> Visualizar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="aLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Adicionar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="eLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Editar Lançamento</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="dLancamento" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Excluir Lançamento</span>
                                        </label>
                                    </td>
                                 
                                </tr>
                                

                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="rLeitor" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Leitor</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rServico" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Serviço</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rOs" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório OS</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rAcervo" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Acervo</span>
                                        </label>
                                    </td>
                                 
                                </tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="rVenda" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Venda</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="rFinanceiro" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Relatório Financeiro</span>
                                        </label>
                                    </td>
                                    <td colspan="2"></td>
                                 
                                </tr>
                                <tr><td colspan="4"></td></tr>

                                <tr>

                                    <td>
                                        <label>
                                            <input name="cUsuario" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Usuário</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cEmitente" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Emitente</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cPermissao" class="marcar" type="checkbox" value="1" />
                                            <span class="lbl"> Configurar Permissão</span>
                                        </label>
                                    </td>

                                    <td>
                                        <label>
                                            <input name="cBackup" class="marcar" type="checkbox" value="1" />
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
                        <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
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
