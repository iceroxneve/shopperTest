<?php require_once('model/modelClient.php'); ?>
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='style.css'>
		
		<meta charset='UTF-8'>
		<title>Cadastro de clientes</title>		
	</head>
		<body>
		<div class='container'>
			<form class='formMain' method='POST' action='model/modelClient.php'>
				<label>Nome:</label>
					<input type='text' name='txt_nomeCli' class='txt_nomeCli'>
				
				<label>Idade:</label>
					<input type='text' name='txt_idadeCli'>
				<label>RG:</label>
					<input type='text' name='txt_rgCli'>
				<label>Endereço:</label>
					<input type='text' name='txt_endCli'>
				<label>CEP:</label>
					<input type='text' name='txt_cepCli'>
				<br><br>
				<input type='submit' value='CADASTRAR' name='btn_insertClient'>
				<input type='submit' class='btnDelete' value='REMOVER' name='btn_deleteClient'>
				<div class='deleteTip'><b>Para excluir um cliente, escolha um nome da lista e clique em remover.</b></div>
				<input class='updateBtn'type='submit' value='ATUALIZAR' name='btn_updateClient'>
				<div class='updateTip'><b>Para atualizar um dado de cliente, escolha um nome da lista e altere os dados conforme desejar.</b></div>
				
			</form>
	<form method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>		
		<input type='submit' class='adjust' value='LISTAR TODOS CLIENTES' name='btn_selectClient'>
	</div>

      
	  <table class='clientResults' border='1px'>
	  <form method='post'>
		<input type='text' name='searchFocus'>
		<input class='btnSearch' type='submit' name='btnSearch' value='PESQUISAR CLIENTES POR NOME'>
	  </form>
	  
	  <tr>
		  <th> NOME </th>
		  <th> IDADE </th>
		  <th> RG </th>
		  <th> ENDERECO </th>
		  <th> CEP </th>
	  </tr>	  
<?php listClients();?>

	 
	      
	  </table>
	 
		

	  </body>
</html>
