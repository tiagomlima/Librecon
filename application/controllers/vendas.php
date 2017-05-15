<?php
class Vendas extends CI_Controller {
    
    
    
    function __construct() {
        parent::__construct();
        
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('librecon/login');
        }
		
		$this->load->helper(array('form','codegen_helper'));
		$this->load->model('vendas_model','',TRUE);
		$this->data['menuVendas'] = 'Vendas';
	}	
	
	function index(){
		$this->gerenciar();
	}
	function gerenciar(){
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vVenda')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar vendas.');
           redirect(base_url());
        }
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/vendas/gerenciar/';
        $config['total_rows'] = $this->vendas_model->count('vendas');
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
		$this->data['results'] = $this->vendas_model->get('vendas','*','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'vendas/vendas';
       	$this->load->view('tema/topo',$this->data);
      
		
    }
	
    function adicionar(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aVenda')){
          $this->session->set_flashdata('error','Você não tem permissão para adicionar Vendas.');
          redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('vendas') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            $dataEmprestimo = $this->input->post('dataEmprestimo');
			$dataDevolucao = $this->input->post('dataDevolucao');
            try {
                
                $dataEmprestimo = explode('/', $dataEmprestimo);
                $dataEmprestimo = $dataEmprestimo[2].'-'.$dataEmprestimo[1].'-'.$dataEmprestimo[0];
				
				$dataDevolucao = explode('/', $dataDevolucao);
                $dataDevolucao = $dataDevolucao[2].'-'.$dataDevolucao[1].'-'.$dataDevolucao[0];
            } catch (Exception $e) {
               $dataEmprestimo = date('Y/m/d'); 
			   $dataDevolucao = date('Y/m/d');
            }
            $data = array(
                'dataEmprestimo' => $dataEmprestimo,
                'dataDevolucao' => $dataDevolucao,
                'leitores_id' => $this->input->post('leitores_id'),
                'usuarios_id' => $this->input->post('usuarios_id')
               
            );
            if (is_numeric($id = $this->vendas_model->add('vendas', $data, true)) ) {
                $this->session->set_flashdata('success','Venda iniciada com sucesso, adicione os acervos.');
                redirect('vendas/editar/'.$id);
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
         
        $this->data['view'] = 'vendas/adicionarVenda';
        $this->load->view('tema/topo', $this->data);
    }
    
    
    function editar() {
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
          $this->session->set_flashdata('error','Você não tem permissão para editar vendas');
          redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        if ($this->form_validation->run('vendas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $dataEmprestimo = $this->input->post('dataEmprestimo');
			$dataDevolucao = $this->input->post('dataDevolucao');
            try {
                
                $dataEmprestimo = explode('/', $dataEmprestimo);
                $dataEmprestimo = $dataEmprestimo[2].'-'.$dataEmprestimo[1].'-'.$dataEmprestimo[0];
				
				$dataDevolucao = explode('/', $dataDevolucao);
                $dataDevolucao = $dataDevolucao[2].'-'.$dataDevolucao[1].'-'.$dataDevolucao[0];
            } catch (Exception $e) {
               $dataEmprestimo = date('Y/m/d'); 
			   $dataDevolucao = date('Y/m/d'); 
            }
            $data = array(
                'dataEmprestimo' => $dataEmprestimo,
                'dataDevolucao' => $dataDevolucao,
                'usuarios_id' => $this->input->post('usuarios_id'),
                'leitores_id' => $this->input->post('leitores_id')
            );
            if ($this->vendas_model->edit('vendas', $data, 'idVendas', $this->input->post('idVendas')) == TRUE) {
                $this->session->set_flashdata('success','Venda editada com sucesso!');
                redirect(base_url() . 'index.php/vendas/editar/'.$this->input->post('idVendas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }
		
        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['acervos'] = $this->vendas_model->getAcervos($this->uri->segment(3));
        $this->data['view'] = 'vendas/editarVenda';
        $this->load->view('tema/topo', $this->data);
   
    }
    public function visualizar(){
        if(!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))){
            $this->session->set_flashdata('error','Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('librecon');
        }
        
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vVenda')){
          $this->session->set_flashdata('error','Você não tem permissão para visualizar vendas.');
          redirect(base_url());
        }
        $this->data['custom_error'] = '';
        $this->load->model('librecon_model');
        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['acervos'] = $this->vendas_model->getAcervos($this->uri->segment(3));
        $this->data['emitente'] = $this->librecon_model->getEmitente();
        
        $this->data['view'] = 'vendas/visualizarVenda';
        $this->load->view('tema/topo', $this->data);
       
    }
	
    function excluir(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dVenda')){
          $this->session->set_flashdata('error','Você não tem permissão para excluir vendas');
          redirect(base_url());
        }
        
        $id =  $this->input->post('id');
        if ($id == null){
            $this->session->set_flashdata('error','Erro ao tentar excluir venda.');            
            redirect(base_url().'index.php/vendas/gerenciar/');
        }
        $this->db->where('vendas_id', $id);
        $this->db->delete('itens_de_vendas');
        $this->db->where('idVendas', $id);
        $this->db->delete('vendas');           
        $this->session->set_flashdata('success','Venda excluída com sucesso!');            
        redirect(base_url().'index.php/vendas/gerenciar/');
    }
    public function autoCompleteAcervo(){
        
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteAcervo($q);
        }
    }
    public function autoCompleteLeitor(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteLeitor($q);
        }
    }
    public function autoCompleteUsuario(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteUsuario($q);
        }
    }
    public function adicionarAcervo(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
          $this->session->set_flashdata('error','Você não tem permissão para editar vendas.');
          redirect(base_url());
        }
		
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idAcervo', 'Acervo', 'trim|required|xss_clean');
        $this->form_validation->set_rules('idVendasAcervo', 'Vendas', 'trim|required|xss_clean');
        	
			
			
        	//$estoque = $this->input->post('estoque');
            $idVendas = $this->input->post('idVendasAcervo');
            $quantidade = $this->input->post('quantidade');
            $acervo = $this->input->post('acervos_id');
			
			
			if($acervo == null){
				$this->session->set_flashdata('error','Digite o nome do item.');
				 redirect('vendas/editar/'.$idVendas);
			}
			
			
			
            $data = array(
                'quantidade'=> $quantidade,
                'acervos_id'=> $acervo,
                'vendas_id'=> $idVendas,
            );
            if($this->vendas_model->add('itens_de_vendas', $data) == true){
                $sql = "UPDATE acervos set estoque = estoque - 1 WHERE idAcervos =".$acervo;
                $this->db->query($sql, array($quantidade, $acervo));
                redirect('vendas/editar/'.$idVendas);
               
            }else{
            	$this->session->set_flashdata('error','Não foi possível adicionar o item.');
                 redirect('vendas/editar/'.$idVendas);
            }
        
       
      
    }
    function excluirAcervo(){
            if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
              $this->session->set_flashdata('error','Você não tem permissão para editar Vendas');
              redirect(base_url());
            }
			
            $ID = $this->input->post('idAcervo');
            if($this->vendas_model->delete('itens_de_vendas','idItens',$ID) == true){
                
                $quantidade = $this->input->post('quantidade');
                $acervo = $this->input->post('acervos');
                $sql = "UPDATE acervos set estoque = estoque + 1 WHERE idAcervos =".$ID;
                $this->db->query($sql, array($quantidade, $acervo));
                
                echo json_encode(array('result'=> true));
            }
            else{
                echo json_encode(array('result'=> false));
            }           
    }
    
    public function faturar() {
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eVenda')){
              $this->session->set_flashdata('error','Você não tem permissão para editar Vendas');
              redirect(base_url());
            }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
 
        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $vencimento = $this->input->post('vencimento');
            $recebimento = $this->input->post('recebimento');
            try {
                
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2].'-'.$vencimento[1].'-'.$vencimento[0];
                if($recebimento != null){
                    $recebimento = explode('/', $recebimento);
                    $recebimento = $recebimento[2].'-'.$recebimento[1].'-'.$recebimento[0];
                }
            } catch (Exception $e) {
               $vencimento = date('Y/m/d'); 
            }
            $data = array(
                'descricao' => set_value('descricao'),
                'valor' => $this->input->post('valor'),
                'leitores_id' => $this->input->post('leitores_id'),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $recebimento,
                'baixado' => $this->input->post('recebido'),
                'leitor_fornecedor' => set_value('leitor'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => $this->input->post('tipo')
            );
            if ($this->vendas_model->add('lancamentos',$data) == TRUE) {
                
                $venda = $this->input->post('vendas_id');
                $this->db->set('faturado',1);
                $this->db->set('valorTotal',$this->input->post('valor'));
                $this->db->where('idVendas', $venda);
                $this->db->update('vendas');
                $this->session->set_flashdata('success','Venda faturada com sucesso!');
                $json = array('result'=>  true);
                echo json_encode($json);
                die();
            } else {
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar faturar venda.');
                $json = array('result'=>  false);
                echo json_encode($json);
                die();
            }
        }
        $this->session->set_flashdata('error','Ocorreu um erro ao tentar faturar venda.');
        $json = array('result'=>  false);
        echo json_encode($json);
        
    }
}