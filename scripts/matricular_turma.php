<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
body td,th {
	color: #000;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
}
body input{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	}
body select{
	border:1px solid #CCC;
	border-radius:5px;
	padding:5px;
	width:157px;
	}
</style>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; $aluno = $_GET['aluno']; ?>

<? if($_GET['p'] == '1'){ ?>

<? if(isset($_POST['button'])){

$data_matricula = $_POST['data_matricula'];
$ingresso = $_POST['ingresso'];
$turma = $_POST['turma'];
$laudo = $_POST['laudo'];
$observacoes = $_POST['observacoes'];

$sql_turmas = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' AND aluno = '$aluno'");
if(mysqli_num_rows($sql_turmas) >= 1){
	echo "<script language='javascript'>window.alert('Este aluno já se encontra matriculado nesta turma!');</script>";
}else{

	$code_matricula = rand()*date("d")+date("d")+$aluno;
	
	$code_data_matricula = 0;
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_matricula'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		$code_data_matricula = $res_code_vencimento['codigo'];
	}	
	
	$n_chamada = 0;
	
	$sql_verifica_id = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma' ORDER BY id DESC LIMIT 1");
	if(mysqli_num_rows($sql_verifica_id) <= 0){
		$n_chamada = 1;
	}else{
		while($res_chamada = mysqli_fetch_array($sql_verifica_id)){
			$n_chamada = $res_chamada['n_chamada']+1;
		}
	}	
	
	

	mysqli_query($conexao_bd, "INSERT INTO turmas_alunos (status, turma, aluno, data_matricula, code_matricula, n_chamada, ingresso, laudado, suprido, impresso, transferido) VALUES ('Ativo', '$turma', '$aluno', '$code_data_matricula', '$code_matricula', '$n_chamada', '$ingresso', '$laudo', '', '', '')");

	echo "<script language='javascript'>window.alert('Matricula efetuado com sucesso!');window.location='?aluno=$aluno';</script>";
	
}
}?>


<form id="form1" name="form1" method="post" action="">
  <table width="437" border="0">
    <tr>
      <td width="108" bgcolor="#0099CC">Data da matricula</td>
      <td width="160" bgcolor="#0099CC">Forma de ingresso</td>
      <td width="48" bgcolor="#0099CC">Turma</td>
      <td width="48" bgcolor="#0099CC">Laudo</td>
      <td width="51" bgcolor="#0099CC">&nbsp;</td>
    </tr>
    <tr>
      <td><label for="observacoes"></label>
        <span id="sprytextfield1">
        <input name="data_matricula" type="text" style="text-align:center;" value="<? echo date("d/m/Y"); ?>" size="10" />
      <span class="textfieldRequiredMsg"></span></span></td>
      <td><label for="ingresso"></label>
        <select name="ingresso" size="1" id="ingresso">
          <option value="Regular">Regular</option>
          <option value="Transferido">Transferido</option>
          <option value="Idade">Idade</option>
        </select></td>
      <td><label for="turma"></label>
      
        <select name="turma" size="1" id="turma">
         <?
		  $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas");
			while($res_turma = mysqli_fetch_array($sql_turma)){		  
		 ?>
          <option value="<? echo $res_turma['code_turma']; ?>"><? echo $res_turma['fase']; ?> - <? echo $res_turma['code_serie']; ?>° <? echo $res_turma['tipo_turma']; ?> - <? echo $res_turma['turno']; ?> - Sala: <? echo $res_turma['sala']; ?></option>
        <? } ?>
        </select>
        
        
      </td>
      <td><label for="laudado"></label>
        <select name="laudado" size="1" id="laudado">
          <option value="">N&Atilde;O</option>
          <option value="SIM">SIM</option>
        </select></td>
      <td><input type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<? } ?>







<? if($_GET['p'] == 'transferir'){ ?>
<form name="form1" method="post" action="">
<? if(isset($_POST['button'])){
	
$data_transferencia = $_POST['data_transferencia'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$escola = $_POST['escola'];
$observacoes = $_POST['observacoes'];
$matricula = $_GET['matricula'];


	$code_transferencia = 0;
	
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data_transferencia'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		$code_transferencia = $res_code_vencimento['codigo'];
	}

mysqli_query($conexao_bd, "INSERT INTO informacoes_transferencia (aluno, matricula, data, data_transferencia, code_transferencia, estado, municipio, escola, observacoes, operador) VALUES ('$aluno', '$matricula', '$data', '$data_transferencia', '$code_transferencia', '$estado', '$municipio', '$escola', '$observacoes', '$operador')");

mysqli_query($conexao_bd, "UPDATE turmas_alunos SET status = 'TRANSFERIDO', transferido = 'SIM' WHERE code_matricula = '$matricula'");

	echo "<script language='javascript'>window.alert('Transferência efetuada com sucesso!');window.location='?aluno=$aluno';</script>";

}?>


  <table width="500" border="1">
    <tr>
      <td colspan="7" bgcolor="#0066CC"><h2 style="padding:0; margin:0;"><strong>INFORMA&Ccedil;&Otilde;ES DE TRANSFER&Ecirc;NCIA</strong></h2></td>
    </tr>
    <tr>
      <td bgcolor="#009999"><strong>Data da transfer&ecirc;ncia</strong></td>
      <td bgcolor="#009999"><strong>Estado</strong></td>
      <td bgcolor="#009999"><strong>Cidade</strong></td>
      <td bgcolor="#009999"><strong>Escola</strong></td>
      <td colspan="3" bgcolor="#009999"><strong>Observa&ccedil;&otilde;es</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield2">
      <label for="data_transferencia"></label>
      <input name="data_transferencia" type="text" value="<? echo date("d/m/Y"); ?>" size="10" />
      <span class="textfieldRequiredMsg"></span></span></td>
      <td>
                  <select name="estado" size="1" class="form-control" id="estado">
                    <option value="<? echo $rg_uf; ?>"><? echo $rg_uf; ?></option>
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amap&aacute;">Amap&aacute;</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Cear&aacute;">Cear&aacute;</option>
                    <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
                    <option value="Goi&aacute;s">Goi&aacute;s</option>
                    <option value="Maranh&atilde;o">Maranh&atilde;o</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Par&aacute;">Par&aacute;</option>
                    <option value="Para&iacute;ba">Para&iacute;ba</option>
                    <option value="Paran&aacute;">Paran&aacute;</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piau&iacute;">Piau&iacute;</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                    <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
                    <option value="Roraima">Roraima</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                </select>
      </td>      
      </td>
      <td><span id="sprytextfield3">
        <label for="municipio"></label>
        <input name="municipio" type="text" id="municipio" size="10" />
</span></td>
      <td><span id="sprytextfield4">
        <label for="escola"></label>
        <input name="escola" type="text" id="escola" size="10" />
</span></td>
      <td><span id="sprytextfield5">
        <label for="observacoes"></label>
        <input type="text" name="observacoes" id="observacoes" />
</span></td>
      <td colspan="2"><input type="submit" name="button" id="button" value="Confirmar"></td>
    </tr>
  </table>
</form>
<? }?>














<? if($_GET['p'] == ''){ ?>
<a style="padding:10px; margin:10px 10px 10px 3px; text-decoration:none; text-align:center; background:#093; font:12px Arial, Helvetica, sans-serif; color:#FFF;" href="?aluno=<? echo $_GET['aluno']; ?>&p=1"><strong>Nova matricula</strong></a>
<hr />

<?

$sql_aluno = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE aluno = '$aluno'");
if(mysqli_num_rows($sql_aluno) == ''){
	echo "<em>Este aluno não possui matricula nesta instituição!</em>";
}else{
?>
<table width="721" border="0">
  <tr>
    <td colspan="9" bgcolor="#00CCCC"><h2 style="padding:0; margin:0;"><strong>MATRICULAS ENCONTRADAS</strong></h2></td>
  </tr>
  <tr>
    <td width="67" bgcolor="#0099CC"><strong>S&eacute;rie</strong></td>
    <td width="47" bgcolor="#0099CC"><strong>Turma</strong></td>
    <td width="44" bgcolor="#0099CC"><strong>Turno</strong></td>
    <td width="35" bgcolor="#0099CC"><strong>Sala</strong></td>
    <td width="158" bgcolor="#0099CC"><strong>Forma de ingresso</strong></td>
    <td width="135" bgcolor="#0099CC"><strong>Data de ingresso</strong></td>
    <td width="45" bgcolor="#0099CC"><strong>Laudo</strong></td>
    <td width="47" bgcolor="#0099CC"><strong>Status</strong></td>
    <td width="105" bgcolor="#0099CC">&nbsp;</td>
  </tr>

  <? 
  	
	while($res_alunos = mysqli_fetch_array($sql_aluno)){ 
	$sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '".$res_alunos['turma']."'");
	while($res_turma = mysqli_fetch_array($sql_turma)){ 
  ?>
  <tr>
    <td><? echo $res_turma['code_serie']; ?>° ano</td>
    <td><? echo $res_turma['tipo_turma']; ?></td>
    <td><? echo $res_turma['turno']; ?></td>
    <td><? echo $res_turma['sala']; ?></td>
    <td><? echo $res_alunos['ingresso']; ?></td>
    <td><? 
		
	$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_alunos['data_matricula']."'");
	while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
		echo $code_transferencia = $res_code_vencimento['vencimento'];
	}
	?>
	</td>
    <td><? echo $res_alunos['laudado']; if($res_alunos['laudado'] == 'SIM'){?> 
    
    <a href="?aluno=<? echo $_GET['aluno']; ?>&p=aee&laudado=&matricula=<? echo $res_alunos['code_matricula']; ?>"><img style="border-radius:10px; border:1px solid #000;" src="../img/infrequencia.png" width="7" height="7" border="0" title="Tirar o aluno do AEE" /></a>
    <? } ?>
    </td>
    <td><? echo $res_alunos['status']; ?></td>
    <td>
    <? if($res_alunos['laudado'] == ''){?> 
      <a href="?aluno=<? echo $_GET['aluno']; ?>&p=aee&laudado=SIM&matricula=<? echo $res_alunos['code_matricula']; ?>"><img style="border-radius:10px; border:1px solid #000;" src="../img/roxo.fw.png" width="20" height="20" border="0" title="Marcar o aluno como AEE" /></a>
    <? } ?>
      
   	  <a href="?aluno=<? echo $_GET['aluno']; ?>&p=transferir&matricula=<? echo $res_alunos['code_matricula']; ?>"><img src="../img/transferir.png" width="20" height="20" border="0" title="Informar transferência de aluno" /></a>
      <a href="?aluno=<? echo $_GET['aluno']; ?>&p=cancelar_matricula&matricula=<? echo $res_alunos['code_matricula']; ?>"><img src="../img/deleta.jpg" width="20" height="20" border="0" title="Exclusão realiazada com sucesso!" /></a>    
    </td>
  </tr>
  <? }} ?>
</table>
<? } ?>

<? } ?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {isRequired:false});
</script>
</body>
</html>
<? if($_GET['p'] == 'cancelar_matricula'){
	
	$matricula = $_GET['matricula'];
	mysqli_query($conexao_bd, "UPDATE  turmas_alunos SET status = 'CANCELADO' WHERE code_matricula = '$matricula'");

	echo "<script language='javascript'>window.alert('Cancelamento efetuado com sucesso!');window.location='?aluno=$aluno';</script>";

}?>
<? if($_GET['p'] == 'aee'){
	
	$matricula = $_GET['matricula'];
	$laudado = $_GET['laudado'];
	mysqli_query($conexao_bd, "UPDATE  turmas_alunos SET laudado = '$laudado' WHERE code_matricula = '$matricula'");

	echo "<script language='javascript'>window.alert('Operação efetuado com sucesso!');window.location='?aluno=$aluno';</script>";

}?>