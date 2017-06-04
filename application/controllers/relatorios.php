<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends CI_Controller{


    
    
    public function __construct() {
        parent::__construct();
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('librecon/login');
        }
        
        $this->load->model('Relatorios_model','',TRUE);
        $this->data['menuRelatorios'] = 'Relatórios';

    }

    public function leitores(){

        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de leitores.');
           redirect(base_url());
        }
        $this->data['view'] = 'relatorios/rel_leitores';
       	$this->load->view('tema/topo',$this->data);
    }

    public function acervos(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de acervos.');
           redirect(base_url());
        }
        $this->data['view'] = 'relatorios/rel_acervos';
       	$this->load->view('tema/topo',$this->data);

    }

    public function leitoresCustom(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de leitores.');
           redirect(base_url());
        }

        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');

        $data['leitores'] = $this->Relatorios_model->leitoresCustom($dataInicial,$dataFinal);

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirClientes', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirLeitores', $data, true);
        pdf_create($html, 'relatorio_leitores' . date('d/m/y'), TRUE);
    
    }

    public function leitoresRapid(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rLeitor')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de leitores.');
           redirect(base_url());
        }

        $data['leitores'] = $this->Relatorios_model->leitoresRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirClientes', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirLeitores', $data, true);
        pdf_create($html, 'relatorio_leitores' . date('d/m/y'), TRUE);
    }

    public function acervosRapid(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de acervos.');
           redirect(base_url());
        }

        $data['acervos'] = $this->Relatorios_model->acervosRapid();
		$data['tipo'] = 1;
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirAcervos', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirAcervos', $data, true);
        pdf_create($html, 'relatorio_acervos' . date('d/m/y'), TRUE);
    }
	
	public function acervosDataAquisicao(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de acervos.');
           redirect(base_url());
        }

        $data['acervos'] = $this->Relatorios_model->acervosDataAquisicao();
		$data['tipo'] = 2;
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirAcervos', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirAcervos', $data, true);
        pdf_create($html, 'relatorio_acervos' . date('d/m/y'), TRUE);
    }

    public function acervosRapidMin(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de acervos.');
           redirect(base_url());
        }

        $data['acervos'] = $this->Relatorios_model->acervosRapidMin();
		$data['tipo'] = 3;
        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimirAcervos', $data, true);
        pdf_create($html, 'relatorio_acervos' . date('d/m/y'), TRUE);
        
    }

    public function acervosMaisEmprestados(){  	
    
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rAcervo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de acervos.');
           redirect(base_url());
        }

        $data['acervos'] = $this->Relatorios_model->acervosMaisEmprestados();
		$data['tipo'] = 4;
        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimirAcervos', $data, true);
        pdf_create($html, 'relatorio_acervos' . date('d/m/y'), TRUE);
        
    }   

    public function emprestimos(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rEmprestimo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de emprestimos.');
           redirect(base_url());
        }

        $this->data['view'] = 'relatorios/rel_emprestimos';
        $this->load->view('tema/topo',$this->data);
    }

    public function emprestimosRapid(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rEmprestimo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de emprestimos.');
           redirect(base_url());
        }
        $data['emprestimos'] = $this->Relatorios_model->emprestimosRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirEmprestimos', $data, true);
        pdf_create($html, 'relatorio_emprestimos' . date('d/m/y'), TRUE);
    }

    public function emprestimosCustom(){
        if(!$this->permission->checkPermission($this->session->userdata('permissao'),'rEmprestimo')){
           $this->session->set_flashdata('error','Você não tem permissão para gerar relatórios de emprestimos.');
           redirect(base_url());
        }
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');
        $leitor = $this->input->get('leitor');
        $usuario = $this->input->get('usuario');

        $data['emprestimos'] = $this->Relatorios_model->emprestimosCustom($dataInicial,$dataFinal,$leitor,$usuario);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirEmprestimos', $data, true);
        pdf_create($html, 'relatorio_emprestimos' . date('d/m/y'), TRUE);
    }
}
