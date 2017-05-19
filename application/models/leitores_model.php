<?php
class Leitores_model extends CI_Model {

    
    
    function __construct() {
        parent::__construct();
    }
	
	function getCurso($perpage=0,$start=0,$one=false){
        
        $this->db->from('leitores');
        $this->db->select('leitores.*, cursos.nomeCurso as curso');
        $this->db->limit($perpage,$start);
        $this->db->join('cursos', 'leitores.curso_id = cursos.idCursos', 'left');
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();;
    }
	
	function getGrupo($perpage=0,$start=0,$one=false){
        
        $this->db->from('leitores');
        $this->db->select('leitores.*, grupos.nomeGrupo as grupo');
        $this->db->limit($perpage,$start);
        $this->db->join('grupos', 'leitores.grupo_id = grupos.idGrupo', 'left');
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idLeitores','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	
    function getById($id){
        $this->db->where('idLeitores',$id);
        $this->db->limit(1);
        return $this->db->get('leitores')->row();
    }
	
	function getCursoById($id){
		$this->db->select('leitores.curso_id, cursos.nomeCurso as curso');
		$this->db->where('idLeitores',$id);
        $this->db->limit(1);
        $this->db->join('cursos', 'leitores.curso_id = cursos.idCursos', 'left');
		return $this->db->get('leitores')->row();
	}
	
	function getGrupoById($id){
		$this->db->select('leitores.grupo_id, grupos.nomeGrupo as grupo');
		$this->db->where('idLeitores',$id);
		$this->db->limit(1);
		$this->db->join('grupos', 'leitores.grupo_id = grupos.idGrupo', 'left');
		return $this->db->get('leitores')->row();
	}
	
	function pesquisar($termo){
         $data = array();

         // buscando produtos
         $this->db->like('descricao',$termo);
         $this->db->limit(5);
         $data['produtos'] = $this->db->get('produtos')->result();

         return $data;


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
    
    public function getOsByLeitor($id){
        $this->db->where('leitores_id',$id);
        $this->db->order_by('idOs','desc');
        $this->db->limit(10);
        return $this->db->get('os')->result();
    }

}