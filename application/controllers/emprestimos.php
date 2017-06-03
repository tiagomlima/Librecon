<?php
class Emprestimos extends CI_Controller {
    
    
    
    function __construct() {
        parent::__construct();
        
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }
		
		$this->load->helper(array('form','codegen_helper'));
		$this->load->model('emprestimos_model','',TRUE);
		$this->load->model('usuarios_model','',TRUE);
		$this->load->model('reservas_model','',TRUE);
		$this->data['menuEmprestimos'] = 'Emprestimos';
	}	
	
	function index(){
		$this->gerenciar();
	}
	function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar emprestimos.');
           redirect(base_url());
        }
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/emprestimos/gerenciar/';
        $config['total_rows'] = $this->emprestimos_model->count('emprestimos');
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
		$this->data['results'] = $this->emprestimos_model->get('emprestimos','*','',$config['per_page'],$this->uri->segment(3));
		
	    $this->data['view'] = 'emprestimos/emprestimos';
       	$this->load->view('tema/topo',$this->data);
      
		
    }
	
    function adicionar(){
		
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar emprestimos.');
          redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('emprestimos') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            $dataEmprestimo = $this->input->post('dataEmprestimo');
			$dataVencimento = $this->input->post('dataVencimento');
            try {
                
                $dataEmprestimo = explode('/', $dataEmprestimo);
                $dataEmprestimo = $dataEmprestimo[2].'-'.$dataEmprestimo[1].'-'.$dataEmprestimo[0];
				
				$dataVencimento = explode('/', $dataVencimento);
                $dataVencimento = $dataVencimento[2].'-'.$dataVencimento[1].'-'.$dataVencimento[0];
            } catch (Exception $e) {
               $dataEmprestimo = date('Y/m/d'); 
			   $dataVencimento = date('Y/m/d');
            }
            $data = array(
                'dataEmprestimo' => $dataEmprestimo,
                'dataVencimento' => $dataVencimento,
                'usuarios_id' => $this->input->post('usuarios_id'),
                'leitor_id' => $this->input->post('leitor_id'),
                'grupo_id' => $this->input->post('grupo_id'),
                'status' => $this->input->post('status')
               
            );
            if (is_numeric($id = $this->emprestimos_model->add('emprestimos', $data, true)) ) {
                $this->session->set_flashdata('success','Emprestimo iniciado com sucesso, adicione os acervos.');
                redirect('emprestimos/editar/'.$id);
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'emprestimos/adicionarEmprestimo';
        $this->load->view('tema/topo', $this->data);
    }

	function emprestarReserva(){
		
		$leitor_id = $this->input->post('leitor_id');
		$idReserva = $this->input->post('idReserva');
		$usuario_id = $this->session->userdata('id');
		
		//pega o id do grupo que o leitor faz parte
		$this->db->where('idUsuarios',$leitor_id);
		$grupo = $this->db->get('usuarios')->row();
		$grupo_id = $grupo->grupo_id;
		
		//pega a quantidade de itens na lista de reserva e acrescenta no emprestimo
		$this->db->where('idReserva',$idReserva);
		$qtde = $this->db->get('reserva')->row();
		
		$dataEmprestimo = date('Y-m-d');
		$dataVencimento = date('Y-m-d');
				
		$data = array(
			'dataEmprestimo' => $dataEmprestimo,
			'dataVencimento' => $dataVencimento,
			'leitor_id' => $leitor_id,
			'usuarios_id' => $usuario_id,
			'status' => 'Não emprestado',
			'grupo_id' => $grupo_id,
			'qtde_item' => $qtde->qtde_item			
		);
		
		if(is_numeric($id = $this->emprestimos_model->add('emprestimos',$data,true))){
			
			$this->db->query("UPDATE reserva set status = 'Aprovado' WHERE idReserva = ".$idReserva);
			
			$this->db->where('reserva_id',$idReserva);
			$lista = $this->db->get('itens_de_reserva')->result();
			
			foreach ($lista as $l){
				$data = array(
					'emprestimos_id' => $id,
					'acervos_id' => $l->acervos_id
				);
				
				$this->emprestimos_model->add('itens_de_emprestimos',$data);
				
				
			}						
			$this->session->set_flashdata('success','Emprestimo iniciado com sucesso!');
            redirect('emprestimos/editar/'.$id);	
		}else{
			$this->session->set_flashdata('error','Erro ao aprovar essa reserva,tente novamente');
            redirect('reservas');
		}
		
		
		/* if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar emprestimos.');
          redirect(base_url());
        }

		$dataEmprestimo = date('d/m/Y');
		$dataVencimento = date('d/m/Y');
		
		try {              
                $dataEmprestimo = explode('/', $dataEmprestimo);
                $dataEmprestimo = $dataEmprestimo[2].'-'.$dataEmprestimo[1].'-'.$dataEmprestimo[0];
				
				$dataVencimento = explode('/', $dataVencimento);
                $dataVencimento = $dataVencimento[2].'-'.$dataVencimento[1].'-'.$dataVencimento[0];
            } catch (Exception $e) {
               $dataEmprestimo = date('Y-m-d'); 
			   $dataVencimento = date('Y-m-d');
            }
			
			$leitor_id = $this->input->post('leitor_id');
			$this->db->where('idUsuarios',$leitor_id);
			$grupo = $this->db->get('usuarios')->row();
			$status = 'Não emprestado';
			$idReserva = $this->input->post('idReserva');
			
			$data = array(
                'dataEmprestimo' => $dataEmprestimo,
                'dataVencimento' => $dataVencimento,
                'usuarios_id' => $this->session->userdata('id'),
                'leitor_id' => $leitor_id,
                'grupo_id' => $grupo->grupo_id,
                'status' => $status              
            );
			if (is_numeric($id = $this->emprestimos_model->add('emprestimos', $data, true)) ) {
				$sql = "UPDATE reserva set status = 'Aprovado' WHERE idReserva = ".$idReserva;
				$this->db->query($sql,array($idReserva));
							
			   $itemReserva = $this->reservas_model->getAcervosById($idReserva);
			   
			    $sql = "SELECT group_concat(acervos_id separator ',') as id FROM `itens_de_reserva` WHERE reserva_id = ".$idReserva;
				$query = $this->db->query($sql,array($idReserva));
				$array1 = $query->row_array();
				$arr = explode(',',$array1['id']);
				
				$i = count($arr);
				
				//pega os acervos contidos no itens de reserva e joga no itens de emprestimos
				for($i = 0; $i < count($arr);){
					$acervos_id = $arr[$i];
					
					$data2 = array(
						'emprestimos_id' => $id,
						'acervos_id' => $acervos_id
					);
					
					$data3 = array(
						'qtde_item' => $i += $i
					);
						$this->emprestimos_model->add('itens_de_emprestimos',$data2);
						$this->emprestimos_model->edit('emprestimos',$data3,'idEmprestimos',$id);			
					$i++;
				}
				
			   	$dataRetirada = date('Y-m-d');
			   	$retirada = "UPDATE reserva set dataRetirada = ".$dataRetirada." WHERE idReserva = ".$idReserva;
			   				
                $this->session->set_flashdata('success','Emprestimo iniciado com sucesso!.');
                redirect('emprestimos/editar/'.$id);
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
			
			    */
 	}

    
    function editar() {
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para editar emprestimos');
          redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        if ($this->form_validation->run('emprestimos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $dataEmprestimo = $this->input->post('dataEmprestimo');
			$dataVencimento = $this->input->post('dataVencimento');
            try {
                
                $dataEmprestimo = explode('/', $dataEmprestimo);
                $dataEmprestimo = $dataEmprestimo[2].'-'.$dataEmprestimo[1].'-'.$dataEmprestimo[0];
				
				$dataVencimento = explode('/', $dataVencimento);
                $dataVencimento = $dataVencimento[2].'-'.$dataVencimento[1].'-'.$dataVencimento[0];
            } catch (Exception $e) {
               $dataEmprestimo = date('Y/m/d'); 
			   $dataVencimento = date('Y/m/d'); 
            }
            $data = array(
                'dataEmprestimo' => $dataEmprestimo,
                'dataVencimento' => $dataVencimento,
                'usuarios_id' => $this->input->post('usuarios_id'),
               // 'status' => $this->input->post('status'),
                'leitor_id' => $this->input->post('leitor_id')
            );
            if ($this->emprestimos_model->edit('emprestimos', $data, 'idEmprestimos', $this->input->post('idEmprestimos')) == TRUE) {
				
                $this->session->set_flashdata('success','Empréstimo editado com sucesso!');
                redirect(base_url() . 'index.php/Emprestimos/editar/'.$this->input->post('idEmprestimos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }
		
		$this->data['grupos'] = $this->emprestimos_model->getGrupoById($this->uri->segment(3));
        $this->data['leitor'] = $this->emprestimos_model->getLeitorById($this->uri->segment(3));
		$this->data['result'] = $this->emprestimos_model->getById($this->uri->segment(3));	
        $this->data['acervos'] = $this->emprestimos_model->getAcervos($this->uri->segment(3));
		//$this->data['acervo'] = $this->emprestimos_model->getAcervosById($this->uri->segment(3));
        $this->data['view'] = 'emprestimos/editarEmprestimo';
        $this->load->view('tema/topo', $this->data);

    }
	
    public function visualizar(){
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar emprestimos.');
          redirect(base_url());
        }
        $this->data['custom_error'] = '';
        $this->load->model('librecon_model');
		$this->data['grupos'] = $this->emprestimos_model->getGrupoById($this->uri->segment(3));
        $this->data['result'] = $this->emprestimos_model->getLeitorById($this->uri->segment(3));
		$this->data['usuario'] = $this->emprestimos_model->getById($this->uri->segment(3));
        $this->data['acervos'] = $this->emprestimos_model->getAcervos($this->uri->segment(3));
		$this->data['acervo'] = $this->emprestimos_model->getAcervosById($this->uri->segment(3));
        $this->data['emitente'] = $this->librecon_model->getEmitente();
        $this->data['curso'] = $this->emprestimos_model->getCursoById($this->uri->segment(3));
        $this->data['view'] = 'emprestimos/visualizarEmprestimo';
        $this->load->view('tema/topo', $this->data);
       
    }
	
    function excluir(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para excluir emprestimos');
          redirect(base_url());
        }
        
        $id =  $this->input->post('id');
		$status = $this->input->post('status');
        if ($id == null){
            $this->session->set_flashdata('error','Erro ao tentar excluir empréstimo.');            
            redirect(base_url().'index.php/emprestimos/gerenciar/');
        }
		
		if($status == 'Não emprestado'){
			$this->db->where('emprestimos_id', $id);
		    $this->db->delete('itens_de_emprestimos');
		    $this->db->where('idEmprestimos', $id);
		    $this->db->delete('emprestimos');   		
				        
		    $this->session->set_flashdata('success','Empréstimo excluído com sucesso!');            
		    redirect(base_url().'index.php/emprestimos/gerenciar/');
		}
				
		if($status != 'Devolvido'){ // se o status não for devolvido, acrescenta o(s) item(s) de volta ao estoque e exclui o Emprestimo
				// pega todos os ids dos acervos inclusos no itens de emprestimo		
			$sql = "SELECT group_concat(acervos_id separator ',') as id FROM `itens_de_emprestimos` WHERE emprestimos_id = ".$id;
			$query = $this->db->query($sql,array($id));
			$array1 = $query->row_array();
			$arr = explode(',',$array1['id']);
			
			$i = count($arr);
			
			//pega os ids dos acervos contidos no itens de emprestimos e acrescenta no estoque
			for($i = 0; $i < count($arr);){
				$acervos_id = $arr[$i];
				
				$consulta = "UPDATE acervos set estoque = estoque + 1 WHERE idAcervos =".$acervos_id;
	            $this->db->query($consulta, array($acervos_id));
									
				$i++;
			}
			
		} 
			
		$this->db->where('emprestimos_id', $id);
	    $this->db->delete('itens_de_emprestimos');
	    $this->db->where('idEmprestimos', $id);
	    $this->db->delete('emprestimos');   		
			        
	    $this->session->set_flashdata('success','Empréstimo excluído com sucesso!');            
	    redirect(base_url().'index.php/emprestimos/gerenciar/');
					 
		
        
    }
    public function autoCompleteAcervo(){
        
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->emprestimos_model->autoCompleteAcervo($q);
        }
    }
	
	public function finalizarEmprestimo(){
		$idEmprestimos = $this->input->post('idEmprestimos');
		$status = $this->input->post('status');
		$dataDevolucao = date('Y-m-d');
		
		if($status == 'Emprestado' or $status == 'Renovado'){
			
	    // pega todos os ids dos acervos inclusos no itens de emprestimo		
		$sql = "SELECT group_concat(acervos_id separator ',') as id FROM `itens_de_emprestimos` WHERE emprestimos_id = ".$idEmprestimos;
		$query = $this->db->query($sql,array($idEmprestimos));
		$array1 = $query->row_array();
		$arr = explode(',',$array1['id']);
		
		$i = count($arr);
		
		//pega os ids dos acervos contidos no itens de emprestimos e acrescenta no estoque
		for($i = 0; $i < count($arr);){
			$acervos_id = $arr[$i];
			
			$consulta = "UPDATE acervos set estoque = estoque + 1 WHERE idAcervos =".$acervos_id;
            $this->db->query($consulta, array($acervos_id));
								
			$i++;
		}
		
		//Atualiza o status para devolvido
		$atualizarStatus = "UPDATE emprestimos set status = 'Devolvido' WHERE idEmprestimos = ".$idEmprestimos;
		$this->db->query($atualizarStatus,array($idEmprestimos));
		
		//registra a data de entrega do livro
		$atualizaData = "UPDATE emprestimos set dataDevolucao = '".$dataDevolucao."' WHERE idEmprestimos = ".$idEmprestimos;
		$this->db->query($atualizaData,array($dataVencimento,$idEmprestimos));
		
		$this->session->set_flashdata('success','Empréstimo finalizado com sucesso!');            
        redirect(base_url().'index.php/emprestimos/editar/'.$idEmprestimos);
		
		//print_r($arr);
		}else{
			$this->session->set_flashdata('error','Erro ao finalizar empréstimo');
			redirect(base_url().'index.php/emprestimos/editar/'.$idEmprestimos);
		}
		
		
	}
	
    public function autoCompleteLeitor(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->emprestimos_model->autoCompleteLeitor($q);
        }
    }
    public function autoCompleteUsuario(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->emprestimos_model->autoCompleteUsuario($q);
        }
    }
    public function adicionarAcervo(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
          $this->session->set_flashdata('error','Você não tem permissão para editar emprestimos.');
          redirect(base_url());
        }
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idAcervo', 'Acervo', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idEmprestimosAcervo', 'Emprestimos', 'trim|required|xss_clean');
        	
			
			
            $idEmprestimos = $this->input->post('idEmprestimosAcervo');
            $qtde_max_item = $this->input->post('qtde_max_item');
			$qtde_atual = $this->input->post('qtde_atual');
            $acervo = $this->input->post('acervos_id');
			$estoque = $this->input->post('estoque');
			
			if($qtde_atual > $qtde_max_item){
				$this->session->set_flashdata('error','O limite de itens por empréstimo foi excedido.');
				 redirect('emprestimos/editar/'.$idEmprestimos);
			}
						
			if($acervo == null){
				$this->session->set_flashdata('error','Digite o nome do item.');
				 redirect('emprestimos/editar/'.$idEmprestimos);
			}
			
			if($estoque <= 1){
				$this->session->set_flashdata('error','Não há examplares do acervo disponiveis.');
				 redirect('emprestimos/editar/'.$idEmprestimos);
			}
			
			
            $data = array(
              
                'acervos_id'=> $acervo,
                'emprestimos_id'=> $idEmprestimos,
            );
            if($this->emprestimos_model->add('itens_de_emprestimos', $data) == true){
                $sql = "UPDATE acervos set estoque = estoque - 1 WHERE idAcervos =".$acervo;
                $this->db->query($sql, array($acervo));
				
				$addQtde = "UPDATE emprestimos set qtde_item = qtde_item  + 1 WHERE idEmprestimos = ".$idEmprestimos;
				$this->db->query($addQtde, array($acervo));
				
				$this->session->set_flashdata('success','Item adicionado com sucesso'); 
                redirect('emprestimos/editar/'.$idEmprestimos);
               
            }else{
            	$this->session->set_flashdata('error','Não foi possível adicionar o item.');
                 redirect('emprestimos/editar/'.$idEmprestimos);
            }
        
       
      
    }

    function excluirAcervo(){
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
              $this->session->set_flashdata('error','Você não tem permissão para editar Emprestimos');
              redirect(base_url());
            }
			
            $ID = $this->input->post('idAcervo');
            $idEmprestimos = $this->input->post('idEmprestimo');
            if($this->emprestimos_model->delete('itens_de_emprestimos','idItens',$ID) == true){
                
               
                $acervo = $this->input->post('acervo');
                $sql = "UPDATE acervos set estoque = estoque + 1 WHERE idAcervos =".$acervo;
                $this->db->query($sql, array($acervo));
				
				$delQtde = "UPDATE emprestimos set qtde_item = qtde_item  - 1 WHERE idEmprestimos = ".$idEmprestimos;
				$this->db->query($delQtde, array($idEmprestimos));
                
                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }           
    }
  

	public function emprestar(){
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
              $this->session->set_flashdata('error','Você não tem permissão para emprestar');
              redirect(base_url());
            }
				
		$itens = $this->db->get('itens_de_emprestimos')->row();		    						
		$status = $this->input->post('status');
		$idEmprestimos = $this->input->post('idEmprestimos');
		$dataVencimento = strtr($this->input->post('dataVencimento'), '/', '-'); //converte o formato da data ao padrao do mysql parte 1
				
		$dataVencimento = date('Y-m-d', strtotime($dataVencimento)); //converte o formato da data ao padrao do mysql parte 2
		//atualiza a data de devoluçao de acordo com o grupo do leitor
		$data = "UPDATE emprestimos set dataVencimento = '".$dataVencimento."' WHERE idEmprestimos = ".$idEmprestimos;
		$this->db->query($data,array($dataVencimento,$idEmprestimos));
		
		if(count($itens) > 0){
			//atualiza o status do emprestimo
			$sql = "UPDATE emprestimos set status = '".$status."' WHERE idEmprestimos =".$idEmprestimos;
            $this->db->query($sql, array($status, $idEmprestimos));
            
            $acervos_id = $this->emprestimos_model->getAcervosById($idEmprestimos);				
			$leitor_id = $this->input->post('leitor_id');	
			$reserva = $this->reservas_model->getReservaById($leitor_id);
			
			if(count($reserva) > 0){
				$sql = "UPDATE reserva set status = 'Retirado' WHERE usuario_id = ".$leitor_id;
				$this->db->query($sql,array($leitor_id));
			}
			
			$verificaReserva = $this->reservas_model->getReservaById($leitor_id);
			
			if(count($verificaReserva) > 0){
				$this->reservas_model->delete('reserva','usuario_id',$leitor_id);
			}
				 			   
			$this->session->set_flashdata('success','Empréstimos realizado com sucesso!');											
			redirect('emprestimos');
		} else{
			$this->session->set_flashdata('error','Por favor, adicione os itens a serem emprestados.');
			redirect('emprestimos/editar/'.$idEmprestimos);
		}
	}

	public function renovar(){
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
              $this->session->set_flashdata('error','Você não tem permissão para renovar o emprestimo');
              redirect(base_url());
            }	
		
		$idEmprestimos = $this->input->post('idEmprestimos');
		$status = $this->input->post('status');
		$duracao = $this->input->post('duracao_dias');
		$qtde_max_renovacao = $this->input->post('qtde_max_renovacao');
		$qtde_renovacao = $this->input->post('qtde_renovacao');		
		
		$dataRenovacao = date('d/m/Y', strtotime("+".$duracao." days"));
		$dataVencimento = strtr($dataRenovacao, '/', '-'); 		
		$dataVencimento = date('Y-m-d', strtotime($dataVencimento));
		
		
		if($qtde_renovacao > $qtde_max_renovacao){
			$this->session->set_flashdata('error','Número máximo de renovação excedido.');
			redirect('emprestimos/editar/'.$idEmprestimos);
		}else{
			$setStatus = "UPDATE emprestimos set status = '".$status."' WHERE idEmprestimos = ".$idEmprestimos;
			$this->db->query($setStatus,array($status,$idEmprestimos));
			
			$setRenovacao = "UPDATE emprestimos set qtde_renovacao = qtde_renovacao + 1 WHERE idEmprestimos = ".$idEmprestimos;
			$this->db->query($setRenovacao,array($idEmprestimos));
			
			$setDataVencimento = "UPDATE emprestimos set dataVencimento = '".$dataVencimento."' WHERE idEmprestimos = ".$idEmprestimos;
			$this->db->query($setDataVencimento,array($dataVencimento,$idEmprestimos));
			
			$this->session->set_flashdata('success','Empréstimo renovado com sucesso!.');
			redirect('emprestimos/editar/'.$idEmprestimos);
		}		
	}	
}