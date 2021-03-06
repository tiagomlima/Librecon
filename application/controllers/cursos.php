<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Cursos extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('cursos_model','',TRUE);
            $this->data['menuLeitores'] = 'cursos';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCurso')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar cursos.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/cursos/gerenciar/';
        $config['total_rows'] = $this->cursos_model->count('cursos');
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
        
	    $this->data['results'] = $this->cursos_model->get('cursos','idCursos,nomeCurso','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'cursos/cursos';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCurso')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar cursos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('cursos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeCurso' => set_value('nomeCurso'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->cursos_model->add('cursos', $data) == TRUE) {
                $this->session->set_flashdata('success','Curso adicionado com sucesso!');
                redirect(base_url() . 'index.php/cursos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'cursos/adicionarCurso';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eCurso')){
           $this->session->set_flashdata('error','Você não tem permissão para editar cursos.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('cursos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nomeCurso' => $this->input->post('nomeCurso') 
            );

            if ($this->cursos_model->edit('cursos', $data, 'idCursos', $this->input->post('idCursos')) == TRUE) {
                $this->session->set_flashdata('success','Curso editado com sucesso!');
                redirect(base_url() . 'index.php/cursos/editar/'.$this->input->post('idCursos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->cursos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'cursos/editarCurso';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCurso')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar cursos.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->cursos_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->cursos_model->getOsByCurso($this->uri->segment(3));
        $this->data['view'] = 'cursos/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dCurso')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir cursos.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir curso.');            
                redirect(base_url().'index.php/cursos/gerenciar/');
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



            $this->cursos_model->delete('cursos','idCursos',$id); 

            $this->session->set_flashdata('success','Curso excluido com sucesso!');            
            redirect(base_url().'index.php/cursos/gerenciar/');
    }
}

//pocas ideias
//teste
