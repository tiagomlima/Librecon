<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendas_model extends CI_Model {

    

	function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields.', leitores.nomeLeitor, leitores.idLeitores');
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        $this->db->join('leitores', 'leitores.idLeitores = '.$table.'.leitores_id');
        $this->db->order_by('idVendas','desc');
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->select('vendas.*, leitores.*, usuarios.telefone, usuarios.email,usuarios.nome');
        $this->db->from('vendas');
        $this->db->join('leitores','leitores.idLeitores = vendas.leitores_id');
        $this->db->join('usuarios','usuarios.idUsuarios = vendas.usuarios_id');
        $this->db->where('vendas.idVendas',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
	
	

    public function getAcervos($id){
        $this->db->select('itens_de_vendas.*, acervos.*');
        $this->db->from('itens_de_vendas');
        $this->db->join('acervos','acervos.idAcervos = itens_de_vendas.acervos_id');
        $this->db->where('vendas_id',$id);
		
        return $this->db->get()->result();
    }
	
    function add($table,$data,$returnId = false){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
                        if($returnId == true){
                            return $this->db->insert_id($table);
                        }
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
	

    function count($table){
	return $this->db->count_all($table);
    }

    public function autoCompleteAcervo($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('titulo', $q);
        $query = $this->db->get('acervos');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['titulo'].' | Tombo: '.$row['tombo'].' | Estoque: '.$row['estoque'], 'id'=>$row['idAcervos'], 'estoque'=>$row['estoque']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteLeitor($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nomeLeitor', $q);
        $query = $this->db->get('leitores');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nomeLeitor'].' | Telefone: '.$row['telefone'],'id'=>$row['idLeitores']);
            }
            echo json_encode($row_set);
        }
    }
	
	public function autoCompleteItem($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('idItens', $q);
        $query = $this->db->get('itens_de_vendas');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['idItens'].' | Quantidade: '.$row['quantidade']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteUsuario($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $this->db->where('situacao',1);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'].' | Telefone: '.$row['telefone'],'id'=>$row['idUsuarios']);
            }
            echo json_encode($row_set);
        }
    }



}

/* End of file vendas_model.php */
/* Location: ./application/models/vendas_model.php */