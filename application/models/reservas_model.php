<?php
class Reservas_model extends CI_Model {


    
    
    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('idReserva','desc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->where('idReserva',$id);
        $this->db->limit(1);
        return $this->db->get('reserva')->row();
    }
	
	function getLeitor($perpage=0,$start=0,$one=false){
        
        $this->db->from('reserva');
        $this->db->select('reserva.*, usuarios.nome as leitor');
        $this->db->limit($perpage,$start);
        $this->db->join('usuarios', 'reserva.usuario_id = usuarios.idUsuarios', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getAcervo($perpage=0,$start=0,$one=false){
        
        $this->db->from('reserva');
        $this->db->select('reserva.*, acervos.titulo as acervo');
        $this->db->limit($perpage,$start);
        $this->db->join('acervos', 'reserva.acervos_id = acervos.idAcervos', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getAutor($perpage=0,$start=0,$one=false){
        
        $this->db->from('reserva');
        $this->db->select('reserva.*, autor.autor as autor');
        $this->db->limit($perpage,$start);
        $this->db->join('autor', 'reserva.acervos_id = acervos.idAcervos', 'left');
        $this->db->limit(1);
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
	
	function count($table){
		return $this->db->count_all($table);
	}
}