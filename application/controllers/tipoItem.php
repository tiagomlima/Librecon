<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/


class TipoItem extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('tipoItem_model','',TRUE);
            $this->data['menuAcervos'] = 'tipoItem';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vTipoItem')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Tipo de Item.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/tipoItem/gerenciar/';
        $config['total_rows'] = $this->tipoItem_model->count('tipo_de_item');
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
        
	    $this->data['results'] = $this->tipoItem_model->get('tipo_de_item','idTipoItem,nomeTipo,dataCadastro','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'tipoItem/tipoItem';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aTipoItem')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar tipoItem.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('tipoItem') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeTipo' => set_value('nomeTipoItem'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->tipoItem_model->add('tipo_de_item', $data) == TRUE) {
                $this->session->set_flashdata('success','TipoItem adicionado com sucesso!');
                redirect(base_url() . 'index.php/tipoItem/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'tipoItem/adicionarTipoItem';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eTipoItem')){
           $this->session->set_flashdata('error','Você não tem permissão para editar tipoItem.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('tipoItem') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeTipo' => $this->input->post('nomeTipoItem'),
                
            );

            if ($this->tipoItem_model->edit('tipo_de_item', $data, 'idTipoItem', $this->input->post('idTipoItem')) == TRUE) {
                $this->session->set_flashdata('success','TipoItem editado com sucesso!');
                redirect(base_url() . 'index.php/tipoItem/editar/'.$this->input->post('idTipoItem'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->tipoItem_model->getById($this->uri->segment(3));
        $this->data['view'] = 'tipoItem/editarTipoItem';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cTipoItem')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar tipoItem.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->tipoItem_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->tipoItem_model->getOsByTipoItem($this->uri->segment(3));
        $this->data['view'] = 'tipoItem/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dTipoItem')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir tipoItem.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir tipoItem.');            
                redirect(base_url().'index.php/tipoItem/gerenciar/');
            }

            /*//$id = 2;
            // excluindo OSs vinculadas ao tipoItem
            $this->db->where('tipoItem_id', $id);
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

            // excluindo Vendas vinculadas ao tipoItem
            $this->db->where('tipoItem_id', $id);
            $vendas = $this->db->get('vendas')->result();

            if($vendas != null){

                foreach ($vendas as $v) {
                    $this->db->where('vendas_id', $v->idVendas);
                    $this->db->delete('itens_de_vendas');


                    $this->db->where('idVendas', $v->idVendas);
                    $this->db->delete('vendas');
                }
            }

            //excluindo receitas vinculadas ao tipoItem
            $this->db->where('tipoItem_id', $id);
            $this->db->delete('lancamentos');*/



            $this->tipoItem_model->delete('tipo_de_item','idTipoItem',$id); 

            $this->session->set_flashdata('success','TipoItem excluido com sucesso!');            
            redirect(base_url().'index.php/tipoItem/gerenciar/');
    }
}


