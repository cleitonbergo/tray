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
    <h2>Listar Vendas do Vendedor</h2>

<form action="" method="GET">
	<label>ID do vendedor:</label><br />
	<input type="text" name="id" placeholder="ID" />
	<button type="submit" name="submit">Pesquisar</button>
	<br /><br />
</form>

</body>
</html>



<?php


// Prepara e Envia a estrutura para api.php no formato GET
if (isset($_GET['id']) && $_GET['id']!="") {
	$id_vendedor = $_GET['id'];
	$url = "http://localhost/tray/api.php?id=".$id_vendedor."&submit=";
	
	$response = array();
	$result = array();
	
	$client = curl_init($url);
	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($client);
	
	
	$result = json_decode($response);
	
	if($result){
	
	// estrutura da tabela HTML	
	echo "<table border=1>";
	echo "<tr align='center'><td>ID</td> <td>NOME</td><td>Email</td><td>Valor Venda</td><td>Comissão</td><td>Data Venda</td></tr>";
		foreach ( $result as $e )
		{
			echo "<tr>
					<td>$e->id_vendedor</td> 
					<td>$e->nome</td>
					<td>$e->email</td>
					<td>R$ ".number_format($e->val_venda,2)."</td>
					<td>R$ ".number_format($e->comissao,2)."</td>
					<td>".date("d-m-Y",strtotime($e->data_venda))."</td>
				</tr>";
		}
	echo "</table>";
	
	
	}
	else{
		echo "Nenhum Registro Encontrado";
	}
}
    ?>