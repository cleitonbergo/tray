<?php
	//CONEXÃO
	include("connection.php");
	
	$db = new dbObj();
	$connection =  $db->getConnstring();

	$request_method=$_SERVER["REQUEST_METHOD"];
	
	$php_self=$_SERVER["PHP_SELF"];
	
	
		

	
	switch($request_method)
	{
		case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_vendas($id);   // FUNÇÃO VENDAS E VENDEDOR
			}
			else{
				get_vendedor();
			}
			break;
			
			
		case 'POST':
			insert_vendedor(); // FUNÇÃO INSERIR VENDEDOR
			break;
		
		
		case 'PUT':
			insert_vendas(); // FUNÇÃO INSERIR VENDAS
			break;
		
		
		default:
			header("HTTP/1.0 405 Método não permitido");
			break;
	}




function get_vendedor() #PUXA OS DADOS DA TABELA VENDEDOR, 
	{
		global $connection;
		
		$query="SELECT id,vend_nome,vend_email, sum(total_comissao) as totalcomissao FROM vendedor 
				GROUP BY id";
		
		$result=mysqli_query($connection, $query);
		
		while($row=mysqli_fetch_array($result))
		{
			$response[] = array("id" => $row['id'], "vend_nome" => $row['vend_nome'], "vend_email" => $row['vend_email'], "totalcomissao" => $row['totalcomissao']);
			
		}
		header('Content-Type: application/json');
			echo json_encode($response);
	}
	






	
function get_vendas($id) #PUXA OS DADOS DA TABELA VENDAS COM A CONDIÇÃO DO ID 
{
	global $connection;
	
	if($id != 0)
	{
		$query = "SELECT vendas.id,vendas.id_vendedor, vendas.nome, vendas.email, vendas.val_venda, vendas.comissao, vendas.data_venda, vendedor.vend_nome FROM vendas
				INNER JOIN vendedor 
				ON vendas.id_vendedor = vendedor.id
				where vendas.id_vendedor = ".$id."";
	}
	
	$response=array();
	$result=mysqli_query($connection, $query);
	
	while($row=mysqli_fetch_array($result))
		{
			$response[] = array("id_vendedor" => $row['id_vendedor'],"nome" => $row['nome'],"email" => $row['email'],"val_venda" => $row['val_venda'],"comissao" => $row['comissao'],"data_venda" => $row['data_venda']);
			
		}
	header('Content-Type: application/json');
	echo json_encode($response);
}




function insert_vendedor() #É INSERIDO NA TABELA VENDEDOR
	{
		global $connection;

		$data = json_decode(file_get_contents('php://input'), true);
		$vend_nome=$data["vend_nome"];
		$vend_email=$data["vend_email"];
		
		$query="INSERT INTO vendedor SET vend_nome='".$vend_nome."', vend_email='".$vend_email."'";
		
		mysqli_query($connection,$query);
		
		
		header('Content-Type: application/json');
		echo json_encode($response);
	}


function insert_vendas() #É INSERIDO NA TABELA VENDAS E ATUALIDO O TOTAL DE COMISSÃO NA TABELA VENDEDOR
	{
		global $connection;
		
		$data = json_decode(file_get_contents('php://input'), true);
		$id_vendedor	=$data["id_vendedor"];
		$valor_venda	=(float)$data["valor"];
		
		$comissao = $valor_venda / 100 * 8.5; 
		
		$data_venda = date('Y-m-d', strtotime(date("Y-m-d")));
		
		$queryVendedor = mysqli_fetch_object(mysqli_query($connection,"SELECT * FROM vendedor WHERE id = $id_vendedor"));
		$vend_nome = $queryVendedor->vend_nome;
		$vend_email = $queryVendedor->vend_email;
		
	
		$queryvendas="INSERT INTO vendas SET id_vendedor=".$id_vendedor.", 
											nome='". $vend_nome ."', 
											email='". $vend_email ."',
											comissao=". $comissao .",
											val_venda=". $valor_venda .",
											data_venda='". $data_venda ."'";
											
		#Total comissão 
		$selectcomissao	= mysqli_fetch_object(mysqli_query($connection, "SELECT SUM(total_comissao) as comissao FROM vendedor WHERE id = ".$id_vendedor.""));
		$totalcomissao = $selectcomissao->comissao + $comissao;
		
		$queryvendedor="UPDATE vendedor SET total_comissao=".$totalcomissao."
											WHERE id = ".$id_vendedor."";
		
		mysqli_query($connection,$queryvendas);
		mysqli_query($connection,$queryvendedor);
		
		header('Content-Type: application/json');
		echo json_encode($response);
	}



?>
