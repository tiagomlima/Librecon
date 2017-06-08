<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emprestimos_model extends CI_Model {

    

	function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields.', usuarios.nome, usuarios.idUsuarios');
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        $this->db->join('usuarios', 'usuarios.idUsuarios = '.$table.'.leitor_id');//mudei aqui, usuarios_id para leitor_id
        $this->db->order_by('idEmprestimos','desc');
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	

    function getLeitorById($id){
    	
        $this->db->select('emprestimos.*, usuarios.*');
        $this->db->from('emprestimos');
        $this->db->join('usuarios','usuarios.idUsuarios = emprestimos.leitor_id');
        $this->db->where('emprestimos.idEmprestimos',$id);
        $this->db->limit(1);
        return $this->db->get()->row();      
        
        
    }
	
	function getById($id){
        $this->db->select('emprestimos.*, usuarios.telefone, usuarios.email,usuarios.nome');
        $this->db->from('emprestimos');
        $this->db->join('usuarios','usuarios.idUsuarios = emprestimos.usuarios_id');
        $this->db->where('emprestimos.idEmprestimos',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }
	
	function getEmprestimoById($id){
		$this->db->select('*');
		$this->db->from('emprestimos');
		$this->db->where('leitor_id',$id);
		$this->db->limit(1);
		return $this->db->get()->result();
	}

    public function getAcervos($id){
        $this->db->select('itens_de_emprestimos.*, acervos.*');
        $this->db->from('itens_de_emprestimos');
        $this->db->join('acervos','acervos.idAcervos = itens_de_emprestimos.acervos_id');
        $this->db->where('emprestimos_id',$id);
		
        return $this->db->get()->result();
    }
	
	public function getAcervosById($id){
        $this->db->select('itens_de_emprestimos.*, acervos.*');
        $this->db->from('itens_de_emprestimos');
        $this->db->join('acervos','acervos.idAcervos = itens_de_emprestimos.acervos_id');
        $this->db->where('emprestimos_id',$id);
		
        return $this->db->get()->row();
    }
	
	function getGrupoById($id){
		$this->db->select('emprestimos.grupo_id, grupos.*');
		$this->db->where('idEmprestimos',$id);
		$this->db->limit(1);
		$this->db->join('grupos', 'emprestimos.grupo_id = grupos.idGrupo', 'left');
		return $this->db->get('emprestimos')->row();
	}
	

	function getCursoById($id){
		$this->db->select('emprestimos.*, usuarios.*, cursos.idCursos, cursos.nomeCurso');
        $this->db->from('emprestimos');
        $this->db->join('usuarios','usuarios.idUsuarios = emprestimos.leitor_id');
        $this->db->join('cursos','cursos.idCursos = usuarios.curso_id');
        $this->db->where('emprestimos.idEmprestimos',$id);
        $this->db->limit(1);
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
        $this->db->like('nome', $q);
		$this->db->where('tipo_usuario',1);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'].' | R.A: '.$row['matricula'],'id'=>$row['idUsuarios'],'grupo'=>$row['grupo_id']);
            }
            echo json_encode($row_set);
        }
    }
	
	public function autoCompleteItem($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('idItens', $q);
        $query = $this->db->get('itens_de_emprestimos');
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
        $this->db->where('tipo_usuario',0);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'].' | Telefone: '.$row['telefone'],'id'=>$row['idUsuarios']);
            }
            echo json_encode($row_set);
        }
    }

	public function pesquisar($nome = null, $dataInicial = null,$dataFinal = null,$status = null){
		$data = array();
		$likeNome = "";
		$whereData = "";
		$whereStatus = "";
		
		if($dataInicial != null){
			$whereData = "AND dataEmprestimo BETWEEN '".$dataInicial."' AND '".$dataFinal."'";
		}	
		
		if($nome != null){
			$likeNome = " AND usuarios.nome LIKE '%".$nome."%'";
		}
		
		if($status != null){
			if($status != 'Atrasado'){
				
				$whereStatus = "AND emprestimos.status = ".$this->db->escape($status);
			}else{
				$dataAtual = date('Y-m-d');
				$whereStatus = "AND emprestimos.dataVencimento < ".$this->db->escape($dataAtual)." AND status != 'Devolvido'";
			}		
		}
		
		$query = "SELECT emprestimos.*, usuarios.* from emprestimos inner join usuarios on emprestimos.leitor_id = usuarios.idUsuarios WHERE idEmprestimos != 0 ".$likeNome." ".$whereData." ".$whereStatus." " ;
		$data['emprestimos'] = $this->db->query($query)->result();
		return $data;
    }

}

/* End of file emprestimos_model.php */
/* Location: ./application/models/emprestimos_model.php */