<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	border:2px solid #069;
	border-radius:5px;
	}
body,td,th {
	border-radius:5px;
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	padding:5px;
}

</style>
</head>

<body>
<? require "../../conexao.php"; ?>


<table width="300" border="0">
  <tr>
    <td colspan="5" align="center" bgcolor="#00CCCC"><strong>RESUMO POR ITEM DA <? echo $_GET['questao']; ?>&deg; QUEST&Atilde;O</strong></td>
  </tr>
  <tr>
    <td width="47" align="center">&nbsp;</td>
    <td width="45"><strong>MARCARAM</strong></td>
    <td width="46"><strong>ACERTO</strong></td>
    <td width="107"><strong>ERRO</strong></td>
    <td width="25">&nbsp;</td>
  </tr>
  <tr>
    <td width="47" bgcolor="#F0D3F8">A</td>
    <td width="45" bgcolor="#F0D3F8"><? echo $marcaram = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'A' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="46" bgcolor="#F0D3F8"><? echo $acerto = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'A' AND correto = 'SIM' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="107" bgcolor="#F0D3F8"><? echo $marcaram-$acerto; ?></td>
    <td width="25" bgcolor="#F0D3F8"><a href="?atividade=<? echo $_GET['atividade']; ?>&questao=<? echo $_GET['questao']; ?>&turma=<? echo $_GET['turma']; ?>&item=A"><img src="../../img/descritovo.png" alt="" width="25" height="25" border="0" /></a></td>
  </tr>
  <? if($_GET['item'] == 'A'){ ?>
  <tr>
    <td height="19" colspan="5">
        <?
		  $sql_questoes_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'A' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'");
		  	 while($res_questoes_atividade = mysqli_fetch_array($sql_questoes_atividade)){
				 $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_questoes_atividade['aluno']."'");
		  	 	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
					  echo strtoupper($res_aluno['nome_aluno']);
			 	}
			}
		?>
        <hr />
    </td>
  </tr>
  <? } ?>
  <tr>
    <td>B</td>
    <td width="45"><? echo $marcaram = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'B' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="46"><? echo $acerto = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'B' AND correto = 'SIM'  AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="107"><? echo $marcaram-$acerto; ?></td>
    <td width="25"><a href="?atividade=<? echo $_GET['atividade']; ?>&amp;questao=<? echo $_GET['questao']; ?>&amp;turma=<? echo $_GET['turma']; ?>&amp;item=B"><img src="../../img/descritovo.png" alt="" width="25" height="25" border="0" /></a></td>
  </tr>
  <? if($_GET['item'] == 'B'){ ?>
  <tr>
    <td height="19" colspan="5">
        <?
		  $sql_questoes_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'B' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'");
		  	 while($res_questoes_atividade = mysqli_fetch_array($sql_questoes_atividade)){
				 $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_questoes_atividade['aluno']."'");
		  	 	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
					  echo strtoupper($res_aluno['nome_aluno']);
			 	}
			}
		?>
        <hr />
    </td>
  </tr>
  <? } ?>  
  <tr>
    <td bgcolor="#F0D3F8">C</td>
    <td width="45" bgcolor="#F0D3F8"><? echo $marcaram = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'C' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="46" bgcolor="#F0D3F8"><? echo $acerto = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'C' AND correto = 'SIM'  AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="107" bgcolor="#F0D3F8"><? echo $marcaram-$acerto; ?></td>
    <td width="25" bgcolor="#F0D3F8"><a href="?atividade=<? echo $_GET['atividade']; ?>&questao=<? echo $_GET['questao']; ?>&turma=<? echo $_GET['turma']; ?>&item=C"><img src="../../img/descritovo.png" alt="" width="25" height="25" border="0" /></a></td>
  </tr>
  <? if($_GET['item'] == 'C'){ ?>
  <tr>
    <td height="19" colspan="5">
        <?
		  $sql_questoes_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'C' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'");
		  	 while($res_questoes_atividade = mysqli_fetch_array($sql_questoes_atividade)){
				 $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_questoes_atividade['aluno']."'");
		  	 	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
					  echo strtoupper($res_aluno['nome_aluno']);
			 	}
			}
		?>
        <hr />
    </td>
  </tr>
  <? } ?>  
  <tr>
    <td>D</td>
    <td width="45"><? echo $marcaram = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'D' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="46"><? echo $acerto = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'D' AND correto = 'SIM'  AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'")); ?></td>
    <td width="107"><? echo $marcaram-$acerto; ?></td>
    <td width="25"><a href="?atividade=<? echo $_GET['atividade']; ?>&questao=<? echo $_GET['questao']; ?>&turma=<? echo $_GET['turma']; ?>&item=D"><img src="../../img/descritovo.png" alt="" width="25" height="25" border="0" /></a></td>	
  </tr>
  <? if($_GET['item'] == 'D'){ ?>
  <tr>
    <td height="19" colspan="5">
        <?
		  $sql_questoes_atividade = mysqli_query($conexao_bd, "SELECT * FROM questoes_atividades_alunos WHERE item = 'D' AND atividade = '".$_GET['atividade']."' AND questao = '".$_GET['questao']."'");
		  	 while($res_questoes_atividade = mysqli_fetch_array($sql_questoes_atividade)){
				 $sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_questoes_atividade['aluno']."'");
		  	 	  while($res_aluno = mysqli_fetch_array($sql_aluno)){
					  echo strtoupper($res_aluno['nome_aluno']);
			 	}
			}
		?>
        <hr />
    </td>
  </tr>
  <? } ?>
</table>
</body>
</html>