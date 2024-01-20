<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	color: #333;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
</head>

<body>
<?
$arquivo = $_GET['arquivo_artividade'];
$aluno = @$_GET['aluno'];
$atividade = @$_GET['atividade'];
require "../../conexao.php";
?>

<table width="850" border="0">
  <tr>
    <td width="385" bgcolor="#CCCCCC"><strong>Aluno</strong></td>
    <td width="163" bgcolor="#CCCCCC"><strong>Status</strong></td>
    <td width="198" bgcolor="#CCCCCC"><strong>Data de envio</strong></td>
    <td width="86" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  
  <tr>
    <td>
    <?
	 $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno'");
	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
		  echo $res_aluno['nome_aluno'];
	 }
	
	?>
    </td>
    
    <?
     
	 $sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");
	$data_envio = 0;
	$status_atividade = 0;
	while($res_atividade = mysqli_fetch_array($sql_atividade)){
		$data_envio = $res_atividade['data'];
		$status_atividade = $res_atividade['status'];
		
		if($status_atividade == ''){
			$status_atividade = NULL;
		}else{
			$status_atividade = $res_atividade['status'];
		}
		
	}
	?>
    
    <td><? if($status_atividade == NULL){ echo "NÃO ENVIADO"; }else{ echo $status_atividade; } ?></td>
    <td><? if($data_envio == 0){ echo "NÃO ENVIADO"; }else{ echo @$data_envio; } ?></td>
    <td>
    <? if(mysqli_num_rows($sql_atividade) <= 0){ ?>
    
    <a href="?p=aprovar&arquivo_artividade=<? echo $_GET['arquivo_artividade']; ?>&aluno=<? echo $_GET['aluno']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="../img/correto_atividade.png" width="20" height="20"></a>
	
	<? }elseif($status_atividade == 'CORRIGIDO'){  }else{ ?>
    
    <a href="?p=aprovar&arquivo_artividade=<? echo $_GET['arquivo_artividade']; ?>&aluno=<? echo $_GET['aluno']; ?>&atividade=<? echo $_GET['atividade']; ?>"><img src="../img/correto_atividade.png" width="20" height="20"></a>
	
	<? } ?>
    
    </td>
    
  </tr>
</table>


<hr />
<? if($_GET['arquivo_artividade'] != ''){ ?>
<iframe width="850" height="600" name="" src="../arquivos/<? echo $_GET['arquivo_artividade']; ?>"></iframe>
<? } ?>
</body>
</html>
<? if($_GET['p'] == 'aprovar'){ 

$arquivo_artividade = $_GET['arquivo_artividade'];
$aluno = $_GET['aluno'];
$atividade = $_GET['atividade'];

mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET status = 'CORRIGIDO' WHERE code_aluno = '$aluno' AND code_atividade = '$atividade'");

echo "<script language='javascript'>window.location='?arquivo_artividade=$arquivo_artividade&aluno=$aluno&atividade=$atividade';</script>";
}?>