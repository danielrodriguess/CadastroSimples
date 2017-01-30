<?php
	require_once 'crud.php';

	class usuario extends crud{	
		protected $table = 'usuario';
		private $nome;
		private $email;

		public function setNome($nome){
			$this->nome = $nome;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function insert(){
			$sql  = "INSERT INTO $this->table (nome, email) VALUES (:nome, :email)";
			$stmt = DB::prepara($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			return $stmt->execute(); 

		}

		public function update($id){
			$sql  = "UPDATE $this->table SET nome = :nome, email = :email WHERE id = :id";
			$stmt = DB::prepara($sql);
			$stmt->bindParam(':nome', $this->nome);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':id', $id);
			return $stmt->execute();
		}
	}
?>