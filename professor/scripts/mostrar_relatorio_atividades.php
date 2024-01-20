<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<style type="text/css">
body,td,th {
	color: #000;
	font:10px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<?
require "../../conexao.php";
$sql_busca = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE turma = '".$_GET['turma']."' AND periodo = '".$_GET['periodo']."' AND componente = '".$_GET['componente']."'");
if(mysqli_num_rows($sql_busca) == ''){
	echo "<p class='text-primary'>Não foi encontrado atividades deste componente!</p>";
}else{
?>
<h6 class="text-success"><strong>Componente:</strong>
<?
		$sql_professor = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '".$_GET['componente']."'");
		 while($res_professor = mysqli_fetch_array($sql_professor)){
			 echo $res_professor['componente'];
		}
?>
</h6>
<table class="table table-striped" style="text-align:center;" width="800" border="1">
  <tr>
    <td width="8%"><strong>Data da atividade</strong></td>
    <td width="28%"><strong>Objetivo</strong></td>
    <td width="14%"><strong>Professor</strong></td>
    <td width="10%"><strong>Devolutiva</strong></td>
    <td width="11%"><strong>Acessos</strong></td>
    <td width="10%"><strong>IP</strong></td>
    <td width="11%"><strong>Arquivos</strong></td>
    <td width="8%"><strong>Notas</strong></td>
  </tr>
  <? while($res_busca = mysqli_fetch_array($sql_busca)){ ?>
  <tr>
    <td><? echo $res_busca['dia']; ?>/<? echo $res_busca['mes']; ?>/<? echo $res_busca['ano']; ?></td>
    <td><? echo $res_busca['objetivo']; ?></td>
    <td>
	<?
            $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_busca['usuario']."'");
             while($res_professor = mysqli_fetch_array($sql_professor)){
                 echo $res_professor['nome_escola'];
            }
    ?>    
    </td>
    <td>
	<?
     $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_busca['code_atividade']."' AND code_aluno = '".$_GET['aluno']."'");
	  while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
         echo $res_atividades_enviadas['data'];echo "<br>";
      }
	?>
    </td>
    <td>
	 <?
     $sql_visualiza_atividade = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE atividade = '".$res_busca['id']."' AND aluno = '".$_GET['aluno']."'");
	  while($res_visualiza_atividade = mysqli_fetch_array($sql_visualiza_atividade)){
         echo $res_visualiza_atividade['data']; echo "<br>";
	  }
	?>
    </td>
    <td>
	 <?
     $sql_visualiza_atividade = mysqli_query($conexao_bd, "SELECT * FROM visualiza_atividade WHERE atividade = '".$res_busca['id']."'  AND aluno = '".$_GET['aluno']."'");
	  while($res_visualiza_atividade = mysqli_fetch_array($sql_visualiza_atividade)){
         $ip_visualizar = $res_visualiza_atividade['ip']; 
		 echo "<a target='_blank' href='https://www.ip2location.com/demo/$ip_visualizar'>$ip_visualizar</a>";
		 echo "<br>";
		 
	  }
	?>    
    </td>
    <td>
	<?
     $sql_arquivos = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas_extras WHERE code_aluno = '".$_GET['aluno']."' AND code_atividade = '".$res_busca['code_atividade']."'");
	  while($res_arquivos = mysqli_fetch_array($sql_arquivos)){
		  $arquivos = $res_arquivos['arquivo'];
		 echo "<a target='_blank' href='../arquivos/$arquivos'><img src='../../img/baixar.png' width='15' height='15' /> </a>";
      }
	?>    
    </td>
    <td><?
     $sql_atividades_enviadas = mysqli_query($conexao_bd, "SELECT * FROM atividades_enviadas WHERE code_atividade = '".$res_busca['code_atividade']."' AND code_aluno = '".$_GET['aluno']."'");
	  while($res_atividades_enviadas = mysqli_fetch_array($sql_atividades_enviadas)){
         echo number_format($res_atividades_enviadas['nota'],1);
      }
	?></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>