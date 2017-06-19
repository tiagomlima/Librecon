<?php

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

class Librecon_model extends CI_Model {

    
    
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

    function getById($id){
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, permissoes.nome as permissao');
        $this->db->join('permissoes', 'permissoes.idPermissao = usuarios.permissoes_id', 'left');
        $this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function alterarSenha($senha,$oldSenha,$id){

        $this->db->where('idUsuarios', $id);
        $this->db->limit(1);
        $usuario = $this->db->get('usuarios')->row();

        $oldSenha = $this->encrypt->sha1($oldSenha);
        if($usuario->senha != $oldSenha){
            return false;
        }
        else{
            $this->db->set('senha',$this->encrypt->sha1($senha));
            $this->db->where('idUsuarios',$id);
            return $this->db->update('usuarios');    
        }

        
    }

    function pesquisar($termo){
         $data = array();
         // buscando leitores
         $this->db->like('nome',$termo);
		 $this->db->where('tipo_usuario',1);
         $this->db->limit(5);
         $data['usuarios'] = $this->db->get('usuarios')->result();

         // buscando emprestimos
         $this->db->like('idEmprestimos',$termo);
         $this->db->limit(5);
         $data['emprestimos'] = $this->db->get('emprestimos')->result();

         // buscando acervos
         $this->db->like('titulo',$termo);
         $this->db->limit(5);
         $data['acervos'] = $this->db->get('acervos')->result();

         //buscando reservas
         $this->db->like('usuario_id',$termo);
         $this->db->limit(5);
         $data['reservas'] = $this->db->get('reserva')->result();

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
	
	function count($table){
		return $this->db->count_all($table);
	}

    function getEmprestimosAbertos(){
        $this->db->select('emprestimos.*, usuarios.nome');
        $this->db->from('emprestimos');
        $this->db->join('usuarios', 'usuarios.idUsuarios = emprestimos.leitor_id');
        $this->db->where('emprestimos.status','Emprestado');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
	
	function getReservasAbertas(){
        $this->db->select('reserva.*, usuarios.nome');
        $this->db->from('reserva');
        $this->db->join('usuarios', 'usuarios.idUsuarios = reserva.usuario_id');
        $this->db->where('reserva.status','Reservado');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

   function getAcervosMinimo(){  

        $sql = "SELECT * FROM acervos WHERE estoque <= 1 LIMIT 10"; 
        return $this->db->query($sql)->result();

    }

    function getEmpEstatisticas(){
        $sql = "SELECT status, COUNT(status) as total FROM emprestimos GROUP BY status ORDER BY status";
        return $this->db->query($sql)->result();
    }

    public function getEmitente()
    {
        return $this->db->get('emitente')->result();
    }

    public function addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$site, $logo){
       
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('site', $site);
       $this->db->set('url_logo', $logo);
       return $this->db->insert('emitente');
    }


    public function editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf,$telefone,$site){
        
       $this->db->set('nome', $nome);
       $this->db->set('cnpj', $cnpj);
       $this->db->set('ie', $ie);
       $this->db->set('rua', $logradouro);
       $this->db->set('numero', $numero);
       $this->db->set('bairro', $bairro);
       $this->db->set('cidade', $cidade);
       $this->db->set('uf', $uf);
       $this->db->set('telefone', $telefone);
       $this->db->set('site', $site);
       $this->db->where('id', $id);
       return $this->db->update('emitente');
    }


    public function editLogo($id, $logo){
        
        $this->db->set('url_logo', $logo); 
        $this->db->where('id', $id);
        return $this->db->update('emitente'); 
         
    }
}