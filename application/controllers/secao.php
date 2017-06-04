<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/


class Secao extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('secao_model','',TRUE);
            $this->data['menuSecao'] = 'secao';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vSecao')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Tipo de Item.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/secao/gerenciar/';
        $config['total_rows'] = $this->secao_model->count('secao');
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
        
	    $this->data['results'] = $this->secao_model->get('secao','idSecao,secao,dataCadastro','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'secao/secao';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aSecao')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar secao.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('secao') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'secao' => set_value('secao'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->secao_model->add('secao', $data) == TRUE) {
                $this->session->set_flashdata('success','Secao adicionado com sucesso!');
                redirect(base_url() . 'index.php/secao/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'secao/adicionarSecao';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eSecao')){
           $this->session->set_flashdata('error','Você não tem permissão para editar secao.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('secao') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'secao' => $this->input->post('secao'),
                
            );

            if ($this->secao_model->edit('secao', $data, 'idSecao', $this->input->post('idSecao')) == TRUE) {
                $this->session->set_flashdata('success','Secao editado com sucesso!');
                redirect(base_url() . 'index.php/secao/editar/'.$this->input->post('idSecao'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->secao_model->getById($this->uri->segment(3));
        $this->data['view'] = 'secao/editarSecao';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cSecao')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar secao.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->secao_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->secao_model->getOsBySecao($this->uri->segment(3));
        $this->data['view'] = 'secao/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dSecao')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir secao.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir secao.');            
                redirect(base_url().'index.php/secao/gerenciar/');
            }

            /*//$id = 2;
            // excluindo OSs vinculadas ao secao
            $this->db->where('secao_id', $id);
            $os = $this->db->get('os')->result();

            if($os != null){

                foreach ($os as $o) {
                    $this->db->where('os_id', $o->idOs);
                    $this->db->delete('servicos_os');

                    $this->db->where('os_id', $o->idOs);
                    $this->db->delete('acervos_os');


                    $this->db->where('idOs', $o->idOs);
                    $this->db->delete('os');
                }
            }

            // excluindo Vendas vinculadas ao secao
            $this->db->where('secao_id', $id);
            $vendas = $this->db->get('vendas')->result();

            if($vendas != null){

                foreach ($vendas as $v) {
                    $this->db->where('vendas_id', $v->idVendas);
                    $this->db->delete('itens_de_vendas');


                    $this->db->where('idVendas', $v->idVendas);
                    $this->db->delete('vendas');
                }
            }

            //excluindo receitas vinculadas ao secao
            $this->db->where('secao_id', $id);
            $this->db->delete('lancamentos');*/



            $this->secao_model->delete('secao','idSecao',$id); 

            $this->session->set_flashdata('success','Secao excluido com sucesso!');            
            redirect(base_url().'index.php/secao/gerenciar/');
    }
}


