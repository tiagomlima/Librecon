<?php
class Disciplinas_model extends CI_Model {


    
    
    function __construct() {
        parent::__construct();
    }

    

    function get($perpage=0,$start=0,$one=false){
        
        $this->db->from('disciplinas');
        $this->db->select('disciplinas.*, cursos.nomeCurso as curso');
        $this->db->limit($perpage,$start);
        $this->db->join('cursos', 'disciplinas.curso_id = cursos.idCursos', 'left');
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    /* function getAllTipos(){
        $this->db->where('situacao',1);
        return $this->db->get('tiposUsuario')->result();
    }*/

    function getById($id){
        $this->db->where('idDisciplina',$id);
        $this->db->limit(1);
        return $this->db->get('disciplinas')->row();
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
	
	function count($table){
		return $this->db->count_all($table);
	}
}