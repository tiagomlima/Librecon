<?php

class Usuarios extends CI_Controller {
    

    
    
    function __construct() {

        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cUsuario')){
          $this->session->set_flashdata('error','Você não tem permissão para configurar os usuários.');
          redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('usuarios_model', '', TRUE);
        $this->data['menuUsuarios'] = 'Usuários';
        $this->data['menuConfiguracoes'] = 'Configurações';
    }

    function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        $this->load->library('pagination');
        

        $config['base_url'] = base_url().'index.php/usuarios/gerenciar/';
        $config['total_rows'] = $this->usuarios_model->count('usuarios');
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

		$this->data['results'] = $this->usuarios_model->get($config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'usuarios/usuarios';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar(){  
          
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
					'email' => set_value('email'),
					'senha' => $this->encrypt->sha1($this->input->post('senha')),
					'telefone' => set_value('telefone'),
					'celular' => set_value('celular'),
					'situacao' => $this->input->post('situacao'),
                    'permissoes_id' => $this->input->post('permissoes_id'),
					'dataCadastro' => date('Y-m-d')
					
            );
           
			if ($this->usuarios_model->add('usuarios',$data) == TRUE)
			{
                                $this->session->set_flashdata('success','Usuário cadastrado com sucesso!');
				redirect(base_url().'index.php/usuarios/adicionar/');
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

			}
		}
        
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome');   
		$this->data['view'] = 'usuarios/adicionarUsuario';
        $this->load->view('tema/topo',$this->data);
   		
		//se não, apresenta um erro
		}else{
			$this->session->set_flashdata('error','A senha digitada não confere com a confirmação');
			redirect(base_url() . 'index.php/usuarios/adicionar/');
		}
    
       
    }	
    
    function editar(){  
        
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        $this->load->library('form_validation');    
		$this->data['custom_error'] = '';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required|xss_clean');
        $this->form_validation->set_rules('permissoes_id', 'Permissão', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false)
        {
             $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else
        { 

            if ($this->input->post('idUsuarios') == 1 && $this->input->post('situacao') == 0)
            {
                $this->session->set_flashdata('error','O usuário super admin não pode ser desativado!');
                redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('idUsuarios'));
            }

            $senha = $this->input->post('senha'); 
            if($senha != null){
                $this->load->library('encrypt');   
                $senha = $this->encrypt->sha1($senha);

                $data = array(
                        'nome' => $this->input->post('nome'),
                        'cpf' => $this->input->post('cpf'),
                        'email' => $this->input->post('email'),
                        'senha' => $senha,
                        'telefone' => $this->input->post('telefone'),
                        'celular' => $this->input->post('celular'),
                        'situacao' => $this->input->post('situacao'),
                        'permissoes_id' => $this->input->post('permissoes_id')
                );
            }  

            else{

                $data = array(
                        'nome' => $this->input->post('nome'),
                        'cpf' => $this->input->post('cpf'),
                        'email' => $this->input->post('email'),
                        'telefone' => $this->input->post('telefone'),
                        'celular' => $this->input->post('celular'),
                        'situacao' => $this->input->post('situacao'),
                        'permissoes_id' => $this->input->post('permissoes_id')
                );

            }  

           
			if ($this->usuarios_model->edit('usuarios',$data,'idUsuarios',$this->input->post('idUsuarios')) == TRUE)
			{
                $this->session->set_flashdata('success','Usuário editado com sucesso!');
				redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('idUsuarios'));
			}
			else
			{
				$this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

			}
		}

		$this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('permissoes','permissoes.idPermissao,permissoes.nome'); 

		$this->data['view'] = 'usuarios/editarUsuario';
        $this->load->view('tema/topo',$this->data);
			
      
    }
	
    public function excluir(){
    	
			$id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir Usuário.');            
                redirect(base_url().'index.php/usuarios/gerenciar/');
            }					
			
			// excluindo emprestimos vinculados ao usuario
            $this->db->where('usuarios_id', $id);
            $emprestimos = $this->db->get('emprestimos')->result();

            if($emprestimos != null){

                foreach ($vendas as $e) {
                    $this->db->where('emprestimos_id', $e->idEmprestimos);
                    $this->db->delete('itens_de_emprestimos');


                    $this->db->where('idVendas', $e->idEmprestimos);
                    $this->db->delete('emprestimos');
                }
            }

            //$ID =  $this->uri->segment(3);
           // $this->usuarios_model->delete('usuarios','idUsuarios',$ID);             
            //redirect(base_url().'index.php/usuarios/gerenciar/');
            
            $this->usuarios_model->delete('usuarios','idUsuarios',$id); 

            $this->session->set_flashdata('success','Usuário excluido com sucesso!');            
            redirect(base_url().'index.php/usuarios/gerenciar/');
    }

}

