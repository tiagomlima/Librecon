<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Acervos_model extends CI_Model {

    
    
    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idAcervos','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	
	function verificaAcervo($reserva_id,$acervos_id){
		$this->db->select('*');
		$this->db->from('itens_de_reserva');
		$this->db->where('reserva_id',$reserva_id);
		$this->db->where('acervos_id',$acervos_id);
		$this->db->limit(1);
		return $this->db->get()->row();
	}
	
	function getAutor($perpage=0,$start=0,$one=false){
        
        $this->db->from('acervos');
        $this->db->select('acervos.*, autor.idAutor, autor.autor as autor');
        $this->db->limit($perpage,$start);
        $this->db->join('autor', 'acervos.autor_id = autor.idAutor', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getAutorById($id){
		$this->db->select('acervos.autor_id, autor.autor as autor');
		$this->db->where('idAcervos',$id);
        $this->db->limit(1);
        $this->db->join('autor', 'acervos.autor_id = autor.idAutor', 'left');
		return $this->db->get('acervos')->row();
	}
	
	function getCategoriaById($id){
		$this->db->select('acervos.categoria_id, categoria.nomeCategoria as categoria');
		$this->db->where('idAcervos',$id);
        $this->db->limit(1);
        $this->db->join('categoria', 'acervos.categoria_id = categoria.idCategoria', 'left');
		return $this->db->get('acervos')->row();
	}
	
	function getEditora($perpage=0,$start=0,$one=false){
        
        $this->db->from('acervos');
        $this->db->select('acervos.*, editora.editora as editora');
        $this->db->limit($perpage,$start);
        $this->db->join('editora', 'acervos.editora_id = editora.idEditora', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getEditoraById($id){
		$this->db->select('acervos.editora_id, editora.editora as editora');
		$this->db->where('idAcervos',$id);
        $this->db->limit(1);
        $this->db->join('editora', 'acervos.editora_id = editora.idEditora', 'left');
		return $this->db->get('acervos')->row();
	}

	function getColecaoById($id){
		$this->db->select('acervos.colecao_id, colecao.colecao as colecao');
		$this->db->where('idAcervos',$id);
        $this->db->limit(1);
        $this->db->join('colecao', 'acervos.colecao_id = colecao.idColecao', 'left');
		return $this->db->get('acervos')->row();
	}

    function getById($id){
        $this->db->where('idAcervos',$id);
        $this->db->limit(1);
        return $this->db->get('acervos')->row();
    }
	
	function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();;
    }
	
	function getReserva($id,$acervos_id){
		$this->db->select('*');
		$this->db->from('reserva');
		$this->db->like('acervos_id', $acervos_id);
		$this->db->where('usuario_id',$id);
		return $this->db->get()->row();
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
	
	public function editImg($id, $img){
        
        $this->db->set('img_acervo', $img); 
        $this->db->where('idAcervos', $id);
        return $this->db->update('acervos'); 
         
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
	
	function pesquisar($nome,$autor,$categoria,$palavra_chave){
         $data = array();
         
         // buscando acervos
         $this->db->like('titulo',$nome);
		 $this->db->like('autor_id',$autor);
		 $this->db->like('categoria_id',$categoria);
		 $this->db->like('palavra_chave',$palavra_chave);
         $this->db->limit(5);
         $data['acervos'] = $this->db->get('acervos')->result();
       
         return $data;

    }
}