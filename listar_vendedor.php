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
    <h2>Lista de Vendedores (Comissões)</h2>



</body>
</html>



<?php

	// Prepara e Envia a estrutura para api.php no formato GET
	// OBS: ele já chama a função dentro do api.php

	$url = "http://localhost/tray/api";

	
	$response = array();
	$result = array();
	
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	
	$result = json_decode($response);
	
	// estrutura da tabela HTML	
	echo "<table border=1>";
	echo "<tr align='center'><td>ID</td> <td>NOME</td><td>Email</td><td>Total de Comissões</td></tr>";
		foreach ( $result as $e )
		{
			echo "<tr><td>$e->id</td> <td>$e->vend_nome</td><td>$e->vend_email</td><td>R$ ".number_format($e->totalcomissao,2)."</td></tr>";
		}
	echo "</table>";
	
	
?>