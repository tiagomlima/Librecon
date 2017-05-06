<?php

class Acervos extends CI_Controller {
    
    
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('acervos_model', '', TRUE);
        $this->data['menuAcervos'] = 'Acervos';
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

	    $this->data['results'] = $this->acervos_model->get('acervos','idAcervos,titulo,tombo,quantidade,idioma','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'acervos/acervos';
       	$this->load->view('tema/topo',$this->data);
       
		
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
            /*$precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",","", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);*/
            $data = array(
                'titulo' => set_value('titulo'),
                'tombo' => set_value('tombo'),
                'quantidade' => set_value('quantidade'),
                'idioma' => set_value('idioma'),
                
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
            /*$precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",","", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);*/
            $data = array(
                'titulo' => $this->input->post('titulo'),
                'tombo' => $this->input->post('tombo'),
                'quantidade' => $this->input->post('quantidade'),
                'idioma' => $this->input->post('idioma'),
                
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
        $this->db->delete('acervos_os');


        $this->db->where('acervos_id', $id);
        $this->db->delete('itens_de_vendas');
        
        $this->acervos_model->delete('acervos','idAcervos',$id);             
        

        $this->session->set_flashdata('success','Acervo excluido com sucesso!');            
        redirect(base_url().'index.php/acervos/gerenciar/');
    }
}

