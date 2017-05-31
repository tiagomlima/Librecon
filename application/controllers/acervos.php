<?php

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
        $this->data['menuAcervos'] = 'Acervos';
		
		$this->data['grupo'] = $this->grupos_model->getById($this->session->userdata('grupo'));
        $this->data['autor'] = $this->autor_model->getActive('autor','autor.idAutor,autor.autor');
        $this->data['editora'] = $this->editora_model->getActive('editora','editora.idEditora,editora.editora');
        $this->data['tipoItem'] = $this->tipoItem_model->getActive('tipo_de_item','tipo_de_item.idTipoItem,tipo_de_item.nomeTipo');
        $this->data['secao'] = $this->secao_model->getActive('secao','secao.idSecao,secao.secao');
        $this->data['colecao'] = $this->colecao_model->getActive('colecao','colecao.idColecao,colecao.colecao');
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

	    $this->data['results'] = $this->acervos_model->get('acervos','idAcervos,titulo,tombo,estoque,idioma,img_acervo','',$config['per_page'],$this->uri->segment(3));
        $this->data['autor'] = $this->acervos_model->getAutor($config['per_page'],$this->uri->segment(3));
		$this->data['editora'] = $this->acervos_model->getEditora($config['per_page'],$this->uri->segment(3));
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
        				
			$image = $this->do_upload();
            $img = base_url().'assets/uploads/'.$image;
            
            $data = array(
                'titulo' => set_value('titulo'),
                'autor_id' => $this->input->post('autor_id'),
                'editora_id' => $this->input->post('editora_id'),
                'tipoItem_id' => $this->input->post('tipoItem_id'),
                'secao_id' => $this->input->post('secao_id'),
                'colecao_id' => $this->input->post('colecao_id'),
                'tombo' => set_value('tombo'),
                'estoque' => set_value('estoque'),
                'idioma' => set_value('idioma'),
                'img_acervo' => $img                
            );

            if ($this->acervos_model->add('acervos', $data) == TRUE) {
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

        if ($this->form_validation->run('acervos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	      		
            $data = array(
                'titulo' => $this->input->post('titulo'),
                'autor_id' => $this->input->post('autor_id'),
                'editora_id' => $this->input->post('editora_id'),
                'tipoItem_id' => $this->input->post('tipoItem_id'),
                'secao_id' => $this->input->post('secao_id'),
                'colecao_id' => $this->input->post('colecao_id'),
                'tombo' => $this->input->post('tombo'),
                'estoque' => $this->input->post('estoque'),
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
						
		$verificaReserva = $this->reservas_model->getReservaById($usuario_id);
		
		if(count($verificaReserva) > 0){
			
			$verificaRetirado = $this->reservas_model->getReservaRetirado($verificaReserva->idReserva); 
												
			$verificaAcervo = $this->acervos_model->verificaAcervo($verificaReserva->idReserva,$acervos_id);

			if(count($verificaAcervo) > 0){
				$this->session->set_flashdata('error','Esse item já se encontra na sua lista de reserva.');            
        		redirect(base_url().'index.php/acervos/visualizar/'.$acervos_id);
			}			
									
			$data = array(
				'reserva_id' => $verificaReserva->idReserva,
				'acervos_id' => $acervos_id
			);
			
			$this->acervos_model->add('itens_de_reserva',$data);
			
			$addQtde = "UPDATE reserva set qtde_item = qtde_item + 1 WHERE idReserva = ".$verificaReserva->idReserva;
			$this->db->query($addQtde,array($verificaReserva->idReserva));
			
			$delEstoque = "UPDATE acervos set estoque = estoque -1 WHERE idAcervos = ".$acervos_id;
			$this->db->query($delEstoque,array($acervos_id));
			
			$this->session->set_flashdata('success','Item adicionado na lista de reserva');            
        	redirect(base_url().'index.php/reservas/editar/'.$verificaReserva->idReserva);
			
		} else {		
		
		$validade_reserva = $this->input->post('validade_reserva');
		$dataPrazo = date('Y-m-d', strtotime("+".$validade_reserva." days"));
		$data = array(
			'dataPrazo' => $dataPrazo,
			'dataReserva' => date('Y-m-d'),
			'usuario_id' => $usuario_id,
			'qtde_item' => 1	
		);
							
		if(is_numeric($id = $this->acervos_model->add('reserva',$data,true))){
			$sql = "UPDATE acervos set estoque = estoque -1 WHERE idAcervos = ".$acervos_id;
			$this->db->query($sql,array($acervos_id));
			
			$status = "UPDATE reserva set status = 'Em andamento' WHERE usuario_id = ".$usuario_id;
			$this->db->query($status,array($usuario_id));
			
			$data2 = array(
				'reserva_id' => $id,
				'acervos_id' => $acervos_id
			);
			
			$this->acervos_model->add('itens_de_reserva',$data2);
			
			$this->session->set_flashdata('success','Reserva iniciada com sucesso!');            
        	redirect(base_url().'index.php/reservas/editar/'.$id);
		}else{
			$this->session->set_flashdata('error','Não foi possivel reservar o acervo.');            
        	redirect(base_url().'index.php/acervos/gerenciar/');
		}		
	  }
	}
}

