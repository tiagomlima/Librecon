<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/


class Reservas extends CI_Controller {
    

    
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('reservas_model', '', TRUE);
		$this->load->model('autor_model', '', TRUE);
		$this->load->model('editora_model', '', TRUE);
		$this->load->model('acervos_model', '', TRUE);
		$this->load->model('leitores_model', '', TRUE);
        $this->data['menuReservas'] = 'Reservas';
		
		date_default_timezone_set('America/Sao_Paulo');
    }
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar reservas.');
           redirect(base_url());
        }	
		
		$idReserva = $this->reservas_model->getReservaById($this->session->userdata('id'));
		
		/*if($this->session->userdata('tipo_usuario') == 1){
			redirect(base_url().'index.php/reservas/editar/'.$idReserva->idReserva);
		}*/

        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/reservas/gerenciar/';
        $config['total_rows'] = $this->reservas_model->count('reserva');
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
		
		$this->data['reservas'] = $this->reservas_model->getReservaById($this->session->userdata('id'));
		$this->data['results'] = $this->reservas_model->get('reserva','idReserva,usuario_id,dataReserva,dataPrazo,status','',$config['per_page'],$this->uri->segment(3));
        $this->data['leitor'] = $this->reservas_model->getLeitor($config['per_page'],$this->uri->segment(3));
		$this->data['autor'] = $this->reservas_model->getAutor($config['per_page'],$this->uri->segment(3));
		$this->data['editora'] = $this->reservas_model->getEditora($config['per_page'],$this->uri->segment(3));
		$this->data['acervo'] = $this->reservas_model->getAcervo($config['per_page'],$this->uri->segment(3));
	    $this->data['view'] = 'reservas/reservas';
       	$this->load->view('tema/topo',$this->data);

       
		
    }
	
	function adicionar(){
		
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aReserva')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar reservas.');
          redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('reserva') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            
			$usuario_id = $this->input->post('usuario_id');
			
			$this->db->where('usuario_id',$usuario_id);
			$reserva = $this->db->get('reserva')->row();
			
			if(count($reserva) > 0){
				$this->session->set_flashdata('error','Esse leitor já possui uma reserva aberta.');
                redirect('reservas/adicionar');
			}
			
			$grupo_id = $this->input->post('grupo_id');
			
			$this->db->where('idGrupo',$grupo_id);
			$grupo = $this->db->get('grupos')->row();
			$validade_reserva = $grupo->validade_reserva;
			
			$dataPrazo = date('Y-m-d H:i:s', strtotime("+".$validade_reserva." days"));
			
            $data = array(
                'dataReserva' => $this->input->post('dataReserva'),
                'dataPrazo' => $dataPrazo,
                'usuario_id' => $usuario_id,
                'status' => $this->input->post('status'),
                'qtde_item' => 0
               
            );
            if (is_numeric($id = $this->reservas_model->add('reserva', $data, true)) ) {
                $this->session->set_flashdata('success','Reserva iniciada com sucesso, adicione os acervos.');
                redirect('reservas/editar/'.$id);
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'reservas/adicionarReserva';
        $this->load->view('tema/topo', $this->data);
    }

	public function adicionarAcervo(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
          $this->session->set_flashdata('error','Você não tem permissão para editar reservas.');
          redirect(base_url());
        }		               				
			
            $idReserva = $this->input->post('idReservaAcervo');
            $qtde_max_reserva = $this->input->post('qtde_max_reserva');
			$qtde_atual = $this->input->post('qtde_atual');
            $acervo = $this->input->post('acervos_id');
			$exemplar = $this->input->post('idExemplar');
			
			if($qtde_atual > $qtde_max_reserva){
				$this->session->set_flashdata('error','O limite de itens por reserva foi excedido.');
				 redirect('reservas/editar/'.$idReserva);
			}
						
			if($acervo == null){
				$this->session->set_flashdata('error','Digite o nome do item.');
				 redirect('reservas/editar/'.$idReserva);
			}
												
            $data = array(              
                'acervos_id'=> $acervo,
                'reserva_id'=> $idReserva,
                'exemplar_id' => $exemplar
            );
            if($this->reservas_model->add('itens_de_reserva', $data) == true){              				
				$this->db->query("UPDATE reserva set qtde_item = qtde_item  + 1 WHERE idReserva = ".$idReserva);
				$this->db->query("UPDATE exemplares set status = 1 WHERE idExemplar = ".$exemplar);
				
				$this->session->set_flashdata('success','Item adicionado com sucesso'); 
                redirect('reservas/editar/'.$idReserva);
               
            }else{
            	$this->session->set_flashdata('error','Não foi possível adicionar o item.');
                 redirect('reservas/editar/'.$idReserva);
            }               
      
    }

	function editar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para editar reservas.');
           redirect(base_url());
        }
		/*
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        if ($this->form_validation->run('servicos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",","", $preco);
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'preco' => $preco
            );
            if ($this->reservas_model->edit('reserva', $data, 'idReserva', $this->input->post('idReserva')) == TRUE) {
                $this->session->set_flashdata('success', 'Reserva editada com sucesso!');
                redirect(base_url() . 'index.php/reservas/editar/'.$this->input->post('idReserva'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }*/
		$this->data['leitor'] = $this->reservas_model->getLeitorById($this->uri->segment(3));
        $this->data['result'] = $this->reservas_model->getById($this->uri->segment(3));
		$this->data['acervos'] = $this->reservas_model->getAcervos($this->uri->segment(3));
		$this->data['autores'] = $this->reservas_model->getAutor($this->uri->segment(3));
		$this->data['editoras'] = $this->reservas_model->getEditora($this->uri->segment(3));
        $this->data['view'] = 'reservas/editarReserva';
        $this->load->view('tema/topo', $this->data);
    }	
	
    function excluir(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para excluir reservas.');
           redirect(base_url());
        }
       
        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir reserva.');            
            redirect(base_url().'index.php/reservas/gerenciar/');
        }     

        $this->reservas_model->delete('reserva','idReserva',$id);             
        

        $this->session->set_flashdata('success','Reserva excluida com sucesso!');            
        redirect(base_url().'index.php/reservas/gerenciar/');
    }
	
	function excluirAcervo(){
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
              $this->session->set_flashdata('error','Você não tem permissão para editar reservas');
              redirect(base_url());
            }
			
            $ID = $this->input->post('idAcervo');
            $idReserva = $this->input->post('idReserva');
            if($this->reservas_model->delete('itens_de_reserva','idItem',$ID) == true){
                
               
                $acervo = $this->input->post('acervo');
                $sql = "UPDATE acervos set estoque = estoque + 1 WHERE idAcervos =".$acervo;
                $this->db->query($sql, array($acervo));
				
				$delQtde = "UPDATE reserva set qtde_item = qtde_item - 1 WHERE idReserva = ".$idReserva;
				$this->db->query($delQtde, array($idReserva));
                
                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }           
    }
	
	function reservar(){
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
              $this->session->set_flashdata('error','Você não tem permissão para reservar');
              redirect(base_url());
            }
								
		$idReserva = $this->input->post('idReserva');	
		$itens = $this->reservas_model->getAcervos($idReserva);
		
		if(count($itens) > 0){
			
			if(count($itens) > 3){
				$this->session->set_flashdata('error','Limite de acervos por reserva excedido (limite: 3)');
              redirect('reservas/editar/'.$idReserva);
			}
			
			//atualiza o status da reserva
			$sql = "UPDATE reserva set status = 'Reservado' WHERE idReserva =".$idReserva;
            $this->db->query($sql, array($idReserva));
			
			$this->session->set_flashdata('success','Reserva realizada com sucesso!');											
			redirect('reservas/editar/'.$idReserva);
		}else{
			$this->session->set_flashdata('error','Por favor, adicione os itens a serem reservados.');
			redirect('reservas/editar/'.$idReserva);
		}
			
	}
		
	function cancelar(){
		
		$usuario_id = $this->uri->segment(3);

		$this->db->select('idReserva');
		$this->db->where('usuario_id',$usuario_id);
	    $reserva = $this->db->get('reserva')->row();
		
		//verifica se existe alguma reserva feita pelo leitor
		if($reserva != null){
			
			$this->db->where('reserva_id',$reserva->idReserva);
			$itens = $this->db->get('itens_de_reserva')->result();
			
			//verifica se há itens na lista de reserva
			if($itens != null){
				//se sim, acrescenta o item de volta ao estoque 
							
				$this->reservas_model->delete('itens_de_reserva','reserva_id',$reserva->idReserva);
			}
									
			if($this->reservas_model->delete('reserva','usuario_id',$usuario_id)){
				$this->session->set_flashdata('success','Reserva cancelada com sucesso');											
				redirect('reservas/gerenciar');
			} else{
				$this->session->set_flashdata('error','Erro ao cancelar reserva');
				redirect(current_url());
			}
		}
				
	}
	
	function recusar($idReserva){
		
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dReserva') or $this->session->userdata('tipo_usuario') != 0){
              $this->session->set_flashdata('error','Você não tem permissão para fazer isso');
              redirect(base_url());
            }
		
		$this->db->where('reserva_id',$idReserva);
		$reserva = $this->db->get('itens_de_reserva')->result();
		
		foreach($reserva as $r){
			$exemplar = $r->exemplar_id;
			
			$this->db->query("UPDATE exemplares set status = 0 WHERE idExemplar = ".$exemplar);
		}
											
		$this->reservas_model->delete('reserva','idReserva',$idReserva);
		$this->reservas_model->delete('itens_de_reserva','reserva_id',$idReserva);	
		
		$this->session->set_flashdata('success','Reserva recusada com sucesso.');											
		redirect(base_url().'index.php/reservas');
	}
}

