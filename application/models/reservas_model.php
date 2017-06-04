<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

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
		    

   /* function getById($id){
        $this->db->where('idReserva',$id);
        $this->db->limit(1);
        return $this->db->get('reserva')->row();
    }*/
    
    function getById($id){
        $this->db->select('reserva.*, usuarios.telefone, usuarios.email,usuarios.nome');
        $this->db->from('reserva');
        $this->db->join('usuarios','usuarios.idUsuarios = reserva.usuario_id');
        $this->db->where('reserva.idReserva',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
	
	function getReservaById($id){
		$this->db->select('*');
		$this->db->from('reserva');
		$this->db->where('usuario_id',$id);
		$this->db->limit(1);
		return $this->db->get()->result();
	}
	
	function getReservaRetirado($id){
		$this->db->select('*');
		$this->db->from('reserva');
		$this->db->where('idReserva',$id);
		$this->db->where('status','Retirado');
		$this->db->limit(1);
		return $this->db->get()->row();
	}
			
	
	function getLeitorById($id){
    	
        $this->db->select('reserva.*, usuarios.*');
        $this->db->from('reserva');
        $this->db->join('usuarios','usuarios.idUsuarios = reserva.usuario_id');
        $this->db->where('reserva.idReserva',$id);
        $this->db->limit(1);
        return $this->db->get()->row();      
        
        
    }
	
	function getLeitor($perpage=0,$start=0,$one=false){
        
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, reserva.idReserva');
        $this->db->limit($perpage,$start);
        $this->db->join('reserva', 'usuarios.idUsuarios = reserva.usuario_id', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	public function getAcervos($id){
        $this->db->select('itens_de_reserva.*, acervos.*');
        $this->db->from('itens_de_reserva');
        $this->db->join('acervos','acervos.idAcervos = itens_de_reserva.acervos_id');
        $this->db->where('reserva_id',$id);		
        return $this->db->get()->result();
    }
	
	public function getAcervosById($id){
        $this->db->select('itens_de_reserva.*, acervos.*');
        $this->db->from('itens_de_reserva');
        $this->db->join('acervos','acervos.idAcervos = itens_de_reserva.acervos_id');
        $this->db->where('reserva_id',$id);	
         return $this->db->get()->result();
    }
	
	
	function getAcervo($perpage=0,$start=0,$one=false){
        
        $this->db->from('itens_de_reserva');
        $this->db->select('itens_de_reserva.*, acervos.titulo as acervo, acervos.idAcervos as id');
        $this->db->limit($perpage,$start);
        $this->db->join('acervos', 'itens_de_reserva.acervos_id = acervos.idAcervos', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	
	function getAutor($perpage=0,$start=0,$one=false){
        
        $this->db->from('acervos');
        $this->db->select('acervos.*, autor.autor as autor');
        $this->db->limit($perpage,$start);
        $this->db->join('autor', 'acervos.autor_id = autor.idAutor', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
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