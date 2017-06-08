<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Grupos extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('grupos_model','',TRUE);
            $this->data['menuLeitores'] = 'grupos';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar grupos.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/grupos/gerenciar/';
        $config['total_rows'] = $this->grupos_model->count('grupos');
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
        
	    $this->data['results'] = $this->grupos_model->get('grupos','idGrupo, nomeGrupo, duracao_dias, qtde_max_item, qtde_max_renovacao, qtde_max_reserva, validade_reserva, multa, observacoes','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'grupos/grupos';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar grupos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('grupos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        			
            $data = array(
                'nomeGrupo' => set_value('nomeGrupo'),
                'duracao_dias' => set_value('duracao_dias'),
                'qtde_max_item' => set_value('qtde_max_item'),
                'qtde_max_renovacao' => set_value('qtde_max_renovacao'),
                'qtde_max_reserva' => set_value('qtde_max_reserva'),
                'validade_reserva' => set_value('validade_reserva'),
                'multa' => $this->input->post('multa'),
                'observacoes' => $this->input->post('observacoes'),  
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->grupos_model->add('grupos', $data) == TRUE) {
                $this->session->set_flashdata('success','Grupo adicionado com sucesso!');
                redirect(base_url() . 'index.php/grupos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'grupos/adicionarGrupo';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para editar grupos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('grupos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {     	
			
            $data = array(
                'nomeGrupo' => $this->input->post('nomeGrupo'),
                'duracao_dias' => $this->input->post('duracao_dias'), 
                'qtde_max_item' => $this->input->post('qtde_max_item'), 
                'qtde_max_renovacao' => $this->input->post('qtde_max_renovacao'), 
                'qtde_max_reserva' => $this->input->post('qtde_max_reserva'), 
                'validade_reserva' => $this->input->post('validade_reserva'),
                'multa' => $this->input->post('multa'), 
                'observacoes' => $this->input->post('observacoes')   
            );

            if ($this->grupos_model->edit('grupos', $data, 'idGrupo', $this->input->post('idGrupo')) == TRUE) {
                $this->session->set_flashdata('success','Grupo editado com sucesso!');
                redirect(base_url() . 'index.php/grupos/editar/'.$this->input->post('idGrupo'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->grupos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'grupos/editarGrupo';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vGrupo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar grupos.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->grupos_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->grupos_model->getOsByGrupo($this->uri->segment(3));
        $this->data['view'] = 'grupos/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dGrupo')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir grupos.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir Grupo.');            
                redirect(base_url().'index.php/grupos/gerenciar/');
            }

            /*//$id = 2;
            // excluindo OSs vinculadas ao curso
            $this->db->where('cursos_id', $id);
            $os = $this->db->get('os')->result();

            if($os != null){

                foreach ($os as $o) {
                    $this->db->where('os_id', $o->idOs);
                    $this->db->delete('servicos_os');

                    $this->db->where('os_id', $o->idOs);
<<<<<<< HEAD:application/controllers/teste.php
                    $this->db->delete('acervos_os');
=======
                    $this->db->delete('produtos_os');


>>>>>>> d1be87fa6ff425ffb2f2a0e5a67cc95d2c088c25:application/controllers/grupos.php
                    $this->db->where('idOs', $o->idOs);
                    $this->db->delete('os');
                }
            }

            // excluindo Vendas vinculadas ao curso
            $this->db->where('cursos_id', $id);
            $vendas = $this->db->get('vendas')->result();

            if($vendas != null){

                foreach ($vendas as $v) {
                    $this->db->where('vendas_id', $v->idVendas);
                    $this->db->delete('itens_de_vendas');


                    $this->db->where('idVendas', $v->idVendas);
                    $this->db->delete('vendas');
                }
            }

            //excluindo receitas vinculadas ao curso
            $this->db->where('cursos_id', $id);
            $this->db->delete('lancamentos');*/



            $this->grupos_model->delete('grupos','idGrupo',$id); 

            $this->session->set_flashdata('success','Grupo excluido com sucesso!');            
            redirect(base_url().'index.php/grupos/gerenciar/');
    }
}

//pocas ideias
//teste
