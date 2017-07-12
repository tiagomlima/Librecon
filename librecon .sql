-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Jun-2017 às 14:48
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librecon`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervos`
--

CREATE TABLE `acervos` (
  `idAcervos` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `idioma` varchar(30) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `editora_id` int(11) NOT NULL,
  `tipoItem_id` int(11) NOT NULL,
  `colecao_id` int(11) DEFAULT NULL,
  `secao_id` int(11) DEFAULT NULL,
  `categoria_id` int(2) NOT NULL,
  `img_acervo` varchar(255) DEFAULT NULL,
  `descricao` text,
  `status` varchar(20) DEFAULT NULL,
  `palavra_chave` varchar(120) DEFAULT NULL,
  `dataAquisicao` date NOT NULL,
  `origemAquisicao` varchar(100) NOT NULL,
  `observacaoAquisicao` varchar(200) NOT NULL,
  `preco` double DEFAULT NULL,
  `tabelaCutter` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `anoEdicao` varchar(5) NOT NULL,
  `numero_paginas` int(6) NOT NULL,
  `edicao` varchar(50) DEFAULT NULL,
  `classificacao` varchar(100) NOT NULL,
  `estoque` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE `autor` (
  `idAutor` int(11) NOT NULL,
  `autor` varchar(55) NOT NULL,
  `descricao` text NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(2) NOT NULL,
  `nomeCategoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d9fb32e97eff676e28b667a0adc7da60', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36', 1497278466, 'a:8:{s:9:"user_data";s:0:"";s:4:"nome";s:5:"admin";s:2:"id";s:1:"1";s:9:"permissao";s:1:"1";s:6:"logado";b:1;s:12:"tipo_usuario";s:1:"0";s:5:"grupo";N;s:15:"flash:old:error";s:23:"O leitor está multado.";}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colecao`
--

CREATE TABLE `colecao` (
  `idColecao` int(11) NOT NULL,
  `colecao` varchar(55) NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `idCursos` int(11) NOT NULL,
  `nomeCurso` varchar(80) NOT NULL,
  `dataCadastro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `idDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(100) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `idDocumentos` int(11) NOT NULL,
  `documento` varchar(70) DEFAULT NULL,
  `descricao` text,
  `file` varchar(100) DEFAULT NULL,
  `path` varchar(300) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `cadastro` date DEFAULT NULL,
  `categoria` varchar(80) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT NULL,
  `tamanho` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE `editora` (
  `idEditora` int(11) NOT NULL,
  `editora` varchar(55) NOT NULL,
  `email_editora` varchar(55) NOT NULL,
  `site` varchar(55) NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emitente`
--

CREATE TABLE `emitente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `ie` varchar(50) DEFAULT NULL,
  `rua` varchar(70) DEFAULT NULL,
  `numero` varchar(15) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `uf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `url_logo` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emitente`
--

INSERT INTO `emitente` (`id`, `nome`, `cnpj`, `ie`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `telefone`, `site`, `url_logo`) VALUES
(2, 'FATEC Itapira', '71.654.108/0001-46', 'teste', 'Rua Tereza Lera Paoletti', '570', 'Jardim Bela Vista', 'Itapira', 'SP', '(19) 3843-1996', 'http://fatecitapira.edu.br/', 'http://localhost/librecon/assets/uploads/41d028c23123fb716034cc40f2e3f48f.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `idEmprestimos` int(11) NOT NULL,
  `dataEmprestimo` date NOT NULL,
  `dataDevolucao` date DEFAULT NULL,
  `dataVencimento` date NOT NULL,
  `leitor_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `qtde_item` int(2) NOT NULL,
  `qtde_renovacao` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exemplares`
--

CREATE TABLE `exemplares` (
  `idExemplar` int(11) NOT NULL,
  `tombo` varchar(20) NOT NULL,
  `acervos_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` int(11) NOT NULL,
  `nomeGrupo` varchar(80) NOT NULL,
  `duracao_dias` int(4) NOT NULL,
  `qtde_max_item` int(3) NOT NULL,
  `qtde_max_renovacao` int(3) NOT NULL,
  `qtde_max_reserva` int(3) NOT NULL,
  `validade_reserva` int(2) NOT NULL,
  `multa` int(3) NOT NULL,
  `observacoes` text NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `nomeGrupo`, `duracao_dias`, `qtde_max_item`, `qtde_max_renovacao`, `qtde_max_reserva`, `validade_reserva`, `multa`, `observacoes`, `dataCadastro`) VALUES
(1, 'Leitor Comum', 7, 4, 1, 3, 7, 5, 'Cadastro de teste', '2017-04-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_de_emprestimos`
--

CREATE TABLE `itens_de_emprestimos` (
  `idItens` int(11) NOT NULL,
  `emprestimos_id` int(11) NOT NULL,
  `acervos_id` int(11) NOT NULL,
  `exemplar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_de_reserva`
--

CREATE TABLE `itens_de_reserva` (
  `idItem` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `acervos_id` int(11) NOT NULL,
  `exemplar_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `links`
--

CREATE TABLE `links` (
  `idLink` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `idPermissao` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `permissoes` text,
  `situacao` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`idPermissao`, `nome`, `permissoes`, `situacao`, `data`) VALUES
(1, 'Administrador', 'a:67:{s:6:"aCurso";s:1:"1";s:6:"eCurso";s:1:"1";s:6:"dCurso";s:1:"1";s:6:"vCurso";s:1:"1";s:11:"aDisciplina";s:1:"1";s:11:"eDisciplina";s:1:"1";s:11:"dDisciplina";s:1:"1";s:11:"vDisciplina";s:1:"1";s:6:"aGrupo";s:1:"1";s:6:"eGrupo";s:1:"1";s:6:"dGrupo";s:1:"1";s:6:"vGrupo";s:1:"1";s:7:"aLeitor";s:1:"1";s:7:"eLeitor";s:1:"1";s:7:"dLeitor";s:1:"1";s:7:"vLeitor";s:1:"1";s:7:"aAcervo";s:1:"1";s:7:"eAcervo";s:1:"1";s:7:"dAcervo";s:1:"1";s:7:"vAcervo";s:1:"1";s:6:"aAutor";s:1:"1";s:6:"eAutor";s:1:"1";s:6:"dAutor";s:1:"1";s:6:"vAutor";s:1:"1";s:5:"aLink";s:1:"1";s:5:"eLink";s:1:"1";s:5:"dLink";s:1:"1";s:5:"vLink";s:1:"1";s:8:"aEditora";s:1:"1";s:8:"eEditora";s:1:"1";s:8:"dEditora";s:1:"1";s:8:"vEditora";s:1:"1";s:9:"aTipoItem";s:1:"1";s:9:"eTipoItem";s:1:"1";s:9:"dTipoItem";s:1:"1";s:9:"vTipoItem";s:1:"1";s:10:"aCategoria";s:1:"1";s:10:"eCategoria";s:1:"1";s:10:"dCategoria";s:1:"1";s:10:"vCategoria";s:1:"1";s:6:"aSecao";s:1:"1";s:6:"eSecao";s:1:"1";s:6:"dSecao";s:1:"1";s:6:"vSecao";s:1:"1";s:8:"aColecao";s:1:"1";s:8:"eColecao";s:1:"1";s:8:"dColecao";s:1:"1";s:8:"vColecao";s:1:"1";s:8:"aReserva";s:1:"1";s:8:"eReserva";s:1:"1";s:8:"dReserva";s:1:"1";s:8:"vReserva";s:1:"1";s:11:"aEmprestimo";s:1:"1";s:11:"eEmprestimo";s:1:"1";s:11:"dEmprestimo";s:1:"1";s:11:"vEmprestimo";s:1:"1";s:8:"aArquivo";s:1:"1";s:8:"eArquivo";s:1:"1";s:8:"dArquivo";s:1:"1";s:8:"vArquivo";s:1:"1";s:8:"cUsuario";s:1:"1";s:9:"cEmitente";s:1:"1";s:10:"cPermissao";s:1:"1";s:7:"cBackup";s:1:"1";s:7:"rLeitor";s:1:"1";s:7:"rAcervo";s:1:"1";s:11:"rEmprestimo";s:1:"1";}', 1, '2014-09-03'),
(2, 'Leitor', 'a:67:{s:6:"aCurso";b:0;s:6:"eCurso";b:0;s:6:"dCurso";b:0;s:6:"vCurso";b:0;s:11:"aDisciplina";b:0;s:11:"eDisciplina";b:0;s:11:"dDisciplina";b:0;s:11:"vDisciplina";b:0;s:6:"aGrupo";b:0;s:6:"eGrupo";b:0;s:6:"dGrupo";b:0;s:6:"vGrupo";b:0;s:7:"aLeitor";b:0;s:7:"eLeitor";b:0;s:7:"dLeitor";b:0;s:7:"vLeitor";b:0;s:7:"aAcervo";b:0;s:7:"eAcervo";b:0;s:7:"dAcervo";b:0;s:7:"vAcervo";s:1:"1";s:6:"aAutor";b:0;s:6:"eAutor";b:0;s:6:"dAutor";b:0;s:6:"vAutor";b:0;s:5:"aLink";b:0;s:5:"eLink";b:0;s:5:"dLink";b:0;s:5:"vLink";s:1:"1";s:8:"aEditora";b:0;s:8:"eEditora";b:0;s:8:"dEditora";b:0;s:8:"vEditora";b:0;s:9:"aTipoItem";b:0;s:9:"eTipoItem";b:0;s:9:"dTipoItem";b:0;s:9:"vTipoItem";b:0;s:10:"aCategoria";b:0;s:10:"eCategoria";b:0;s:10:"dCategoria";b:0;s:10:"vCategoria";b:0;s:6:"aSecao";b:0;s:6:"eSecao";b:0;s:6:"dSecao";b:0;s:6:"vSecao";b:0;s:8:"aColecao";b:0;s:8:"eColecao";b:0;s:8:"dColecao";b:0;s:8:"vColecao";b:0;s:8:"aReserva";b:0;s:8:"eReserva";s:1:"1";s:8:"dReserva";b:0;s:8:"vReserva";s:1:"1";s:11:"aEmprestimo";b:0;s:11:"eEmprestimo";b:0;s:11:"dEmprestimo";b:0;s:11:"vEmprestimo";s:1:"1";s:8:"aArquivo";b:0;s:8:"eArquivo";b:0;s:8:"dArquivo";b:0;s:8:"vArquivo";b:0;s:8:"cUsuario";b:0;s:9:"cEmitente";b:0;s:10:"cPermissao";b:0;s:7:"cBackup";b:0;s:7:"rLeitor";b:0;s:7:"rAcervo";b:0;s:11:"rEmprestimo";b:0;}', 1, '2017-04-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `dataReserva` datetime NOT NULL,
  `dataPrazo` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `qtde_item` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao`
--

CREATE TABLE `secao` (
  `idSecao` int(11) NOT NULL,
  `secao` varchar(55) NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `secao`
--

INSERT INTO `secao` (`idSecao`, `secao`, `dataCadastro`) VALUES
(1, '10', '2017-06-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_de_item`
--

CREATE TABLE `tipo_de_item` (
  `idTipoItem` int(11) NOT NULL,
  `nomeTipo` varchar(55) NOT NULL,
  `dataCadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_de_item`
--

INSERT INTO `tipo_de_item` (`idTipoItem`, `nomeTipo`, `dataCadastro`) VALUES
(1, 'Livro', '2017-05-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `tipo_usuario` tinyint(1) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `datanasc` date DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `matricula` varchar(100) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `rua` varchar(80) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `bairro` varchar(75) DEFAULT NULL,
  `cidade` varchar(75) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `observacoes` varchar(200) DEFAULT NULL,
  `situacao` varchar(20) DEFAULT NULL,
  `dataCadastro` date NOT NULL,
  `permissoes_id` int(11) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `img_leitor` varchar(255) DEFAULT NULL,
  `dataMulta` datetime DEFAULT NULL,
  `multa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `tipo_usuario`, `nome`, `datanasc`, `cpf`, `matricula`, `email`, `senha`, `telefone`, `celular`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `sexo`, `observacoes`, `situacao`, `dataCadastro`, `permissoes_id`, `grupo_id`, `curso_id`, `img_leitor`, `dataMulta`, `multa`) VALUES
(1, 0, 'admin', NULL, '000.000.00-00', NULL, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '(xx)0000-0000', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2017-05-28', 1, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acervos`
--
ALTER TABLE `acervos`
  ADD PRIMARY KEY (`idAcervos`),
  ADD KEY `fk_acervos_autor1` (`autor_id`),
  ADD KEY `fk_acervos_editora1` (`editora_id`),
  ADD KEY `fk_acervos_tipoItem1` (`tipoItem_id`),
  ADD KEY `fk_acervos_categoria` (`categoria_id`),
  ADD KEY `fk_acervos_secao1` (`secao_id`),
  ADD KEY `fk_acervos_colecao1` (`colecao_id`);

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `colecao`
--
ALTER TABLE `colecao`
  ADD PRIMARY KEY (`idColecao`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCursos`);

--
-- Indexes for table `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`idDisciplina`),
  ADD KEY `fk_disciplinas_curso_idx` (`curso_id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`idDocumentos`);

--
-- Indexes for table `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`idEditora`);

--
-- Indexes for table `emitente`
--
ALTER TABLE `emitente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`idEmprestimos`),
  ADD KEY `fk_emprestimos_usuarios1` (`usuarios_id`),
  ADD KEY `fk_emprestimos_grupos1` (`grupo_id`);

--
-- Indexes for table `exemplares`
--
ALTER TABLE `exemplares`
  ADD PRIMARY KEY (`idExemplar`),
  ADD KEY `fk_exemplares_acervo` (`acervos_id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `itens_de_emprestimos`
--
ALTER TABLE `itens_de_emprestimos`
  ADD PRIMARY KEY (`idItens`),
  ADD KEY `fk_itens_de_emprestimos_acervos1` (`acervos_id`),
  ADD KEY `fk_itens_de_emprestimos1` (`emprestimos_id`),
  ADD KEY `fk_itens_de_emprestimos_exemplar` (`exemplar_id`);

--
-- Indexes for table `itens_de_reserva`
--
ALTER TABLE `itens_de_reserva`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `fk_itens_de_reserva_reserva` (`reserva_id`),
  ADD KEY `fk_itens_de_reserva_acervos` (`acervos_id`),
  ADD KEY `fk_itens_de_reserva_exemplar` (`exemplar_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`idLink`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`idPermissao`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_reserva_usuario_idx` (`usuario_id`);

--
-- Indexes for table `secao`
--
ALTER TABLE `secao`
  ADD PRIMARY KEY (`idSecao`);

--
-- Indexes for table `tipo_de_item`
--
ALTER TABLE `tipo_de_item`
  ADD PRIMARY KEY (`idTipoItem`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `fk_usuarios_permissoes1_idx` (`permissoes_id`),
  ADD KEY `fk_usuarios_curso_idx` (`curso_id`),
  ADD KEY `fk_usuarios_grupo_idx` (`grupo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acervos`
--
ALTER TABLE `acervos`
  MODIFY `idAcervos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `colecao`
--
ALTER TABLE `colecao`
  MODIFY `idColecao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCursos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `idDisciplina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `idDocumentos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
  MODIFY `idEditora` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emitente`
--
ALTER TABLE `emitente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `idEmprestimos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exemplares`
--
ALTER TABLE `exemplares`
  MODIFY `idExemplar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `itens_de_emprestimos`
--
ALTER TABLE `itens_de_emprestimos`
  MODIFY `idItens` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `itens_de_reserva`
--
ALTER TABLE `itens_de_reserva`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `idLink` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `idPermissao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secao`
--
ALTER TABLE `secao`
  MODIFY `idSecao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipo_de_item`
--
ALTER TABLE `tipo_de_item`
  MODIFY `idTipoItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `acervos`
--
ALTER TABLE `acervos`
  ADD CONSTRAINT `fk_acervos_autor1` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`idAutor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acervos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acervos_colecao1` FOREIGN KEY (`colecao_id`) REFERENCES `colecao` (`idColecao`),
  ADD CONSTRAINT `fk_acervos_editora1` FOREIGN KEY (`editora_id`) REFERENCES `editora` (`idEditora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acervos_secao1` FOREIGN KEY (`secao_id`) REFERENCES `secao` (`idSecao`),
  ADD CONSTRAINT `fk_acervos_tipoItem1` FOREIGN KEY (`tipoItem_id`) REFERENCES `tipo_de_item` (`idTipoItem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `fk_disciplinas_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`idCursos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `fk_emprestimos_grupos1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `itens_de_emprestimos`
--
ALTER TABLE `itens_de_emprestimos`
  ADD CONSTRAINT `fk_itens_de_emprestimos_acervos1` FOREIGN KEY (`acervos_id`) REFERENCES `acervos` (`idAcervos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itens_de_emprestimos_emprestimos1` FOREIGN KEY (`emprestimos_id`) REFERENCES `emprestimos` (`idEmprestimos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_itens_de_emprestimos_exemplar` FOREIGN KEY (`exemplar_id`) REFERENCES `exemplares` (`idExemplar`);

--
-- Limitadores para a tabela `itens_de_reserva`
--
ALTER TABLE `itens_de_reserva`
  ADD CONSTRAINT `fk_itens_de_reserva_exemplar` FOREIGN KEY (`exemplar_id`) REFERENCES `exemplares` (`idExemplar`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`idCursos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_grupo` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_permissoes1` FOREIGN KEY (`permissoes_id`) REFERENCES `permissoes` (`idPermissao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
