<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Relatorios_model extends CI_Model {


    
    
    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }

    function count($table) {
        return $this->db->count_all($table);
    }
    
    public function leitoresCustom($dataInicial = null,$dataFinal = null){
        
        if($dataInicial == null || $dataFinal == null){
            $dataInicial = date('Y-m-d');
            $dataFinal = date('Y-m-d');
        }
        $query = "SELECT * FROM usuarios WHERE dataCadastro BETWEEN ? AND ? AND tipo_usuario = 1";
        return $this->db->query($query, array($dataInicial,$dataFinal))->result();
    }

    public function leitoresRapid(){
        $this->db->order_by('nome','asc');
		$this->db->where('tipo_usuario',1);
        return $this->db->get('usuarios')->result();
    }

    public function acervosRapid(){
        $this->db->order_by('titulo','asc');
        return $this->db->get('acervos')->result();
    }

    public function acervosRapidMin(){
        $this->db->order_by('titulo','asc');
        $this->db->where('estoque <= 1');
        return $this->db->get('acervos')->result();
    }
	
	public function acervosDataAquisicao(){
        $this->db->order_by('dataAquisicao','desc');
        return $this->db->get('acervos')->result();
    }

    public function acervosCustom($precoInicial = null,$precoFinal = null,$estoqueInicial = null,$estoqueFinal = null){
        $wherePreco = "";
        $whereEstoque = "";
        if($precoInicial != null){
            $wherePreco = "AND precoVenda BETWEEN ".$this->db->escape($precoInicial)." AND ".$this->db->escape($precoFinal);
        }
        if($estoqueInicial != null){
            $whereEstoque = "AND estoque BETWEEN ".$this->db->escape($estoqueInicial)." AND ".$this->db->escape($estoqueFinal);
        }
        $query = "SELECT * FROM acervos WHERE estoque >= 0 $wherePreco $whereEstoque";
        return $this->db->query($query)->result();
    }
	
	public function acervosMaisEmprestados(){
		$query = "SELECT COUNT(emprestimos_id) as total, acervos.*
				  FROM itens_de_emprestimos
				  INNER JOIN acervos ON itens_de_emprestimos.acervos_id = acervos.idAcervos
				  GROUP BY acervos_id
				  ORDER BY total DESC";
				  
		return $this->db->query($query)->result();
	}   
         
    public function emprestimosRapid(){
        $this->db->select('emprestimos.*,usuarios.nome');
        $this->db->from('emprestimos');
        $this->db->join('usuarios','usuarios.idUsuarios = emprestimos.leitor_id');
		$this->db->where('status','Devolvido');
        return $this->db->get()->result();
    }


    public function emprestimosCustom($dataInicial = null,$dataFinal = null,$leitor = null,$usuario = null){
        $whereData = "";
        $whereLeitor = "";
        $whereUsuario = "";
        $whereStatus = "";
        if($dataInicial != null){
            $whereData = "AND dataEmprestimo BETWEEN ".$this->db->escape($dataInicial)." AND ".$this->db->escape($dataFinal);
        }
        if($leitor != null){
            $whereCliente = "AND leitor_id = ".$this->db->escape($leitor);
        }
        if($usuario != null){
            $whereResponsavel = "AND usuarios_id = ".$this->db->escape($usuario);
        }
       
        $query = "SELECT emprestimos.*,usuarios.nome FROM emprestimos LEFT JOIN usuarios ON emprestimos.leitor_id = usuarios.idUsuarios  WHERE idEmprestimos != 0 $whereData $whereLeitor $whereUsuario";
        return $this->db->query($query)->result();
    }
}