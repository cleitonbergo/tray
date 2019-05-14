<html>
<head></head>
<body>

    <nav>
		<a href="index.php">Home</a> | 
      <a href="inserir_vendedor.php">Inserir Vendedor</a> | 
	  <a href="listar_vendedor.php">Listar Vendedores</a> | 
	  <a href="inserir_vendas.php">Lançar Vendas</a> | 
	  <a href="listar_vendas.php">Listar Vendas</a> |
	  <a href="relatorio.php">Relatório Diário</a> 
    </nav>
    <h2>Inserir Vendas</h2>

<form action="" method="POST">
	<label>Id Vendedor:</label>
	<input type="text" name="id_vendedor" placeholder="id_vendedor" required/>
	<br />
	<label>Valor:</label>
	<input type="text" name="valor" placeholder="valor" required/>
	<br /><br />
	<button type="submit" name="submit">Inseir</button>
</form>

</body>
</html>



<?php

// Prepara e Envia a estrutura para api.php no formato PUT
if (isset($_POST['id_vendedor']) && $_POST['id_vendedor']!="") {
	
	$id_vendedor = $_POST['id_vendedor'];
	$valor = $_POST['valor'];

	$data = array("id_vendedor" => $id_vendedor, "valor" => $valor);
	$data_string = json_encode($data);                                                                                   

	$ch = curl_init('http://localhost/tray/api');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                   

	$result = curl_exec($ch);
	
	
	if($result){
		echo "Venda adicionado com sucesso.";
	}
	else{
		echo "Adição Falhou";
	}
		
 }

	

?>