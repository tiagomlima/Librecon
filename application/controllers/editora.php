<?php




class Editora extends CI_Controller {
    
   
    
    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('editora_model','',TRUE);
            $this->data['menuEditora'] = 'editora';
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vEditora')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar Tipo de Item.');
           redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/editora/gerenciar/';
        $config['total_rows'] = $this->editora_model->count('editora');
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
        
	    $this->data['results'] = $this->editora_model->get('editora','idEditora,editora,dataCadastro,email_editora,site','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'editora/editora';
       	$this->load->view('tema/topo',$this->data);
	  
       
		
    }
	
    function adicionar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aEditora')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar editora.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('editora') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
            
                'editora' => set_value('editora'),
                'email_editora' => set_value('email_editora'),
                'site' => set_value('site'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->editora_model->add('editora', $data) == TRUE) {
                $this->session->set_flashdata('success','Editora adicionado com sucesso!');
                redirect(base_url() . 'index.php/editora/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'editora/adicionarEditora';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }


        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEditora')){
           $this->session->set_flashdata('error','Você não tem permissão para editar editora.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('editora') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'editora' => $this->input->post('editora'),
                'email_editora' => $this->input->post('email_editora'),
                'site' => $this->input->post('site'),
                
            );

            if ($this->editora_model->edit('editora', $data, 'idEditora', $this->input->post('idEditora')) == TRUE) {
                $this->session->set_flashdata('success','Editora editado com sucesso!');
                redirect(base_url() . 'index.php/editora/editar/'.$this->input->post('idEditora'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->editora_model->getById($this->uri->segment(3));
        $this->data['view'] = 'editora/editarEditora';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEditora')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar editora.');
           redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->editora_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->editora_model->getOsByEditora($this->uri->segment(3));
        $this->data['view'] = 'editora/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dEditora')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir editora.');
               redirect(base_url());
            }

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir editora.');            
                redirect(base_url().'index.php/editora/gerenciar/');
            }

            /*//$id = 2;
            // excluindo OSs vinculadas ao editora
            $this->db->where('editora_id', $id);
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

            // excluindo Vendas vinculadas ao editora
            $this->db->where('editora_id', $id);
            $vendas = $this->db->get('vendas')->result();

            if($vendas != null){

                foreach ($vendas as $v) {
                    $this->db->where('vendas_id', $v->idVendas);
                    $this->db->delete('itens_de_vendas');


                    $this->db->where('idVendas', $v->idVendas);
                    $this->db->delete('vendas');
                }
            }

            //excluindo receitas vinculadas ao editora
            $this->db->where('editora_id', $id);
            $this->db->delete('lancamentos');*/



            $this->editora_model->delete('editora','idEditora',$id); 

            $this->session->set_flashdata('success','Editora excluido com sucesso!');            
            redirect(base_url().'index.php/editora/gerenciar/');
    }
}


