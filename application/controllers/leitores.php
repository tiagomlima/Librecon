<?php

class Leitores extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
			$this->load->model('usuarios_model', '', TRUE);
            $this->load->helper(array('codegen_helper'));
            $this->load->model('leitores_model','',TRUE);
            $this->data['menuLeitores'] = 'leitores';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar leitores.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/leitores/gerenciar/';
        $config['total_rows'] = $this->leitores_model->count('usuarios');
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
        
	    $this->data['results'] = $this->leitores_model->get('usuarios','idUsuarios,nome,cpf,datanasc,sexo,situacao,matricula,telefone,celular,email,rua,numero,bairro,cidade,estado,cep','',$config['per_page'],$this->uri->segment(3));       	
		$this->data['curso'] = $this->leitores_model->getCurso($config['per_page'],$this->uri->segment(3));
		$this->data['grupo'] = $this->leitores_model->getGrupo($config['per_page'],$this->uri->segment(3));
		$this->data['permissoes'] = $this->leitores_model->getPermissao($config['per_page'],$this->uri->segment(3));
       	$this->data['view'] = 'leitores/leitores';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	   
    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar leitores.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->leitores_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->leitores_model->getEmprestimosByLeitor($this->uri->segment(3));
		$this->data['curso'] = $this->leitores_model->getCursoById($this->uri->segment(3));
		$this->data['grupo'] = $this->leitores_model->getGrupoById($this->uri->segment(3));
        $this->data['view'] = 'leitores/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }

	function adicionar(){  
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar leitores.');
           redirect(base_url());
        }
  
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
		
		//confere se a confirmação de senha bate com a senha digitada
		$senha = $this->input->post('senha'); 
		$senhaConfirm = $this->input->post('senhaConfirm');
        if($senha == $senhaConfirm){
        // se sim, prossegue com a inserção dos dados
		
        if ($this->form_validation->run('usuarios') == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else
        {     

            $this->load->library('encrypt');                       
            $data = array(
                    'nome' => set_value('nome'),
	                'tipo_usuario' => $this->input->post('tipo_usuario'),
	                'cpf' => set_value('cpf'),
	                'telefone' => set_value('telefone'),
	                'datanasc' => $this->input->post('datanasc'),
	                'celular' => $this->input->post('celular'),
	                'matricula' => set_value('matricula'),
	                'email' => set_value('email'),
	                'rua' => set_value('rua'),
	                'numero' => set_value('numero'),
	                'bairro' => set_value('bairro'),
	                'cidade' => set_value('cidade'),
	                'estado' => set_value('estado'),
	                'cep' => set_value('cep'),
	                'sexo' => $this->input->post('sexo'),
	                'situacao' => $this->input->post('situacao'),
	                'senha' => $this->encrypt->sha1($this->input->post('senha')),
	                'observacoes' => set_value('observacoes'),
	                'curso_id' => $this->input->post('curso_id'),
	                'grupo_id' => $this->input->post('grupo_id'),
	                'permissoes_id' => $this->input->post('permissoes_id'),
	                'dataCadastro' => date('Y-m-d')
					
            );
           
			if ($this->usuarios_model->add('usuarios',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Leitor cadastrado com sucesso!');
				redirect(base_url().'index.php/leitores/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}
	
        $this->load->model('cursos_model');
        $this->data['cursos'] = $this->cursos_model->getActive('cursos','cursos.idCursos,cursos.nomeCurso');
		$this->load->model('grupos_model');
        $this->data['grupos'] = $this->grupos_model->getActive('grupos','grupos.idGrupo,grupos.nomeGrupo');
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome');   
		$this->data['view'] = 'leitores/adicionarLeitor';
        $this->load->view('tema/topo',$this->data);
   		
		}else{
			$this->session->set_flashdata('error','A senha digitada não confere com a confirmação');
			redirect(base_url() . 'index.php/leitores/adicionar/');
		}          
    }

	function editar(){  
           
        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|xss_clean');
		
		
		 if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para editar leitores.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		
        if ($this->form_validation->run() == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 


            $senha = $this->input->post('senha'); 
            if($senha != null){
                $this->load->library('encrypt');   
                $senha = $this->encrypt->sha1($senha);

                $data = array(
                'nome' => $this->input->post('nomeLeitor'),
                'cpf' => $this->input->post('cpf'),
                'telefone' => $this->input->post('telefone'),
                'celular' => $this->input->post('celular'),
                'datanasc' => $this->input->post('datanasc'),
                'email' => $this->input->post('email'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado'),
                'matricula' => $this->input->post('matricula'),
                'sexo' => $this->input->post('sexo'),
                'situacao' => $this->input->post('situacao'),
                'senha' => $senha,
                'observacoes' => $this->input->post('observacoes'),
                'curso_id' => $this->input->post('curso_id'),
	            'grupo_id' => $this->input->post('grupo_id'),
                'cep' => $this->input->post('cep')
                );
            }  

            else{

                $data = array(
                'nome' => $this->input->post('nomeLeitor'),
                'cpf' => $this->input->post('cpf'),
                'telefone' => $this->input->post('telefone'),
                'celular' => $this->input->post('celular'),
                'datanasc' => $this->input->post('datanasc'),
                'email' => $this->input->post('email'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado'),
                'matricula' => $this->input->post('matricula'),
                'sexo' => $this->input->post('sexo'),
                'situacao' => $this->input->post('situacao'),
                'senha' => $senha,
                'observacoes' => $this->input->post('observacoes'),
                'curso_id' => $this->input->post('curso_id'),
	            'grupo_id' => $this->input->post('grupo_id'),
                'cep' => $this->input->post('cep')
                );

            }  

           
			if ($this->usuarios_model->edit('usuarios',$data,'idUsuarios',$this->input->post('idUsuarios')) == TRUE)
			{
                $this->session->set_flashdata('success','Leitor editado com sucesso!');
				redirect(base_url().'index.php/leitores/editar/'.$this->input->post('idUsuarios'));
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

			}
		}

		$this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome'); 
		$this->load->model('cursos_model');
        $this->data['cursos'] = $this->cursos_model->getActive('cursos','cursos.idCursos,cursos.nomeCurso');
		$this->load->model('grupos_model');
        $this->data['grupos'] = $this->grupos_model->getActive('grupos','grupos.idGrupo,grupos.nomeGrupo');
		$this->data['view'] = 'leitores/editarLeitor';
        $this->load->view('tema/topo',$this->data);
			
      
    }	

	 public function excluir(){
            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dLeitor')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir leitores.');
               redirect(base_url());
            }
            
            $id =  $this->input->post('idUsuarios');
            if ($id == null){
                $this->session->set_flashdata('error','Erro ao tentar excluir Leitor.');            
                redirect(base_url().'index.php/leitores/gerenciar/');
            }
            
            // excluindo emprestimos vinculados ao Leitor
            $this->db->where('leitor_id', $id);
            $emprestimos = $this->db->get('emprestimos')->result();
            if($emprestimos != null){
                foreach ($emprestimos as $e) {
                    $this->db->where('emprestimos_id', $e->idEmprestimos);
                    $this->db->delete('itens_de_emprestimos');
                    $this->db->where('idVendas', $e->idEmprestimos);
                    $this->db->delete('emprestimos');
                }
            }          
			
            $this->leitores_model->delete('usuarios','idUsuarios',$id); 
            $this->session->set_flashdata('success','Leitor excluido com sucesso!');            
            redirect(base_url().'index.php/leitores/gerenciar/');
    }
}

