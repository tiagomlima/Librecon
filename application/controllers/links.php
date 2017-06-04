<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

    

	public function __construct(){
		parent::__construct();

		if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
        	redirect('librecon/login');
        }

        $this->load->helper(array('codegen_helper'));
        $this->load->model('links_model','',TRUE);
        $this->data['menuLinks'] = 'Links';
	}

    public function index(){
        $this->gerenciar();
    }
	public function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vLink')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar links.');
           redirect(base_url());
        }

		$this->load->library('pagination');
                                     
            $config['base_url'] = base_url().'index.php/links/gerenciar';
            $config['total_rows'] = $this->links_model->count('links');
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
            
            $this->data['results'] = $this->links_model->get('links','idLink,descricao,link','',$config['per_page'],$this->uri->segment(3));
         

       	$this->data['view'] = 'links/links';
		$this->load->view('tema/topo',$this->data);
	}


	public function adicionar() {

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aLink')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar links.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('link', 'Links', 'trim|required|xss_clean');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|xss_clean');


        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'link' => $this->input->post('link')               
            );

            if ($this->links_model->add('links', $data) == TRUE) {
                $this->session->set_flashdata('success','Link adicionado com sucesso!');
                redirect(base_url() . 'index.php/links/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'links/adicionarLink';
        $this->load->view('tema/topo', $this->data);

    }

    public function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eLink')){
          $this->session->set_flashdata('error','Você não tem permissão para editar links.');
          redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|xss_clean');
		$this->form_validation->set_rules('link', 'Link', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
          

            $data = array(
                'link' => $this->input->post('link'),
                'descricao' => $this->input->post('descricao')      
            );

            if ($this->links_model->edit('links', $data, 'idLink', $this->input->post('idLink')) == TRUE) {
                $this->session->set_flashdata('success','Alterações efetuadas com sucesso!');
                redirect(base_url() . 'index.php/links/editar/'.$this->input->post('idLink'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }


        $this->data['result'] = $this->links_model->getById($this->uri->segment(3));
        $this->data['view'] = 'links/editarLink';
        $this->load->view('tema/topo', $this->data);

    }


    public function excluir(){
    	if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dLink')){
          $this->session->set_flashdata('error','Você não tem permissão para excluir links.');
          redirect(base_url());
        }

    	$id = $this->input->post('idLink');
    	if($id == null || !is_numeric($id)){
    		$this->session->set_flashdata('error','Erro! O link não pode ser localizado.');
            redirect(base_url() . 'index.php/links/');
    	}
  	
    	$this->db->where('idLink', $id);      
        if($this->db->delete('links')){
        	
	    	$this->session->set_flashdata('success','Linkexcluido com sucesso!');
	        redirect(base_url() . 'index.php/links/');
        }
        else{

        	$this->session->set_flashdata('error','Ocorreu um erro ao tentar excluir o link.');
            redirect(base_url() . 'index.php/links/');
        }


    }

}
