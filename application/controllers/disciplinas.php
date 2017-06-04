<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Disciplinas extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('disciplinas_model','',TRUE);
            $this->data['menuLeitores'] = 'disciplinas';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vDisciplina')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar disciplinas.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/disciplinas/gerenciar/';
        $config['total_rows'] = $this->disciplinas_model->count('disciplinas');
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
        
	    //$this->data['results'] = $this->disciplinas_model->get('disciplinas','idDisciplina,nomeDisciplina','',$config['per_page'],$this->uri->segment(3));
		$this->data['results'] = $this->disciplinas_model->get($config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'disciplinas/disciplinas';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aDisciplina')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar disciplinas.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('disciplinas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeDisciplina' => set_value('nomeDisciplina'),
                'curso_id' => $this->input->post('curso_id'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->disciplinas_model->add('disciplinas', $data) == TRUE) {
                $this->session->set_flashdata('success','Disciplina adicionado com sucesso!');
                redirect(base_url() . 'index.php/disciplinas/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

		$this->load->model('cursos_model');
        $this->data['cursos'] = $this->cursos_model->getActive('cursos','cursos.idCursos,cursos.nomeCurso');  
        $this->data['view'] = 'disciplinas/adicionarDisciplina';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eDisciplina')){
           $this->session->set_flashdata('error','Você não tem permissão para editar disciplinas.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('disciplinas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeDisciplina' => $this->input->post('nomeDisciplina'),
				'curso_id' => $this->input->post('curso_id') 
            );

            if ($this->disciplinas_model->edit('disciplinas', $data, 'idDisciplina', $this->input->post('idDisciplina')) == TRUE) {
                $this->session->set_flashdata('success','Disciplina editado com sucesso!');
                redirect(base_url() . 'index.php/disciplinas/editar/'.$this->input->post('idDisciplina'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

		$this->load->model('cursos_model');
        $this->data['cursos'] = $this->cursos_model->getActive('cursos','cursos.idCursos,cursos.nomeCurso');  
        $this->data['result'] = $this->disciplinas_model->getById($this->uri->segment(3));
        $this->data['view'] = 'disciplinas/editarDisciplina';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vDisciplina')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar disciplinas.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->disciplinas_model->getById($this->uri->segment(3));
        $this->data['view'] = 'disciplinas/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dDisciplina')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir disciplinas.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir curso.');            
                redirect(base_url().'index.php/disciplinas/gerenciar/');
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
                    $this->db->delete('produtos_os');


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



            $this->disciplinas_model->delete('disciplinas','idDisciplina',$id); 

            $this->session->set_flashdata('success','Disciplina excluido com sucesso!');            
            redirect(base_url().'index.php/disciplinas/gerenciar/');
    }
}

//pocas ideias
//teste
