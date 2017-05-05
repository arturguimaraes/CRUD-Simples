<?php
	class PagesController {		
		
		public function search() {
			require_once('models/pessoa.php');
			if (isset($_POST['submit'])) {
				$todosOsResultados = "O resultado da sua pesquisa:";
				$pessoas = pessoa::find($_POST['nome'], $_POST['sobrenome'], $_POST['CPF']);	
			}
			elseif (isset($_POST['cancel'])) {
				header ("Location: index.php");
			}
			else {
				$todosOsResultados = "Todos as pessoas no sistema:";
				$pessoas = pessoa::all();
			}
			if($pessoas == NULL)
				$todosOsResultados = "Não há nenhum resultado.";
			require_once('views/pages/search.php');
		}

		public function create() {
			if (isset($_POST['submit'])) {
				require_once('models/pessoa.php');
				$pessoa = pessoa::create($_POST['nome'], $_POST['sobrenome'], $_POST['CPF'], $_POST['dataNasc']);
			}
			elseif (isset($_POST['cancel'])) {
				header ("Location: index.php");
			}
			require_once('views/pages/create.php');
		}
		
		public function update() {
			require_once('models/pessoa.php');
			if (isset($_POST['submit'])) {
				
				$success = pessoa::update($_GET['id'], $_POST['nome'], $_POST['sobrenome'], $_POST['CPF'], $_POST['dataNasc']);
				if($success)
					header ("Location: index.php");
			}
			elseif (isset($_POST['cancel'])) {
				header ("Location: index.php");
			}
			$pessoa = pessoa::findUniqueById($_GET['id']);
			if($pessoa == NULL)
				header ("Location: index.php?controller=pages&action=error");
			else
				require_once('views/pages/update.php');
		}
		
		public function remove() {
			if (!isset($_GET['id']))
        		return call('pages', 'error');
			require_once('models/pessoa.php');
			pessoa::remove($_GET['id']);
			$todosOsResultados = "Todos as pessoas no sistema:";
			$pessoas = pessoa::all();
			require_once('views/pages/search.php');
		}
		
		public function error() {
			require_once('views/pages/error.php');
		}
	}
?>