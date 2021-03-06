<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Librecon extends CI_Controller {


    
    
    public function __construct() {
        parent::__construct();
        $this->load->model('librecon_model','',TRUE);
		$this->load->model('reservas_model','',TRUE);
		$this->load->model('emprestimos_model','',TRUE);
		$this->load->model('leitores_model','',TRUE);
		
		date_default_timezone_set('America/Sao_Paulo');
        
    }

    public function index() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }
		
		if($this->session->userdata('tipo_usuario') == 1){
			$leitor = $this->session->userdata('id');
			//verifica se o usuario possui multa
			if($this->leitores_model->verificaMulta($leitor) == false){
				//se nao possui,verifica se possui algum emprestimo em atraso
				if($this->leitores_model->verificaAtraso($leitor)){
					//se possui,aplica a multa
					$multa = $this->leitores_model->getDuracaoMulta($leitor);
					$data = date('Y-m-d H:i:s', strtotime("+ ".$multa." days"));
					$this->leitores_model->aplicarMulta($leitor,$data);
					$this->session->set_flashdata('error','Devido ao atraso de devolução, sua conta foi bloqueada por '.$multa.' dias.');
					redirect('librecon/leitor');
				}								
			}else{ //se possui multa, verifica se possui emprestimo em atraso
				if($this->leitores_model->verificaAtraso($leitor) == false){
					//se nao possuir atraso, verifica se a multa ja venceu 
					if($this->leitores_model->verificaVencimentoMulta($leitor)){
						$this->session->set_flashdata('success','Seu período de multa acabou, sua conta foi desbloqueada.');
						redirect('librecon/leitor');
					}
				}
			}				
			redirect('librecon/leitor');
		}else{
			if($this->leitores_model->verificaAtrasoGeral() == true){
				$this->session->set_flashdata('success','Multas aplicadas a leitores com atraso');
			}		
		}
		

        $this->data['emprestimos'] = $this->librecon_model->getEmprestimosAbertos();
        $this->data['reservas'] = $this->librecon_model->getReservasAbertas();
        $this->data['emp'] = $this->librecon_model->getEmpEstatisticas();        
        $this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'librecon/painel';
        $this->load->view('tema/topo',  $this->data);
      
    }
	
	public function leitor(){
		$this->data['usuario'] = $this->librecon_model->getById($this->session->userdata('id'));
		$this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'librecon/leitor';
        $this->load->view('tema/topo',  $this->data);
	}


    public function minhaConta() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        $this->data['usuario'] = $this->librecon_model->getById($this->session->userdata('id'));
        $this->data['view'] = 'librecon/minhaConta';
        $this->load->view('tema/topo',  $this->data);
     
    }

    public function alterarSenha() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        $this->load->library('encrypt');
        
        $oldSenha = $this->input->post('oldSenha');
        $senha = $this->input->post('novaSenha');
        $result = $this->librecon_model->alterarSenha($senha,$oldSenha,$this->session->userdata('id'));
        if($result){
            $this->session->set_flashdata('success','Senha Alterada com sucesso!');
            redirect(base_url() . 'index.php/librecon/minhaConta');
        }
        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'index.php/librecon/minhaConta');
            
        }
    }

    public function pesquisar() {
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }
        
        $termo = $this->input->get('termo');

        $data['results'] = $this->librecon_model->pesquisar($termo);
        $this->data['acervos'] = $data['results']['acervos'];
        $this->data['reservas'] = $data['results']['reservas'];
        $this->data['emprestimos'] = $data['results']['emprestimos'];
        $this->data['usuarios'] = $data['results']['usuarios'];
        $this->data['view'] = 'librecon/pesquisa';
        $this->load->view('tema/topo',  $this->data);
      
    }

    public function login(){
        
        $this->load->view('librecon/login');
        
    }
    public function sair(){
        $this->session->sess_destroy();
        redirect('librecon/login');
    }


    public function verificarLogin(){

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email','Email','valid_email|required|xss_clean|trim');
        $this->form_validation->set_rules('senha','Senha','required|xss_clean|trim');
        $ajax = $this->input->get('ajax');
        if ($this->form_validation->run() == false) {
            
            if($ajax == true){
                $json = array('result' => false);
                echo json_encode($json);
            }
            else{
                $this->session->set_flashdata('error','Os dados de acesso estão incorretos.');
                redirect($this->login);
            }
        } 
        else {

            $email = $this->input->post('email');
            $senha = $this->input->post('senha');

            $this->load->library('encrypt');   
            $senha = $this->encrypt->sha1($senha);

            $this->db->where('email',$email);
            $this->db->where('senha',$senha);
            $this->db->where('situacao',1);
			$this->db->limit(1);
			
            $usuario = $this->db->get('usuarios')->row();
			
            if(count($usuario) > 0){
                $dados = array('nome' => $usuario->nome, 'id' => $usuario->idUsuarios,'permissao' => $usuario->permissoes_id , 'logado' => TRUE, 'tipo_usuario' =>$usuario->tipo_usuario, 'grupo' =>$usuario->grupo_id);
                $this->session->set_userdata($dados);

                if($ajax == true){
                    $json = array('result' => true);
                    echo json_encode($json);
                }
                else{
                	
                    redirect(base_url().'librecon');
                }
				
            }
            else{
                
                
                if($ajax == true){
                    $json = array('result' => false);
                    echo json_encode($json);
                }
                else{
                    $this->session->set_flashdata('error','Os dados de acesso estão incorretos.');
                    redirect($this->login);
                }
            }
            
        }
        
    }


    public function backup(){

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cBackup')){
           $this->session->set_flashdata('error','Você não tem permissão para efetuar backup.');
           redirect(base_url());
        }

        
        
        $this->load->dbutil();
        $prefs = array(
                'format'      => 'zip',
                'filename'    => 'backup'.date('d-m-Y').'.sql'
              );

        $backup =& $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url().'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup'.date('d-m-Y H:m:s').'.zip', $backup);
    }


    public function emitente(){   

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $data['menuConfiguracoes'] = 'Configuracoes';
        $data['dados'] = $this->librecon_model->getEmitente();
        $data['view'] = 'librecon/emitente';
        $this->load->view('tema/topo',$data);
        $this->load->view('tema/rodape');
    }
	
	public function etiquetas(){
		
		if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }
		
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEtiqueta')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar etiquetas.');
           redirect(base_url());
        }

		$data['menuConfiguracoes'] = 'Configuracoes';
		$data['view'] = 'librecon/etiquetas';
		$data['acervos'] = $this->librecon_model->getAcervos();
		$this->load->view('tema/topo',$data);
        $this->load->view('tema/rodape');
	}

	public function gerarEtiqueta(){
		$tombo = $this->input->post('tombo');
		
		$data['tombo'] = $tombo;
		$data['view'] = 'librecon/imprimir/etiquetas';
		$this->load->view('tema/topo',$data);
        $this->load->view('tema/rodape');
		
	}

    function do_upload(){

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => TRUE,
            'encrypt_name'  => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }

    }


    public function cadastrarEmitente() {

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('index.php/librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Razão Social','required|xss_clean|trim');
        $this->form_validation->set_rules('cnpj','CNPJ','required|xss_clean|trim');
        $this->form_validation->set_rules('ie','IE','required|xss_clean|trim');
        $this->form_validation->set_rules('logradouro','Logradouro','required|xss_clean|trim');
        $this->form_validation->set_rules('numero','Número','required|xss_clean|trim');
        $this->form_validation->set_rules('bairro','Bairro','required|xss_clean|trim');
        $this->form_validation->set_rules('cidade','Cidade','required|xss_clean|trim');
        $this->form_validation->set_rules('uf','UF','required|xss_clean|trim');
        $this->form_validation->set_rules('telefone','Telefone','required|xss_clean|trim');
        $this->form_validation->set_rules('site','Site','required|xss_clean|trim');


        

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('error','Campos obrigatórios não foram preenchidos.');
            redirect(base_url().'index.php/librecon/emitente');
            
        } 
        else {

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $site = $this->input->post('site');
            $image = $this->do_upload();
            $logo = base_url().'assets/uploads/'.$image;


            $retorno = $this->librecon_model->addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$site, $logo);
            if($retorno){

                $this->session->set_flashdata('success','As informações foram inseridas com sucesso.');
                redirect(base_url().'index.php/librecon/emitente');
            }
            else{
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar inserir as informações.');
                redirect(base_url().'index.php/librecon/emitente');
            }
            
        }
    }


    public function editarEmitente() {

        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('index.php/librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Razão Social','required|xss_clean|trim');
        $this->form_validation->set_rules('cnpj','CNPJ','required|xss_clean|trim');
        $this->form_validation->set_rules('ie','IE','required|xss_clean|trim');
        $this->form_validation->set_rules('logradouro','Logradouro','required|xss_clean|trim');
        $this->form_validation->set_rules('numero','Número','required|xss_clean|trim');
        $this->form_validation->set_rules('bairro','Bairro','required|xss_clean|trim');
        $this->form_validation->set_rules('cidade','Cidade','required|xss_clean|trim');
        $this->form_validation->set_rules('uf','UF','required|xss_clean|trim');
        $this->form_validation->set_rules('telefone','Telefone','required|xss_clean|trim');
        $this->form_validation->set_rules('site','Site','required|xss_clean|trim');


        

        if ($this->form_validation->run() == false) {
            
            $this->session->set_flashdata('error','Campos obrigatórios não foram preenchidos.');
            redirect(base_url().'index.php/librecon/emitente');
            
        } 
        else {

            $nome = $this->input->post('nome');
            $cnpj = $this->input->post('cnpj');
            $ie = $this->input->post('ie');
            $logradouro = $this->input->post('logradouro');
            $numero = $this->input->post('numero');
            $bairro = $this->input->post('bairro');
            $cidade = $this->input->post('cidade');
            $uf = $this->input->post('uf');
            $telefone = $this->input->post('telefone');
            $site = $this->input->post('site');
            $id = $this->input->post('id');


            $retorno = $this->librecon_model->editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$site);
            if($retorno){

                $this->session->set_flashdata('success','As informações foram alteradas com sucesso.');
                redirect(base_url().'index.php/librecon/emitente');
            }
            else{
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar as informações.');
                redirect(base_url().'index.php/librecon/emitente');
            }
            
        }
    }


    public function editarLogo(){
        
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('index.php/librecon/login');
        }

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'cEmitente')){
           $this->session->set_flashdata('error','Você não tem permissão para configurar emitente.');
           redirect(base_url());
        }

        $id = $this->input->post('id');
        if($id == null || !is_numeric($id)){
           $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar a logomarca.');
           redirect(base_url().'index.php/librecon/emitente'); 
        }
        $this->load->helper('file');
        //delete_files(FCPATH .'assets/uploads/');

        $image = $this->do_upload();
        $logo = base_url().'assets/uploads/'.$image;

        $retorno = $this->librecon_model->editLogo($id, $logo);
        if($retorno){

            $this->session->set_flashdata('success','As informações foram alteradas com sucesso.');
            redirect(base_url().'index.php/librecon/emitente');
        }
        else{
            $this->session->set_flashdata('error','Ocorreu um erro ao tentar alterar as informações.');
            redirect(base_url().'index.php/librecon/emitente');
        }

    }

    
}
