<?php
//CONEXÃO
include("connection.php");
$db = new dbObj();
$connection =  $db->getConnstring();

//SET Horario de SP
date_default_timezone_set('America/Sao_Paulo');



$data_atual = date("Y-m-d");

// Consulta na base de dados
$query = "SELECT SUM(val_venda) as valor_total FROM VENDAS WHERE data_venda = '".$data_atual."'";

// Executar a query
$result = mysqli_query($connection, $query);
	
while($row=mysqli_fetch_object($result))
{
	$valor_total = $row->valor_total; // Guardar o resultado
}
		
	
$mensagem ="O valor total das vendas de hoje é de: R$ " . number_format($valor_total,2);

?>

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
    <h2>Relatório de Vendas (<?php echo date("d-m-Y"); ?>)</h2>
	<br />
	
	<?php echo "<h3>".$mensagem."</h3>"; ?>
	
<form action="relatorio.php?enviar_relatorio=" method="GET">
	<br /><br /><br />
	
	<?php if(date("H:i:s") >= date("H:i:s",strtotime("17:45:00"))){ ?>
	
		<input type="submit" name="enviar_relatorio" value="Enviar">
		
	<?php } 
	else{
		echo "<p style='color: red;'>O botão para envio de email sera liberado após as 17:45:00</p>";
	}?>
	<br /><br />
</form>

</body>
</html>

<?php

	
	
if(isset($_GET['enviar_relatorio'])){

	//Carrega as classes do PHPMailer
	include("phpmailer/class.phpmailer.php"); 
	include("phpmailer/class.smtp.php"); 
		

	//Configurar o PHPMailer
	$mail = new PHPMailer();
	$mail->IsSMTP(); 
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.gmail.com"; // SMTP servers
	$mail->Port = 587; 
	$mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
	$mail->Username = "cleiton.bergo@gmail.com"; // SMTP username
	$mail->Password = "xxx"; // SMTP password
	$mail->From = "cleiton.bergo@gmail.com"; // Remetente
	$mail->FromName = "Empressa" ; // Nome de quem envia o email
	$mail->AddAddress("cleiton.bergo@gmail.com", "Cleiton"); // Email e nome de quem receberá //Responder
	$mail->WordWrap = 50; // Definir quebra de linha
	$mail->IsHTML = true ; // Enviar como HTML
	$mail->Subject = "Relatório Diário" ; // Assunto
	$mail->Body = $mensagem ; //Corpo da mensagem caso seja HTML

	// Envia o email
	if($mail->Send()) 
	{	
		echo "<script>alert('E-mail enviado com sucesso!')</script>";
	}
	else
	{
		echo "<script>alert('Erro no envio da mensagem')</script>";
	}


}
?>