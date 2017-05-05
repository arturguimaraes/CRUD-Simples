<?php
	class pessoa {
	  
		private $id;
		private $nome; 
		private $sobrenome;
		private $CPF;
		private $dataNasc;
		
		public function __construct($id,$nome,$sobrenome,$CPF,$dataNasc) {
			$this->id 			= $id;
			$this->nome 		= $nome;
			$this->sobrenome 	= $sobrenome;
			$this->CPF 			= $CPF;
			$this->dataNasc 	= $dataNasc;
		}
		
		public function all() {
			$database = Db::getInstance();	
			$query = "SELECT *
					  FROM pessoa";
			$statement = $database->query($query);
			$statement->execute();
			$success = $statement->rowCount() >= 1 ? true : false;
			
			if($success) {
				$pessoas = $statement->fetchAll();
				$resp = array();
				foreach($pessoas as $pessoa) {
					$resp[] = new pessoa($pessoa['id'], $pessoa['nome'], $pessoa['sobrenome'], $pessoa['CPF'], $pessoa['dataNasc']);
				}
				return $resp;
			}
			else 
				return NULL;
		}	
		
		public function find($nome, $sobrenome, $CPF) {
			$database = Db::getInstance();
			//Filtros
			if(!empty($CPF)) {
				$arrayArgs = array($CPF);
				$whereFilter = "WHERE CPF = ?";
			}
			else if(!empty($nome) && !empty($sobrenome)) {
					$arrayArgs = array($nome,$sobrenome);
					$whereFilter = "WHERE nome = ?
					 				AND sobrenome = ?";	
			}
			else if (!empty($nome)) {
				$arrayArgs = array($nome);
				$whereFilter = "WHERE nome = ?";	
			}
			else if(!empty($sobrenome)) {
				$arrayArgs = array($sobrenome);
				$whereFilter = "WHERE sobrenome = ?";	
			}
			else {
				$arrayArgs = array();
				$whereFilter = "";
			}
			
			$query = "SELECT *
					  FROM pessoa
					  $whereFilter";
			$statement = $database->prepare($query);
			$statement->execute($arrayArgs);
			$success = $statement->rowCount() >= 1 ? true : false;
			
			if($success) {
				$pessoas = $statement->fetchAll();
				$resp = array();
				foreach($pessoas as $pessoa) {
					$resp[] = new pessoa($pessoa['id'], $pessoa['nome'], $pessoa['sobrenome'], $pessoa['CPF'], $pessoa['dataNasc']);
				}
				return $resp;
			}
			else 
				return NULL;
		}
		
		public function findUniqueById($id) {
			$database = Db::getInstance();
			$query = "SELECT *
					  FROM pessoa
					  WHERE id = ?
					  LIMIT 1";
			$statement = $database->prepare($query);
			$statement->execute(array($id));
			$success = $statement->rowCount() == 1 ? true : false;
			
			if($success) {
				$pessoa = $statement->fetch();
				$resp = new pessoa($pessoa['id'], $pessoa['nome'], $pessoa['sobrenome'], $pessoa['CPF'], $pessoa['dataNasc']);
				return $resp;
			}
			else 
				return NULL;
		}
		
		public function create($nome, $sobrenome, $CPF, $dataNasc) {
			$database = Db::getInstance();					
			$pessoa = pessoa::find($nome, $sobrenome, $CPF);
			//Verifica se há algum registro igual
			if($pessoa != NULL) {
				echo "<div class='alert alert-dismissible alert-danger'>
					  	  <button type='button' class='close' data-dismiss='alert'>&times;</button>
						  <strong>Já existe uma pessoa com esse CPF: $CPF</strong>
					  </div>";
			}
			else {
				//Se não, verifica se os campos estão corretamente preenchidos
				if(empty($nome) || empty($sobrenome) || empty($CPF) || empty($dataNasc)) {
					 echo "<div class='alert alert-dismissible alert-danger'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>Você não preencheu todos os campos corretamente.</strong>
					  		</div>";
				}
				//Se sim, procede com a criação
				else {
					$pessoa = new pessoa(NULL,$nome,$sobrenome,$CPF,$dataNasc);
					$query = "INSERT INTO pessoa (nome, sobrenome, CPF, dataNasc)
							  VALUES (?, ?, ?, ?)";
					$statement = $database->prepare($query);
					$statement->execute(array($pessoa->nome,$pessoa->sobrenome,$pessoa->CPF,$pessoa->dataNasc));
					$success = $statement->rowCount() == 1 ? true : false;
					if($success) {
						echo "<div class='alert alert-dismissible alert-success'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>$nome $sobrenome foi cadastrado(a) com sucesso!</strong>
					  		</div>";
						return $database->lastInsertId();
					}
					else
						echo "<div class='alert alert-dismissible alert-danger'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>Ocorreu algum erro durante o cadastro.</strong>
					  		</div>";
				}
			}
		}
		
		public function update($id, $nome, $sobrenome, $CPF, $dataNasc) {
			$pessoaVelha = pessoa::findUniqueById($id);
			$pessoaNova = pessoa::find($nome,$sobrenome,$CPF);
			
			if($pessoaVelha == null) {
				echo "<div class='alert alert-dismissible alert-danger'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>Esta pessoa não existe.</strong>
					  		</div>";
			}
			else {
				if(empty($nome) || empty($sobrenome) || empty($CPF) || empty($dataNasc)) {
					 echo "<div class='alert alert-dismissible alert-danger'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<strong>Você não preencheu todos os campos corretamente.</strong>
							</div>";
				}
				else {
					$database = Db::getInstance();
					$query = "UPDATE pessoa
							  SET nome = ?, sobrenome = ?, CPF = ?, dataNasc = ?
							  WHERE id = ?";
					$statement = $database->prepare($query);
					$statement->execute(array($nome, $sobrenome, $CPF, $dataNasc, $id));
					$success = $statement->rowCount() == 1 ? true : false;
				
					if($success) {
						echo "<div class='alert alert-dismissible alert-success'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>$pessoaVelha->nome $pessoaVelha->sobrenome foi alterado(a) corretamente.</strong>
								</div>";
						return true;
					}
					else {
						if($pessoaNova[0] == $pessoaVelha)
							echo "<div class='alert alert-dismissible alert-danger'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>Você não modificou nenhuma informação.</strong>
									</div>";
						else
							echo "<div class='alert alert-dismissible alert-danger'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>Não foi possível alterar $pessoaVelha->nome $pessoaVelha->sobrenome.</strong>
									</div>";
					}
				}
			}
			return false;
		}
		
		public function remove($id) {
			$pessoa = pessoa::findUniqueById($id);
			
			if($pessoa == null) {
				echo "<div class='alert alert-dismissible alert-danger'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>Esta pessoa não existe.</strong>
					  		</div>";
			}
			else {
				$database = Db::getInstance();
				$query = "DELETE FROM pessoa
						  WHERE id = ?";
				$statement = $database->prepare($query);
				$statement->execute(array($id));
				$success = $statement->rowCount() == 1 ? true : false;
			
				if($success) {
					echo "<div class='alert alert-dismissible alert-success'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>$pessoa->nome $pessoa->sobrenome foi removido(a) corretamente.</strong>
					  		</div>";
				}
				else {
					echo "<div class='alert alert-dismissible alert-danger'>
					  	  		<button type='button' class='close' data-dismiss='alert'>&times;</button>
						  		<strong>Não foi possível remover $pessoa->nome $pessoa->sobrenome.</strong>
					  		</div>";
				}
			}
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getNome() {
			return $this->nome;
		}
		
		public function getSobrenome() {
			return $this->sobrenome;
		}
		
		public function getCPF() {
			return $this->CPF;
		}
		
		public function getDataNasc() {
			return $this->dataNasc;
		}

	}
?>