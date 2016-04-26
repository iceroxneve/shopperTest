<?php
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);

//Conexão com a base de dados
function dbConnection()
{
		$host='localhost';
		$user='root';
		$pw='';
		$dbName='shopper_db';
		
		$con = mysqli_connect($host,$user,$pw,$dbName) or die(mysqli_error($con));
		return $con;
}	

//Função que retornará todos os dados da tabela em um array	
function checkAllClients()
{
	$arrayClients = array();
	
	$con = dbConnection();
		$execListQry = mysqli_query($con,"SELECT * FROM clientes");
		while($row = mysqli_fetch_array($execListQry))
			array_push($arrayClients,$row);
		
		return $arrayClients;
}	

//Listagem de clientes conforme o botão selecionado na página de visualização
function listClients()
{
		$con = dbConnection();
		if(isset($_POST['btnSearch']))
		{
			
		$execListQry = mysqli_query($con,"SELECT * FROM clientes WHERE NOME LIKE '%{$_POST['searchFocus']}%'") or die (mysqli_error($con));
		while($row = mysqli_fetch_array($execListQry))
		{
			echo "	
			 <tr>
				  <td> {$row['NOME']} </td>
				  <td> {$row['IDADE']} </td>
				  <td> {$row['RG']} </td>
				  <td> {$row['ENDERECO']} </td>
				  <td> {$row['CEP']} </td>
			";
		}
		
		}
		else
		{
			$execListQry = mysqli_query($con,"SELECT * FROM clientes");
			while($row = mysqli_fetch_array($execListQry))
			{
				echo "	
				 <tr>
					  <td> {$row['NOME']} </td>
					  <td> {$row['IDADE']} </td>
					  <td> {$row['RG']} </td>
					  <td> {$row['ENDERECO']} </td>
					  <td> {$row['CEP']} </td>
				";
			}
		}
	
}
//Inserção de clientes verificando sua existência na base de dados
function insertClient($clientName,$clientAge,$clientRG,$clientAddress,$clientCep)
{	
	$con = dbConnection();
	
	
	
	mysqli_query($con,"INSERT INTO clientes (NOME,IDADE,RG,ENDERECO,CEP) 
							  VALUES ('{$clientName}',
							  '{$clientAge}',
							  '{$clientRG}',
							  '{$clientAddress}',
							  '{$clientCep}')");
	echo'<script>alert("Cliente ' . $clientName.' cadastrado com sucesso!");</script>';
	header("refresh:1;url=../index.php");
	
	
}

//Deleção de clientes tendo nome como parâmetro
function deleteClient($clientName)
{
	$con = dbConnection();
	mysqli_query($con,"DELETE FROM clientes WHERE NOME='{$clientName}'");
	echo'<script>alert("Cliente '. $clientName .' removido com sucesso!");</script>';
	header("refresh:1;url=../index.php");
}

//Atualização de clientes tendo nome como parãmetro
function updateClient($nClientName,$nClientAge,$nClientRg,$nClientAddress,$nClientCep)
{
	$con = dbConnection();
	
	$search = mysqli_query($con,"SELECT * FROM clientes WHERE RG = '{$nClientRg}'");
	$result = mysqli_fetch_assoc($search);
	
	if($result['RG'] == $nClientRg)
	{
		echo '<h1> Novos Dados </h2>';
		echo '<h2>Nome:' . $nClientName. '<br>'; 
		echo 'Idade :' . $nClientAge. '<br>'; 
		echo 'RG :' . $nClientRg .'<br>'; 
		echo 'Endereço :' . $nClientAddress . '<br>'; 
		echo 'CEP :' . $nClientCep. '<br>'; 
		
		echo '<h1>	Antigos Dados </h2>';
		echo '<h2>Nome:' . $result['NOME']. '<br>'; 
		echo 'Idade :' . $result['IDADE'] . '<br>'; 
		echo 'RG :' . $result['RG'] .'<br>'; 
		echo 'Endereço :' . $result['ENDERECO'] . '<br>'; 
		echo 'CEP :' . $result['CEP'] .'<br>'; 
	
	}
	else
	{
			echo'<script>alert("RG : '. $nClientRg.' não encontrado!");</script>';
			header("refresh:1;location:../index.php");
	}
	
	
	mysqli_query($con,"UPDATE clientes SET NOME='{$nClientName}', IDADE='{$nClientAge}', 
		RG='{$nClientRg}', ENDERECO = '{$nClientAddress}', CEP='{$nClientCep} 'WHERE RG='{$nClientRg}'") or die (mysqli_error($con));
			header("refresh:6;url=../index.php");
	
}

//Início de verificações de qual função será acionada
	if(isset($_POST['btn_insertClient']))
	{	
		$clientName = $_POST['txt_nomeCli'];
		$clientAge = $_POST['txt_idadeCli'];
		$clientRG = $_POST['txt_rgCli'];
		$clientAddress = $_POST['txt_endCli'];
		$clientCep = $_POST['txt_cepCli'];
		
		//Padronizar base de dados para melhor compreensão de dados
		$clientName = strtoupper($clientName);
		$clientAddress = strtoupper($clientAddress);
		
		insertClient($clientName,$clientAge,$clientRG,$clientAddress,$clientCep);
		
		
		//Chama a função responsável pela inserção
		
	} 
	else if (isset($_POST['btn_deleteClient']))
	{
		$clientName = $_POST['txt_nomeCli'];
		$arrayClients = checkAllClients();
		
		if (in_array('$clientName',$arrayClients))
		{
		  echo "<script>
					alert('Cliente inexistente');
					window.history.back();
				</script>";
		 
		}
		else
		{
			deleteClient($clientName);
		}
	}
	else if (isset($_POST['btn_updateClient']))
	{
		$clientName = $_POST['txt_nomeCli'];
		$nClientName = $_POST['txt_nomeCli'];
		$nClientAge = $_POST['txt_idadeCli'];
		$nClientRg = $_POST['txt_rgCli'];
		$nClientAddress = $_POST['txt_endCli'];
		$nClientCep = $_POST['txt_cepCli'];
		
		updateClient($nClientName,$nClientAge,$nClientRg,$nClientAddress,$nClientCep);
	}

?>



