<?php

class Reservas extends CI_Controller {
    

    
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('reservas_model', '', TRUE);
		$this->load->model('autor_model', '', TRUE);
		$this->load->model('editora_model', '', TRUE);
		$this->load->model('acervos_model', '', TRUE);
        $this->data['menuReservas'] = 'Reservas';
    }
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar reservas.');
           redirect(base_url());
        }

        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/reservas/gerenciar/';
        $config['total_rows'] = $this->reservas_model->count('reserva');
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

		$this->data['results'] = $this->reservas_model->get('reserva','idReserva,usuario_id,acervos_id,dataReserva,dataPrazo,dataRetirada,status','',$config['per_page'],$this->uri->segment(3));
        $this->data['leitor'] = $this->reservas_model->getLeitor($config['per_page'],$this->uri->segment(3));
		$this->data['acervo'] = $this->reservas_model->getAcervo($config['per_page'],$this->uri->segment(3));
		//$this->data['autor'] = $this->reservas_model->getAutor($config['per_page'],$this->uri->segment(3));
		//$this->data['editora'] = $this->reservas_model->getEditora($config['per_page'],$this->uri->segment(3));
	    $this->data['view'] = 'reservas/reservas';
       	$this->load->view('tema/topo',$this->data);

       
		
    }	
	
    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir reservas.');
           redirect(base_url());
        }
       
        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir reserva.');            
            redirect(base_url().'index.php/reservas/gerenciar/');
        }     

        $this->servicos_model->delete('reserva','idReserva',$id);             
        

        $this->session->set_flashdata('success','Reserva excluida com sucesso!');            
        redirect(base_url().'index.php/reservas/gerenciar/');
    }
}

