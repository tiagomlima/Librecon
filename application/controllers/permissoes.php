<?php

class Permissoes extends CI_Controller {
    

    
    
  function __construct() {
      parent::__construct();
      if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
          redirect('librecon/login');
      }

      if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cPermissao')){
        $this->session->set_flashdata('error','Você não tem permissão para configurar as permissões no sistema.');
        redirect(base_url());
      }

      $this->load->helper(array('form', 'codegen_helper'));
      $this->load->model('permissoes_model', '', TRUE);
      $this->data['menuConfiguracoes'] = 'Permissões';
  }
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/permissoes/gerenciar/';
        $config['total_rows'] = $this->permissoes_model->count('permissoes');
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

		  $this->data['results'] = $this->permissoes_model->get('permissoes','idPermissao,nome,data,situacao','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'permissoes/permissoes';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
    function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $cadastro = date('Y-m-d');
            $situacao = 1;

            $permissoes = array(
            	  'aCurso' => $this->input->post('aCurso'),
            	  'eCurso' => $this->input->post('eCurso'),
            	  'dCurso' => $this->input->post('dCurso'),
            	  'vCurso' => $this->input->post('vCurso'),
            	  
				  'aDisciplina' => $this->input->post('aDisciplina'),
            	  'eDisciplina' => $this->input->post('eDisciplina'),
            	  'dDisciplina' => $this->input->post('dDisciplina'),
            	  'vDisciplina' => $this->input->post('vDisciplina'),
            	  
				  'aGrupo' => $this->input->post('aGrupo'),
            	  'eGrupo' => $this->input->post('eGrupo'),
            	  'dGrupo' => $this->input->post('dGrupo'),
            	  'vGrupo' => $this->input->post('vGrupo'),

                  'aLeitor' => $this->input->post('aLeitor'),
                  'eLeitor' => $this->input->post('eLeitor'),
                  'dLeitor' => $this->input->post('dLeitor'),
                  'vLeitor' => $this->input->post('vLeitor'),

                  'aAcervo' => $this->input->post('aAcervo'),
                  'eAcervo' => $this->input->post('eAcervo'),
                  'dAcervo' => $this->input->post('dAcervo'),
                  'vAcervo' => $this->input->post('vAcervo'),
                  
				  'aAcervo' => $this->input->post('aAcervo'),
                  'eAcervo' => $this->input->post('eAcervo'),
                  'dAcervo' => $this->input->post('dAcervo'),
                  'vAcervo' => $this->input->post('vAcervo'),
                  
				  'aAutor' => $this->input->post('aAutor'),
                  'eAutor' => $this->input->post('eAutor'),
                  'dAutor' => $this->input->post('dAutor'),
                  'vAutor' => $this->input->post('vAutor'),
                  
				  'aEditora' => $this->input->post('aEditora'),
                  'eEditora' => $this->input->post('eEditora'),
                  'dEditora' => $this->input->post('dEditora'),
                  'vEditora' => $this->input->post('vEditora'),
                  
				  'aTipoItem' => $this->input->post('aTipoItem'),
                  'eTipoItem' => $this->input->post('eTipoItem'),
                  'dTipoItem' => $this->input->post('dTipoItem'),
                  'vTipoItem' => $this->input->post('vTipoItem'),
                  
				  'aSecao' => $this->input->post('aSecao'),
                  'eSecao' => $this->input->post('eSecao'),
                  'dSecao' => $this->input->post('dSecao'),
                  'vSecao' => $this->input->post('vSecao'),
                  
				  'aColecao' => $this->input->post('aColecao'),
                  'eColecao' => $this->input->post('eColecao'),
                  'dColecao' => $this->input->post('dColecao'),
                  'vColecao' => $this->input->post('vColecao'),

                  'aServico' => $this->input->post('aServico'),
                  'eServico' => $this->input->post('eServico'),
                  'dServico' => $this->input->post('dServico'),
                  'vServico' => $this->input->post('vServico'),

                  'aOs' => $this->input->post('aOs'),
                  'eOs' => $this->input->post('eOs'),
                  'dOs' => $this->input->post('dOs'),
                  'vOs' => $this->input->post('vOs'),
                
                  'aEmprestimo' => $this->input->post('aEmprestimo'),
                  'eEmprestimo' => $this->input->post('eEmprestimo'),
                  'dEmprestimo' => $this->input->post('dEmprestimo'),
                  'vEmprestimo' => $this->input->post('vEmprestimo'),

                  'aArquivo' => $this->input->post('aArquivo'),
                  'eArquivo' => $this->input->post('eArquivo'),
                  'dArquivo' => $this->input->post('dArquivo'),
                  'vArquivo' => $this->input->post('vArquivo'),

                  'aLancamento' => $this->input->post('aLancamento'),
                  'eLancamento' => $this->input->post('eLancamento'),
                  'dLancamento' => $this->input->post('dLancamento'),
                  'vLancamento' => $this->input->post('vLancamento'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'rLeitor' => $this->input->post('rLeitor'),
                  'rAcervo' => $this->input->post('rAcervo'),
                  'rServico' => $this->input->post('rServico'),
                  'rOs' => $this->input->post('rOs'),
                  'rEmprestimo' => $this->input->post('rEmprestimo'),
                  'rFinanceiro' => $this->input->post('rFinanceiro'),
                  

            );
            $permissoes = serialize($permissoes);

            $data = array(
                'nome' => $nomePermissao,
                'data' => $cadastro,
                'permissoes' => $permissoes,
                'situacao' => $situacao
            );

            if ($this->permissoes_model->add('permissoes', $data) == TRUE) {

                $this->session->set_flashdata('success', 'Permissão adicionada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->data['view'] = 'permissoes/adicionarPermissao';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {

        
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            
            $nomePermissao = $this->input->post('nome');
            $situacao = $this->input->post('situacao');
            $permissoes = array(
            	  
				  'aCurso' => $this->input->post('eCurso'),
            	  'eCurso' => $this->input->post('eCurso'),
            	  'dCurso' => $this->input->post('dCurso'),
            	  'vCurso' => $this->input->post('vCurso'),
            	  
				  'aDisciplina' => $this->input->post('aDisciplina'),
            	  'eDisciplina' => $this->input->post('eDisciplina'),
            	  'dDisciplina' => $this->input->post('dDisciplina'),
            	  'vDisciplina' => $this->input->post('vDisciplina'),
            	  
				  'aGrupo' => $this->input->post('aGrupo'),
            	  'eGrupo' => $this->input->post('eGrupo'),
            	  'dGrupo' => $this->input->post('dGrupo'),
            	  'vGrupo' => $this->input->post('vGrupo'),

                  'aLeitor' => $this->input->post('aLeitor'),
                  'eLeitor' => $this->input->post('eLeitor'),
                  'dLeitor' => $this->input->post('dLeitor'),
                  'vLeitor' => $this->input->post('vLeitor'),

                  'aAcervo' => $this->input->post('aAcervo'),
                  'eAcervo' => $this->input->post('eAcervo'),
                  'dAcervo' => $this->input->post('dAcervo'),
                  'vAcervo' => $this->input->post('vAcervo'),
                  
				  'aAcervo' => $this->input->post('aAcervo'),
                  'eAcervo' => $this->input->post('eAcervo'),
                  'dAcervo' => $this->input->post('dAcervo'),
                  'vAcervo' => $this->input->post('vAcervo'),
                  
				  'aAutor' => $this->input->post('aAutor'),
                  'eAutor' => $this->input->post('eAutor'),
                  'dAutor' => $this->input->post('dAutor'),
                  'vAutor' => $this->input->post('vAutor'),
                  
				  'aEditora' => $this->input->post('aEditora'),
                  'eEditora' => $this->input->post('eEditora'),
                  'dEditora' => $this->input->post('dEditora'),
                  'vEditora' => $this->input->post('vEditora'),
                  
				  'aTipoItem' => $this->input->post('aTipoItem'),
                  'eTipoItem' => $this->input->post('eTipoItem'),
                  'dTipoItem' => $this->input->post('dTipoItem'),
                  'vTipoItem' => $this->input->post('vTipoItem'),
                  
				  'aSecao' => $this->input->post('aSecao'),
                  'eSecao' => $this->input->post('eSecao'),
                  'dSecao' => $this->input->post('dSecao'),
                  'vSecao' => $this->input->post('vSecao'),
                  
				  'aColecao' => $this->input->post('aColecao'),
                  'eColecao' => $this->input->post('eColecao'),
                  'dColecao' => $this->input->post('dColecao'),
                  'vColecao' => $this->input->post('vColecao'),

                  'aServico' => $this->input->post('aServico'),
                  'eServico' => $this->input->post('eServico'),
                  'dServico' => $this->input->post('dServico'),
                  'vServico' => $this->input->post('vServico'),

                  'aOs' => $this->input->post('aOs'),
                  'eOs' => $this->input->post('eOs'),
                  'dOs' => $this->input->post('dOs'),
                  'vOs' => $this->input->post('vOs'),
                  
				  'aTeste' => $this->input->post('aTeste'),
                  'eTeste' => $this->input->post('eTeste'),
                  'dTeste' => $this->input->post('dTeste'),
                  'vTeste' => $this->input->post('vTeste'),
				  

                  'aEmprestimo' => $this->input->post('aEmprestimo'),
                  'eEmprestimo' => $this->input->post('eEmprestimo'),
                  'dEmprestimo' => $this->input->post('dEmprestimo'),
                  'vEmprestimo' => $this->input->post('vEmprestimo'),

                  'aArquivo' => $this->input->post('aArquivo'),
                  'eArquivo' => $this->input->post('eArquivo'),
                  'dArquivo' => $this->input->post('dArquivo'),
                  'vArquivo' => $this->input->post('vArquivo'),

                  'aLancamento' => $this->input->post('aLancamento'),
                  'eLancamento' => $this->input->post('eLancamento'),
                  'dLancamento' => $this->input->post('dLancamento'),
                  'vLancamento' => $this->input->post('vLancamento'),

                  'cUsuario' => $this->input->post('cUsuario'),
                  'cEmitente' => $this->input->post('cEmitente'),
                  'cPermissao' => $this->input->post('cPermissao'),
                  'cBackup' => $this->input->post('cBackup'),

                  'rLeitor' => $this->input->post('rLeitor'),
                  'rAcervo' => $this->input->post('rAcervo'),
                  'rServico' => $this->input->post('rServico'),
                  'rOs' => $this->input->post('rOs'),
                  'rEmprestimo' => $this->input->post('rEmprestimo'),
                  'rFinanceiro' => $this->input->post('rFinanceiro'),
                 
            );
            $permissoes = serialize($permissoes);

            $data = array(
                'nome' => $nomePermissao,
                'permissoes' => $permissoes,
                'situacao' => $situacao
            );

            if ($this->permissoes_model->edit('permissoes', $data, 'idPermissao', $this->input->post('idPermissao')) == TRUE) {
                $this->session->set_flashdata('success', 'Permissão editada com sucesso!');
                redirect(base_url() . 'index.php/permissoes/editar/'.$this->input->post('idPermissao'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->permissoes_model->getById($this->uri->segment(3));

        $this->data['view'] = 'permissoes/editarPermissao';
        $this->load->view('tema/topo', $this->data);

    }
	
    function excluir(){

        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir serviço.');            
            redirect(base_url().'index.php/permissoes/gerenciar/');
        }

        $this->db->where('permissoes_id', $id);
        $this->db->delete('usuarios');

        $this->permissoes_model->delete('permissoes','idPermissao',$id);             
        

        $this->session->set_flashdata('success','Permissão excluido com sucesso!');            
        redirect(base_url().'index.php/permissoes/gerenciar/');
    }
}


/* End of file permissoes.php */
/* Location: ./application/controllers/permissoes.php */