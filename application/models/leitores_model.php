<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Leitores_model extends CI_Model {

    
    
    function __construct() {
        parent::__construct();
    }
	
	function getPermissao($perpage=0,$start=0,$one=false){
        
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissoes');
        $this->db->limit($perpage,$start);
        $this->db->join('permissoes', 'usuarios.permissoes_id = permissoes.idPermissao', 'left');
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getCurso($perpage=0,$start=0,$one=false){
        
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, cursos.nomeCurso as curso');
        $this->db->limit($perpage,$start);
        $this->db->join('cursos', 'usuarios.curso_id = cursos.idCursos', 'left');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	function getActive($table,$fields){
        
        $this->db->select($fields);
        $this->db->from($table);
		$this->db->where('tipo_usuario',1);
        $query = $this->db->get();
        return $query->result();;
    }
	
	function getGrupo($perpage=0,$start=0,$one=false){
        
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, grupos.nomeGrupo as grupo');
        $this->db->limit($perpage,$start);
        $this->db->join('grupos', 'usuarios.grupo_id = grupos.idGrupo', 'left');
  		$this->db->limit(1);
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
		
        $this->db->order_by('idUsuarios','desc');
		$this->db->where('tipo_usuario',1);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }
	
	
    function getById($id){
        $this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        return $this->db->get('usuarios')->row();
    }
	
	function getCursoById($id){
		$this->db->select('usuarios.curso_id, cursos.nomeCurso as curso');
		$this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        $this->db->join('cursos', 'usuarios.curso_id = cursos.idCursos', 'left');
		return $this->db->get('usuarios')->row();
	}
	
	function getGrupoById($id){
		$this->db->select('usuarios.grupo_id, grupos.nomeGrupo as grupo');
		$this->db->where('idUsuarios',$id);
		$this->db->limit(1);
		$this->db->join('grupos', 'usuarios.grupo_id = grupos.idGrupo', 'left');
		return $this->db->get('usuarios')->row();
	}
	
	function getPermissaoById($id){
		$this->db->select('usuarios.permissoes_id, permissoes.nome as curso');
		$this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        $this->db->join('permissoes', 'usuarios.permissoes_id = permissoes.idPermissao', 'left');
		return $this->db->get('usuarios')->row();
	}
	
	function pesquisar($termo){
         $data = array();

         // buscando produtos
         $this->db->like('titulo',$termo);
         $this->db->limit(5);
         $data['acervos'] = $this->db->get('acervos')->result();

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
    
    public function getEmprestimosByLeitor($id){
        $this->db->where('leitor_id',$id);
        $this->db->order_by('idEmprestimos','desc');
        $this->db->limit(10);
        return $this->db->get('emprestimos')->result();
    }
	
	public function getReservasByLeitor($id){
        $this->db->where('usuario_id',$id);
        $this->db->order_by('idReserva','desc');
        $this->db->limit(1);
        return $this->db->get('reserva')->result();
    }
	
	public function editImg($id, $img){
        
        $this->db->set('img_leitor', $img); 
        $this->db->where('idUsuarios', $id);
        return $this->db->update('usuarios'); 
         
    }
	
	function pesquisarLeitor($nome,$curso,$grupo,$matricula,$status){
         $data = array();
		 
		 if($status != null){
		 	if($status == 'Multado'){
		 		$this->db->where('multa',1);
				$data['usuarios'] = $this->db->get('usuarios')->result();
				return $data;
		 	}
			if($status == 'Inativo'){
				$this->db->where('situacao',0);
				$data['usuarios'] = $this->db->get('usuarios')->result();
				return $data;
			}
		 }else{
		 	// buscando leitores
	         $this->db->like('nome',$nome);
			 $this->db->like('curso_id',$curso);
			 $this->db->like('grupo_id',$grupo);
			 $this->db->like('matricula',$matricula);
	         $this->db->limit(5);
	         $data['usuarios'] = $this->db->get('usuarios')->result();
	       
	         return $data;
			
		 }
               
    }
	
	function verificaMulta($leitor){
		$this->db->where('idUsuarios',$leitor);
		$this->db->where('multa',1);
		$multa = $this->db->get('usuarios')->row();
		
		if(count($multa) > 0){
			return true;
		}else{
			return false;
		}
		
	}

	function getDuracaoMulta($leitor){
		$this->db->where('idUsuarios',$leitor);
		$usuario = $this->db->get('usuarios')->row();
		$idGrupo = $usuario->grupo_id;
		
		$this->db->where('idGrupo',$idGrupo);
		$grupo = $this->db->get('grupos')->row();
		$multa = $grupo->multa;
		
		return $multa;
	}	
	
	function verificaAtraso($leitor){
		$this->db->where('leitor_id',$leitor);
		$this->db->where('status != ','Devolvido');
		$this->db->where('dataVencimento <',date('Y-m-d'));
		$atraso = $this->db->get('emprestimos')->row();
		
		if(count($atraso) > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function aplicarMulta($leitor,$data){
		$this->db->query("UPDATE usuarios set multa = 1, dataMulta = '".$data."' WHERE idUsuarios = ".$leitor);
		return true;
	}
	
	function finalizarMulta($leitor){
		$this->db->query("UPDATE usuarios set multa = 0, dataMulta = NULL WHERE idUsuarios = ".$leitor);
		return true;
	}
	
	function verificaVencimentoMulta($leitor){
		$this->db->where('idUsuarios',$leitor);
		$this->db->where('multa',1);
		$leitor = $this->db->get('usuarios')->row();
		
		$dataAtual = date('Y-m-d H:i:s');
		
		if($dataAtual > $leitor->dataMulta){
			$this->finalizarMulta($leitor);
			return true;
		}else{
			return false;
		}
	}
	
	function verificaAtrasoGeral(){
		$dataAtual = date('Y-m-d');
		$this->db->where('status != ','Devolvido');
		$this->db->where('dataVencimento < ',$dataAtual);
		$emprestimos = $this->db->get('emprestimos')->result();
		
		if($contagem = count($emprestimos) > 0){
			foreach ($emprestimos as $e){
				$multa = $this->getDuracaoMulta($e->leitor_id);
				$data = date('Y-m-d H:i:s', strtotime("+ ".$multa." days"));
				$this->aplicarMulta($e->leitor_id, $data);
				return true;
			}
		}else{
			return false;
		}		
	}
}