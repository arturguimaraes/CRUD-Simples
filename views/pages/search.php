<!------------------------------------------------ FORM ------------------------------------------------>
<form id="searchForm" class="form-horizontal" method="post">
  <fieldset>
    <legend>Buscar</legend>
    <div class="form-group col-lg-5">
        Procure por Nome e Sobrenome:
        <br><br><input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus onFocus="busca('nome')">
        <br><input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" onFocus="busca('nome')">
    </div> 
    <div class="form-group col-lg-2"></div> 
    <div class="form-group col-lg-5">
       	Procure por CPF:
        <br><br><input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF (xxx.xxx.xxx-xx)" onFocus="busca('cpf')" maxlength="14" style="background:#ddd;">
    	<br><button type="submit" class="btn btn-danger" name="cancel">Cancelar</button>
        <button type="submit" class="btn btn-primary" name="submit">Buscar</button>
    </div>    
  </fieldset>
</form>
<!------------------------------------------------ SCRIPTS ------------------------------------------------>
<script>
	function busca(tipo) {
		switch (tipo) {
			case 'cpf':
				document.getElementById('nome').value = "";
				document.getElementById('nome').style.background = "#ddd";
				document.getElementById('sobrenome').value = "";
				document.getElementById('sobrenome').style.background = "#ddd";
				document.getElementById('CPF').style.background = "#fff";
				break
			case 'nome':
			default:
				document.getElementById('nome').style.background = "#fff";
				document.getElementById('sobrenome').style.background = "#fff";
				document.getElementById('CPF').value = "";
				document.getElementById('CPF').style.background = "#ddd";
				break;
		}
	}	
	$('#CPF', '#searchForm')

	.keydown(function (e) {
		var key = e.charCode || e.keyCode || 0;
		$phone = $(this);

		// Auto-format- do not expose the mask as the user begins to type
		if (key !== 8 && key !== 9) {
			if ($phone.val().length === 3) {
				$phone.val($phone.val() + '.');
			}
			if ($phone.val().length === 7) {
				$phone.val($phone.val() + '.');
			}			
			if ($phone.val().length === 11) {
				$phone.val($phone.val() + '-');
			}
		}

		// Allow numeric (and tab, backspace, delete) keys only
		return (key == 8 || 
				key == 9 ||
				key == 46 ||
				(key >= 48 && key <= 57) ||
				(key >= 96 && key <= 105));	
	})
	
	.bind('focus click', function () {
		
			var val = $phone.val();
			$phone.val('').val(val); // Ensure cursor remains at the end
	});
</script>
<!------------------------------------------------ PHP ------------------------------------------------>
<div class="col-lg-12">
	<?php echo $todosOsResultados; ?>	
</div>
<?php if($pessoas != NULL) {?>
<table class="table table-striped table-hover ">
 	<thead>
    	<tr>
      		<th>ID</th>
      		<th>Nome</th>
      		<th>Sobrenome</th>
      		<th>CPF</th>
            <th>Data de Nascimento</th>
      		<th>Atualizar</th>
      		<th>Remover</th>
    	</tr>
  	</thead>
  	<tbody>
<?php foreach($pessoas as $pessoa) {?>
        <tr>
            <td><?php echo $pessoa->getId(); ?></td>
            <td><?php echo $pessoa->getNome(); ?></td>
            <td><?php echo $pessoa->getSobrenome(); ?></td>
            <td><?php echo $pessoa->getCPF(); ?></td>
            <td><?php echo $pessoa->getDataNasc(); ?></td>
            <td><a class="btn btn-warning" href="?controller=pages&action=update&id=<?php echo $pessoa->getId(); ?>">Atualizar</a></td>
            <td><a class="btn btn-danger" href="?controller=pages&action=remove&id=<?php echo $pessoa->getId(); ?>">Remover</a></td>
            
        </tr>
<?php } ?>
        </tbody>
    </table>
<?php }?> 
			