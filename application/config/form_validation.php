<?php
$config = array(
                'cursos' => array(array(
                                    'field'=>'nomeCurso',
                                    'label'=>'Nome do Curso',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'grupos' => array(array(
                                    'field'=>'nomeGrupo',
                                    'label'=>'Nome do Grpo',
                                    'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                    'field'=>'duracao_dias',
                                    'label'=>'Duração',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'qtde_max_item',
                                    'label'=>'Qtde Max de Itens',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'qtde_max_renovacao',
                                    'label'=>'Qtde Max de Renovação',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'qtde_max_reserva',
                                    'label'=>'Qtde Max de Reserva',
                                    'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                    'field'=>'validade_reserva',
                                    'label'=>'Validade da Reserva',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'multa',
                                    'label'=>'Valor da Multa',
                                    'rules'=>'required|trim|xss_clean|numeric'
                                ))								
                ,
                'tipoItem' => array(array(
                                    'field'=>'nomeTipoItem',
                                    'label'=>'Nome do Tipo',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'secao' => array(array(
                                    'field'=>'secao',
                                    'label'=>'Secao',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'colecao' => array(array(
                                    'field'=>'colecao',
                                    'label'=>'Colecao',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'editora' => array(array(
                                    'field'=>'editora',
                                    'label'=>'Editora',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'autor' => array(array(
                                    'field'=>'autor',
                                    'label'=>'Autor',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'servicos' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'descricao',
                                    'label'=>'',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'preco',
                                    'label'=>'',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'acervos' => array(array(
                                    'field'=>'titulo',
                                    'label'=>'titulo',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'tombo',
                                    'label'=>'tombo',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'estoque',
                                    'label'=>'Estoque',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'idioma',
                                    'label'=>'idioma',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'usuarios' => array(array(
                                    'field'=>'nome',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                
                                array(
                                    'field'=>'cpf',
                                    'label'=>'CPF',
                                    'rules'=>'required|trim|xss_clean|is_unique[usuarios.cpf]'
                                ),                               
                                array(
                                    'field'=>'email',
                                    'label'=>'Email',
                                    'rules'=>'required|trim|valid_email|xss_clean'
                                ),
                                array(
                                    'field'=>'senha',
                                    'label'=>'Senha',
                                    'rules'=>'required|trim|xss_clean|min_length[5]'
                                ),
                                array(
                                    'field'=>'telefone',
                                    'label'=>'Telefone',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,   
                'disciplinas' => array(array(
                                    'field'=>'nomeDisciplina',
                                    'label'=>'Nome',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,    
                'os' => array(array(
                                    'field'=>'dataInicial',
                                    'label'=>'DataInicial',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'dataFinal',
                                    'label'=>'DataFinal',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'garantia',
                                    'label'=>'Garantia',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'descricaoAcervo',
                                    'label'=>'DescricaoAcervo',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'defeito',
                                    'label'=>'Defeito',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'status',
                                    'label'=>'Status',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'observacoes',
                                    'label'=>'Observacoes',
                                    'rules'=>'trim|xss_clean'
                                ),
                                array(
                                    'field'=>'leitores_id',
                                    'label'=>'leitores',
                                    'rules'=>'trim|xss_clean|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|xss_clean|required'
                                ),
                                array(
                                    'field'=>'laudoTecnico',
                                    'label'=>'Laudo Tecnico',
                                    'rules'=>'trim|xss_clean'
                                ))

                  ,
				'tiposUsuario' => array(array(
                                	'field'=>'nomeTipo',
                                	'label'=>'NomeTipo',
                                	'rules'=>'required|trim|xss_clean'
                                ),
								array(
                                	'field'=>'situacao',
                                	'label'=>'Situacao',
                                	'rules'=>'required|trim|xss_clean'
                                ))

                ,
                'receita' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                        
                                array(
                                    'field'=>'leitor',
                                    'label'=>'Leitor',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'despesa' => array(array(
                                    'field'=>'descricao',
                                    'label'=>'Descrição',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'valor',
                                    'label'=>'Valor',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'vencimento',
                                    'label'=>'Data Vencimento',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'fornecedor',
                                    'label'=>'Fornecedor',
                                    'rules'=>'required|trim|xss_clean'
                                ),
                                array(
                                    'field'=>'tipo',
                                    'label'=>'Tipo',
                                    'rules'=>'required|trim|xss_clean'
                                ))
                ,
                'emprestimos' => array(array(

                                    'field' => 'dataEmprestimo',
                                    'label' => 'Data do Emprestimo',
                                    'rules' => 'required|trim|xss_clean'
                                ),
                                
                                array(
                                    'field'=>'leitor_id',
                                    'label'=>'Leitor',
                                    'rules'=>'trim|xss_clean|required'
                                ),
                                array(
                                    'field'=>'usuarios_id',
                                    'label'=>'usuarios_id',
                                    'rules'=>'trim|xss_clean|required'
                                ))
		);
			   