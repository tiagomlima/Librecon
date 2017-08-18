<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/


class Autor extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('autor_model','',TRUE);
            $this->data['menuAcervos'] = 'autor';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vAutor')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Tipo de Item.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/autor/gerenciar/';
        $config['total_rows'] = $this->autor_model->count('autor');
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
        
	    $this->data['results'] = $this->autor_model->get('autor','idAutor,autor,dataCadastro,descricao,numero','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'autor/autor';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aAutor')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar autor.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('autor') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
            
                'autor' => set_value('autor'),
                'descricao' =>  $this->input->post('descricao'),
                'numero' => set_value('numero'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->autor_model->add('autor', $data) == TRUE) {
                $this->session->set_flashdata('success','Autor adicionado com sucesso!');
                redirect(base_url() . 'index.php/autor/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'autor/adicionarAutor';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eAutor')){
           $this->session->set_flashdata('error','Você não tem permissão para editar autor.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
		$this->form_validation->set_rules('numero', 'Numero do autor', 'trim|required|xss_clean');

        if ($this->form_validation->run('autor') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'autor' => $this->input->post('autor'),
                'numero' => $this->input->post('numero'),
                'descricao' => $this->input->post('descricao')
                
                
            );

            if ($this->autor_model->edit('autor', $data, 'idAutor', $this->input->post('idAutor')) == TRUE) {
                $this->session->set_flashdata('success','Autor editado com sucesso!');
                redirect(base_url() . 'index.php/autor/editar/'.$this->input->post('idAutor'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->autor_model->getById($this->uri->segment(3));
        $this->data['view'] = 'autor/editarAutor';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cAutor')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar autor.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->autor_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->autor_model->getOsByAutor($this->uri->segment(3));
        $this->data['view'] = 'autor/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dAutor')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir autor.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir autor.');            
                redirect(base_url().'index.php/autor/gerenciar/');
            }

            /*//$id = 2;
            // excluindo OSs vinculadas ao autor
            $this->db->where('autor_id', $id);
            $os = $this->db->get('os')->result();

            if($os != null){

                foreach ($os as $o) {
                    $this->db->where('os_id', $o->idOs);
                    $this->db->delete('servicos_os');

                    $this->db->where('os_id', $o->idOs);
                    $this->db->delete('produtos_os');


                    $this->db->where('idOs', $o->idOs);
                    $this->db->delete('os');
                }
            }

            // excluindo Vendas vinculadas ao autor
            $this->db->where('autor_id', $id);
            $vendas = $this->db->get('vendas')->result();

            if($vendas != null){

                foreach ($vendas as $v) {
                    $this->db->where('vendas_id', $v->idVendas);
                    $this->db->delete('itens_de_vendas');


                    $this->db->where('idVendas', $v->idVendas);
                    $this->db->delete('vendas');
                }
            }

            //excluindo receitas vinculadas ao autor
            $this->db->where('autor_id', $id);
            $this->db->delete('lancamentos');*/



            $this->autor_model->delete('autor','idAutor',$id); 

            $this->session->set_flashdata('success','Autor excluido com sucesso!');            
            redirect(base_url().'index.php/autor/gerenciar/');
    }
}


