<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
require "conexao.php";

$total_atividades = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM sms_enviados"))+200;
$id = $_GET['id'];
if($id == ''){
$id = 1;
}else{
$id = $id;
}


if($id > $total_atividades){
		echo "<script language='javascript'>window.location='professor/login.php';</script>";
}else{
	
	$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM sms_enviados WHERE id = '$id' AND status = 'AGUARDA'");
	if(mysqli_num_rows($sql_atividade) == ''){ 
		$id++;
		echo "<script language='javascript'>window.location='?id=$id';</script>";
	}else{
		while($res_sms = mysqli_fetch_array($sql_atividade)){
			
			$telefone = $res_sms['telefone'];
			$mensagem = $res_sms['mensagem'];
		
		
						$curl = curl_init();
						curl_setopt_array($curl, array(
						  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone&msg=".urlencode("$mensagem"),
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "GET",
						  CURLOPT_SSL_VERIFYHOST => 0,
						  CURLOPT_SSL_VERIFYPEER => 0,
						));
						
						$response = curl_exec($curl);
						$err = curl_error($curl);
						
						curl_close($curl);
						
						if ($err) {
						} else {
						}		
		
		mysqli_query($conexao_bd, "UPDATE sms_enviados SET status = 'ENVIADO' WHERE id = '$id'");			

		$id++;
		echo "<script language='javascript'>window.location='?id=$id';</script>";
			
		}
	}
	
}// if que verifica se o ID é maior que o número de atividades
?>
</body>
</html>