<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CRUD Simples</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-default">
            <div class="container">
               <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" onclick="return false;" href="javascript:void(0)">CRUD Simples</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                   <ul class="nav navbar-nav">
                        <li><a href="?controller=pages&action=search">Buscar</a></li>
                    	<li><a href="?controller=pages&action=create">Cadastrar</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </div>
		<!--CONTEÚDO DA PÁGINA VAI APARECER AQUI-->
		<div class="container">	
			<?php
				require_once('config/routes.php');	
			?>
		</div>
	</body>
</html>