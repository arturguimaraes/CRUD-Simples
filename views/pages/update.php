<!------------------------------------------------ FORM ------------------------------------------------>
<form id="updateForm" class="form-horizontal" method="post">
  <fieldset>
    <legend>Atualizar</legend>
    <div class="form-group col-lg-5">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus value="<?php echo $pessoa->getNome(); ?>">
        <br><input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="<?php echo $pessoa->getSobrenome(); ?>">
        
    </div> 
    <div class="form-group col-lg-2"></div> 
    <div class="form-group col-lg-5">
    	<input type="text" class="form-control" id="CPF" name="CPF" placeholder="CPF (xxx.xxx.xxx-xx)" maxlength="14" value="<?php echo $pessoa->getCPF(); ?>">
    	<br><input type="text" class="form-control" id="dataNasc" name="dataNasc" placeholder="Data de Nascimento (dd/mm/aaaa)" maxlength="10" value="<?php echo $pessoa->getDataNasc(); ?>">
   	</div>
    <div class="form-group col-lg-12">
        <button type="submit" class="btn btn-danger" name="cancel">Cancelar</button>
        <button type="reset" class="btn btn-success" name="reset">Limpar</button>
        <button type="submit" class="btn btn-primary" name="submit">Atualizar</button>
    </div>    
  </fieldset>
</form>
<!------------------------------------------------ SCRIPTS ------------------------------------------------>
<script>
	$('#CPF', '#updateForm')

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
	
	$('#dataNasc', '#updateForm')

	.keydown(function (e) {
		var key = e.charCode || e.keyCode || 0;
		$phone = $(this);

		// Auto-format- do not expose the mask as the user begins to type
		if (key !== 8 && key !== 9) {
			if ($phone.val().length === 2) {
				$phone.val($phone.val() + '/');
			}
			if ($phone.val().length === 5) {
				$phone.val($phone.val() + '/');
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
