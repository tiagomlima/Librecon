<?php

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
        $this->data['menuReservas'] = 'Reservas';
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

		$this->data['results'] = $this->reservas_model->get('reserva','idReserva,usuario_id,dataReserva,dataPrazo,dataRetirada,status','',$config['per_page'],$this->uri->segment(3));
        $this->data['leitor'] = $this->reservas_model->getLeitor($config['per_page'],$this->uri->segment(3));
		$this->data['autor'] = $this->reservas_model->getAutor($config['per_page'],$this->uri->segment(3));
		$this->data['editora'] = $this->reservas_model->getEditora($config['per_page'],$this->uri->segment(3));
		$this->data['acervo'] = $this->reservas_model->getAcervo($config['per_page'],$this->uri->segment(3));
	    $this->data['view'] = 'reservas/reservas';
       	$this->load->view('tema/topo',$this->data);

       
		
    }

	function editar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
           $this->session->set_flashdata('error','Você não tem permissão para editar reservas.');
           redirect(base_url());
        }
      /*  $this->load->library('form_validation');
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
		
		if($this->session->userdata('tipo_usuario') != 1){
			redirect('librecon');
		}
		
		$itens = $this->db->get('itens_de_reserva')->row();
		$idReserva = $this->input->post('idReserva');	
		
		if(count($itens) > 0){
			//atualiza o status da reserva
			$sql = "UPDATE reserva set status = 'Reservado' WHERE idReserva =".$idReserva;
            $this->db->query($sql, array($idReserva));
			
			$this->session->set_flashdata('success','Reserva realizada com sucesso!');											
			redirect('reservas/editar/'.$idReserva);
		}
			$this->session->set_flashdata('error','Por favor, adicione os itens a serem reservados.');
			redirect('reservas/editar/'.$idReserva);
	}
	
	function cancelar(){
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva')){
              $this->session->set_flashdata('error','Você não tem permissão para reservar');
              redirect(base_url());
            }
				
		$usuario_id = $this->session->userdata('id');
		$reserva_id = $this->reservas_model->getReservaById($usuario_id);
		
		$itens = $this->db->get('itens_de_reserva')->row();
		
		if(count($itens) <= 0){
			$this->reservas_model->delete('reserva','usuario_id',$usuario_id);
			
			$this->session->set_flashdata('success','Reserva cancelada com sucesso.');											
			redirect(base_url().'index.php/acervos');
		}else{
			$this->reservas_model->delete('reserva','usuario_id',$usuario_id);
			
			$this->reservas_model->delete('itens_de_reserva','reserva_id',$reserva_id->idReserva);
			$this->session->set_flashdata('success','Reserva cancelada com sucesso.');											
			redirect(base_url().'index.php/acervos');
		}
		
		if($reserva_id->status != 'Retirado'){ // se o status não for devolvido, acrescenta o(s) item(s) de volta ao estoque e exclui o Emprestimo
				// pega todos os ids dos acervos inclusos no itens de emprestimo		
			$sql = "SELECT group_concat(acervos_id separator ',') as id FROM `itens_de_reserva` WHERE reserva_id = ".$reserva_id->idReserva;
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
																		
		$this->session->set_flashdata('success','Reserva cancelada com sucesso.');											
		redirect(base_url().'index.php/acervos');
	}

	function recusar(){
		if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eReserva') or $this->session->userdata('tipo_usuario') != 0){
              $this->session->set_flashdata('error','Você não tem permissão para fazer isso');
              redirect(base_url());
            }
		
		$idReserva = $this->input->post('idReserva');
		$status = 'Recusado';
		
		$data = array(
			'status' => $status
		);
		
		if($this->reservas_model->edit('reserva',$data,'idReserva',$idReserva) == true){
			$this->session->set_flashdata('success','Reserva recusada com sucesso.');											
			redirect(base_url().'index.php/reservas');
		} else {
			$this->session->set_flashdata('error','Ocorreu um erro.');											
			redirect(base_url().'index.php/reservas');
		}
		
		
	}
}

