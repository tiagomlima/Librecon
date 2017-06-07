<?php
/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Acervos extends CI_Controller {
    
    
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('acervos_model', '', TRUE);
		$this->load->model('autor_model', '', TRUE);
		$this->load->model('editora_model', '', TRUE);
		$this->load->model('tipoItem_model', '', TRUE);
		$this->load->model('secao_model', '', TRUE);
		$this->load->model('grupos_model', '', TRUE);
		$this->load->model('colecao_model', '', TRUE);
		$this->load->model('reservas_model', '', TRUE);
		$this->load->model('autor_model', '', TRUE);
		$this->load->model('categoria_model', '', TRUE);
        $this->data['menuAcervos'] = 'Acervos';
		
		$this->data['categoria'] = $this->categoria_model->getActive('categoria','categoria.idCategoria,categoria.nomeCategoria');
		$this->data['grupo'] = $this->grupos_model->getById($this->session->userdata('grupo'));
        $this->data['autor'] = $this->autor_model->getActive('autor','autor.idAutor,autor.autor');
        $this->data['editora'] = $this->editora_model->getActive('editora','editora.idEditora,editora.editora');
        $this->data['tipoItem'] = $this->tipoItem_model->getActive('tipo_de_item','tipo_de_item.idTipoItem,tipo_de_item.nomeTipo');
        $this->data['secao'] = $this->secao_model->getActive('secao','secao.idSecao,secao.secao');
        $this->data['colecao'] = $this->colecao_model->getActive('colecao','colecao.idColecao,colecao.colecao');
		
		date_default_timezone_set('Brazil/East');
    }

    function index(){
	   $this->gerenciar();
    }

    function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar acervos.');
           redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/acervos/gerenciar/';
        $config['total_rows'] = $this->acervos_model->count('acervos');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	
		
		$this->data['autor'] = $this->autor_model->getActive('autor','autor.idAutor,autor.autor');
	    $this->data['results'] = $this->acervos_model->get('acervos','idAcervos,titulo,tombo,estoque,idioma,img_acervo,categoria_id,autor_id,tipoItem_id,secao_id,colecao_id,palavra_chave','',$config['per_page'],$this->uri->segment(3));       
	    $this->data['view'] = 'acervos/acervos';
       	$this->load->view('tema/topo',$this->data);
       
		
    }

	function do_upload(){

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }

    }
	
    function adicionar() {

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar acervos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('acervos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	
			if($this->input->post('userfile') == null){
				$img = base_url().'assets/uploads/img_default.jpg';
			} else {
				$image = $this->do_upload();
            	$img = base_url().'assets/uploads/'.$image;
			}
			
			$preco = $this->input->post('preco');
			if($preco != null){
				$preco = str_replace(",", ".", $preco);
			}
			$preco = 0;
			
			$secao_id = $this->input->post('secao_id');
			if($secao_id == null){
				$secao_id = NULL;
			}
			
			$colecao_id = $this->input->post('colecao_id');
			if($colecao_id == null){
				$colecao_id = NULL;
			}
							           
            $data = array(
                'titulo' => set_value('titulo'),
                'autor_id' => $this->input->post('autor_id'),
                'editora_id' => $this->input->post('editora_id'),
                'tipoItem_id' => $this->input->post('tipoItem_id'),
                'secao_id' => $secao_id,
                'colecao_id' => $colecao_id,
                'categoria_id' => $this->input->post('categoria_id'),
                'edicao' => set_value('edicao'),
                'classificacao' => set_value('classificacao'),
                'tombo' => set_value('tombo'),
                'palavra_chave' => $this->input->post('palavra_chave'),
                'estoque' => set_value('estoque'),
                'idioma' => set_value('idioma'),
                'descricao' => $this->input->post('descricao'),
                'dataAquisicao' => set_value('dataAquisicao'),
                'origemAquisicao' => set_value('origemAquisicao'),
                'observacaoAquisicao' => $this->input->post('observacaoAquisicao'),
                'preco' => $preco,
                'tabelaCutter' => set_value('tabelaCutter'),
                'isbn' => set_value('isbn'),
                'anoEdicao' => set_value('anoEdicao'),
                'numero_paginas' => set_value('numero_paginas'),               
                'img_acervo' => $img                
            );

            if ($this->acervos_model->add('acervos', $data,true) == TRUE) {         	
				
                $this->session->set_flashdata('success','Acervo adicionado com sucesso!');
                redirect(base_url() . 'index.php/acervos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
		
		
		
        $this->data['view'] = 'acervos/adicionarAcervo';
        $this->load->view('tema/topo', $this->data);
     
    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para editar acervos.');
           redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		 $this->form_validation->set_rules('isbn', 'ISBN', 'trim|required|xss_clean');

        if ($this->form_validation->run('acervos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	
			$preco = $this->input->post('preco');
			if($preco != null){
				$preco = str_replace(",", ".", $preco);
			}
			
			      		
            $data = array(
                'titulo' => $this->input->post('titulo'),
                'autor_id' => $this->input->post('autor_id'),
                'editora_id' => $this->input->post('editora_id'),
                'tipoItem_id' => $this->input->post('tipoItem_id'),
                'secao_id' => $this->input->post('secao_id'),
                'colecao_id' => $this->input->post('colecao_id'),
                'categoria_id' => $this->input->post('categoria_id'),
                'palavra_chave' => $this->input->post('palavra_chave'),
                'tombo' => $this->input->post('tombo'),
                'edicao' => $this->input->post('edicao'),
                'classificacao' => $this->input->post('classificacao'),
                'estoque' => $this->input->post('estoque'),
                'descricao' => $this->input->post('descricao'),
                'dataAquisicao' => $this->input->post('dataAquisicao'),
                'origemAquisicao' => $this->input->post('origemAquisicao'),
                'observacaoAquisicao' => $this->input->post('observacaoAquisicao'),
                'preco' => $preco,
                'tabelaCutter' => $this->input->post('tabelaCutter'),
                'isbn' => $this->input->post('isbn'),
                'anoEdicao' => $this->input->post('anoEdicao'),
                'numero_paginas' => $this->input->post('numero_paginas'),   
                'idioma' => $this->input->post('idioma')               
            );

            if ($this->acervos_model->edit('acervos', $data, 'idAcervos', $this->input->post('idAcervos')) == TRUE) {
                $this->session->set_flashdata('success','Acervo editado com sucesso!');
                redirect(base_url() . 'index.php/acervos/editar/'.$this->input->post('idAcervos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }
		
        $this->data['result'] = $this->acervos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'acervos/editarAcervo';
        $this->load->view('tema/topo', $this->data);
     
    }

	public function editarImg(){
        
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('index.php/librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para editar acervos.');
           redirect(base_url());
        }

        $id = $this->input->post('idAcervos');
        if($id == null || !is_numeric($id)){
           $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a imagem.');
           redirect(base_url().'index.php/acervos'); 
        }
        $this->load->helper('file');
        //delete_files(FCPATH .'assets/uploads/');

        $image = $this->do_upload();
        $img = base_url().'assets/uploads/'.$image;

        $retorno = $this->acervos_model->editImg($id, $img);
        if($retorno){

            $this->session->set_flashdata('success','A imagem foi alterada com sucesso !');
            redirect(base_url().'index.php/acervos/editar/'.$id);
        }
        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a imagem.');
            redirect(base_url().'index.php/acervos/editar/'.$id);
        }

    }


    function visualizar() {
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar acervos.');
           redirect(base_url());
        }

        $this->data['result'] = $this->acervos_model->getById($this->uri->segment(3));

        if($this->data['result'] == null){
            $this->session->set_flashdata('error','Acervo não encontrado.');
            redirect(base_url() . 'index.php/acervos/editar/'.$this->input->post('idAcervos'));
        }
		
		$this->data['emprestimos'] = $this->acervos_model->getEmprestimosByAcervo($this->uri->segment(3));
		$this->data['secao'] = $this->acervos_model->getSecaoById($this->uri->segment(3));
		$this->data['tipo'] = $this->acervos_model->getTipoById($this->uri->segment(3));
		$this->data['reservas'] = $this->acervos_model->getReservaByAcervo($this->uri->segment(3));
		$this->data['categoria'] = $this->acervos_model->getCategoriaById($this->uri->segment(3));
		$this->data['autor'] = $this->acervos_model->getAutorById($this->uri->segment(3));
		$this->data['editora'] = $this->acervos_model->getEditoraById($this->uri->segment(3));
		$this->data['colecao'] = $this->acervos_model->getColecaoById($this->uri->segment(3));
        $this->data['view'] = 'acervos/visualizarAcervo';
        $this->load->view('tema/topo', $this->data);
     
    }
	
    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir acervos.');
           redirect(base_url());
        }

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir acervo.');            
            redirect(base_url().'index.php/acervos/gerenciar/');
        }

        $this->db->where('acervos_id', $id);
        $this->db->delete('itens_de_emprestimos');
		
		$this->db->where('acervos_id', $id);
        $this->db->delete('itens_de_reserva');
        
        $this->acervos_model->delete('acervos','idAcervos',$id);             
        

        $this->session->set_flashdata('success','Acervo excluido com sucesso!');            
        redirect(base_url().'index.php/acervos/gerenciar/');
    }

	
	function reservar(){
		if($this->session->userdata('tipo_usuario') != 1){
			redirect('librecon');
		}
					
		$acervos_id = $this->input->post('acervos_id');
		$usuario_id = $this->input->post('usuario_id');
		
		$this->db->where('usuario_id',$usuario_id);
		$verificaReserva = $this->db->get('reserva')->row();
		
		$this->db->where('leitor_id',$usuario_id);
		$this->db->where('status != ','Devolvido');
		$emprestimo = $this->db->get('emprestimos')->row();
		
		//verifica se o leitor tem algum emprestimo pendente
		if(count($emprestimo) > 0){			
				$this->session->set_flashdata('error','Você não pode reservar acervos');            
        		redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
		}
		
		//verifica se ja existe uma reserva aberta pelo leitor
		if($verificaReserva != null){
			
			$this->db->where('acervos_id',$acervos_id);
			$this->db->where('reserva_id',$verificaReserva->idReserva);
			$acervo = $this->db->get('itens_de_reserva')->row();
			//verifica se o item ja esta na lista de reserva
			if($acervo != null){
				//se ja estiver,apresenta um erro
				$this->session->set_flashdata('error','O acervo ja se encontra na sua lista');            
        		redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
			}
			//verifica se o numero de itens por reserva passou de 3
			if($verificaReserva->qtde_item > 3){
				$this->session->set_flashdata('error','Limite de itens por reserva excedido. (limite: 3)');            
        		redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
			}else{				
				
				$data = array(
					'acervos_id' => $acervos_id,
					'reserva_id' => $verificaReserva->idReserva
				);
				
				if($this->reservas_model->add('itens_de_reserva',$data)){
					$this->db->where('idAcervos',$acervos_id);
					$getAcervo = $this->db->get('acervos')->row();
					$estoque = $getAcervo->estoque;
					//verifica se o acervo ta disponivel
					
					//marca o acervo como reservado									
					$this->db->query("UPDATE reserva set qtde_item = qtde_item + 1 WHERE idReserva = ".$verificaReserva->idReserva);
					
					$this->session->set_flashdata('success','Acervo adicionado na lista');            
        			redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
				} else {
					$this->session->set_flashdata('error','Erro ao adicionar o item na lista');            
        			redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
				}
			}
		} else {
			//se nao, inicia uma nova reserva
			$validade_reserva = $this->input->post('validade_reserva');
			$dataPrazo = date('Y-m-d h:i:s', strtotime("+".$validade_reserva." days"));
			
			$data = array(
				'usuario_id' => $usuario_id,
				'dataReserva' => date('Y-m-d H:i:s'),
				'dataPrazo' => $dataPrazo,
				'status' => 'Em andamento',
				'qtde_item' => 1
			);
			
			if(is_numeric($id = $this->acervos_model->add('reserva',$data,true))){
				//adiciona o acervo na lista de itens de reserva
				
				$data = array(
					'acervos_id' => $acervos_id,
					'reserva_id' => $id
				);
				
				if($this->reservas_model->add('itens_de_reserva',$data)){
					$this->session->set_flashdata('success','Reserva iniciada');            
        			redirect(base_url().'index.php/reservas/editar/'.$id);
				}else{
					$this->session->set_flashdata('error','Erro ao reservar');            
        			redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
				}
			}
		}			
		
	}
	
	function pesquisar(){
		
		$this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/acervos/gerenciar/';
        $config['total_rows'] = $this->acervos_model->count('acervos');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	
		
		$nome = $this->input->post('nome');
		$autor = $this->input->post('autor_id');
		$categoria = $this->input->post('categoria_id');
		$palavra_chave = $this->input->post('palavra_chave');
							
		$data['results'] = $this->acervos_model->pesquisar($nome,$autor,$categoria,$palavra_chave);
        $this->data['acervos'] = $data['results']['acervos'];
		$this->data['view'] = 'acervos/pesquisar';
        $this->load->view('tema/topo',  $this->data);
	}

}


