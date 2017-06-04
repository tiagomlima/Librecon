<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conecte_model extends CI_Model {

    
    
	public function getLastOs($leitor){
		
		$this->db->where('leitor_id',$leitor);
		$this->db->limit(5);

		return $this->db->get('os')->result();
	}	

	public function getLastCompras($leitor){
		
		$this->db->select('vendas.*,usuarios.nome');
		$this->db->from('vendas');
		$this->db->join('usuarios', 'usuarios.idUsuarios = vendas.usuarios_id');
		$this->db->where('leitores_id',$leitor);
		$this->db->limit(5);

		return $this->db->get()->result();
	}


	public function getCompras($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array',$leitor){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('usuarios', 'vendas.usuarios_id = usuarios.idUsuarios', 'left');
        $this->db->where('leitores_id', $leitor);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }


    public function getOs($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array',$leitor){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('usuarios', 'os.usuarios_id = usuarios.idUsuarios', 'left');
        $this->db->where('leitores_id', $leitor);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    public function count($table,$leitor){
    	$this->db->where('leitores_id', $leitor);
		return $this->db->count_all($table);
	}

    public function getDados(){
        
        $this->db->where('idleitores',$this->session->userdata('id'));
        $this->db->limit(1);
        return $this->db->get('leitores')->row();
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

}

/* End of file conecte_model.php */
/* Location: ./application/models/conecte_model.php */