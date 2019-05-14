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
    <h2>Inserir Vendedor</h2>

<form action="" method="POST">
	<label>Nome:</label>
	<input type="text" name="nome" placeholder="nome" required/>
	<br />
	<label>E-mail:</label>
	<input type="text" name="email" placeholder="email" required/>
	<br /><br />
	<button type="submit" name="submit">Inseir</button>
</form>

</body>
</html>



<?php


// Prepara e Envia a estrutura para api.php no formato POST
if (isset($_POST['nome']) && $_POST['nome']!="") {
	$nome = $_POST['nome'];
	$email = $_POST['email'];

	$data = array("vend_nome" => $nome, "vend_email" => $email);
	$data_string = json_encode($data);                                                                                   

	$ch = curl_init('http://localhost/tray/api');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string))
	);                                                                                                                   

	$result = curl_exec($ch);
	
	
	if($result){
		echo "Vendedor adicionado com sucesso.";
	}
	else{
		echo "Adição Falhou";
	}
		
 }
	

?>