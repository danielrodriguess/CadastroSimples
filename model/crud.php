<?php
	require_once 'db.php';

	class crud extends db{
		protected $table;

		public function find($id){
			$sql  = "SELECT * FROM $this->table WHERE id = :id";
			$stmt = db::prepara($sql);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			return $stmt->fetch();
		}

		public function findAll(){
			$sql  = "SELECT * FROM $this->table";
			$stmt = db::prepara($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function delete($id){
			$sql  = "DELETE FROM $this->table WHERE id = :id";
			$stmt = db::prepara($sql);
			$stmt->bindParam(':id', $id);
			return $stmt->execute(); 
		}
	}
?>