<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="../jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
</head>

<body>


<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
while($res_questao = mysqli_fetch_array($sql)){
	echo $res_questao['texto']; 	
}
?>



<? if(isset($_POST['enviar'])){

$type_envio = $_POST['type_envio'];
$tipo_envio = $_POST['tipo_envio'];

$turma = $_GET['turma'];
$documento = $_GET['documento'];
$code_atividade = $_GET['code_atividade'];
$total = $_GET['total'];

$atual = $_GET['atual'];

echo "<script language='javascript'>window.window.location='?p=6&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade&total=$total&atual=$atual&type=$type_envio';</script>";

}?>

<form action="" method="post" enctype="multipart/form-data" name="form">
  <input type="submit" name="enviar" style="font:12px Arial, Helvetica, sans-serif; color:#039; float:right; border:2px solid #00F;"value="IR" />

  <select name="type_envio" size="1" style="font:12px Arial, Helvetica, sans-serif; padding:4px; color:#039; float:right; border:2px solid #F00;">

    <option value=""><? 
	if($_GET['type'] == 'Text'){
	echo "Texto"; 
	}elseif($_GET['type'] == 'Frase'){
	echo "Frase"; 
	}else{
	echo "Múltipla escolha"; 
	}
	
	
	?></option>

    
	<? if($_GET['type'] != 'Text'){ ?>
    <option value="Text">Texto</option>
    <? } ?>
   
   
    <? if($_GET['type'] != 'Frase'){ ?>
    <option value="?p=6&turma=<? echo $_GET['turma']; ?>&documento=<? echo $_GET['documento']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&code_atividade=<? echo $_GET['code_atividade']; ?>&total=<? echo $_GET['total']; ?>&atual=<? echo $_GET['atual']; ?>&type=Frase">Frase</option>
    <? } ?>



    <? if($_GET['type'] != 'Multipla'){ ?>
    <option value="?p=6&turma=<? echo $_GET['turma']; ?>&documento=<? echo $_GET['documento']; ?>&tipo_envio=<? echo $_GET['tipo_envio']; ?>&code_atividade=<? echo $_GET['code_atividade']; ?>&total=<? echo $_GET['total']; ?>&atual=<? echo $_GET['atual']; ?>&type=Multipla">Multipla escolha</option>
    <? } ?>
    
  </select>
  
</form>
<hr />







<form action="" method="post" enctype="multipart/form-data" >


<? if($_GET['type'] == 'Frase'){ ?>
<br />
<input name="" type="text" disabled="disabled" style="padding:10px; width:405px;" value="Aqui o aluno digita a resposta" />
<br /><br />
<? } ?>

<? if($_GET['type'] == 'Text'){ ?>
<br />
<input name="" type="text" disabled="disabled" style="padding:10px; height:100px; width:505px;" value="Aqui o aluno digita o texto ou resposta" size="500" />
<br /><br />
<? } ?>


<? if($_GET['type'] == 'Multipla'){ ?>
<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM atividades_varios WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");
while($res = mysqli_fetch_array($sql)){
?>
<a rel="superbox[iframe][500x600]" style="padding:8px; background:#093; text-decoration:none; border:1px solid #000; color:#FFF;" href="fotos.php?usuario=<? echo $usuario; ?>">Imagens</a>
<br />
<table width="409" border="0">
  <tr>
    <td width="73"><p>
      A) 
      <input name="opcao" type="radio" id="radio" value="A" <? if($res['opcao_correta'] == 'A'){ ?>checked="checked" <? } ?>/>
    </p></td>
    <td width="326"><label for="item_a"></label>
    <textarea name="item_a" id="item_a" cols="50" rows="5"><? echo $res['opcao1']; ?></textarea></td>
  </tr>
  <tr>
    <td>B)
      <input name="opcao" type="radio" id="radio2" value="B" <? if($res['opcao_correta'] == 'B'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_b" id="item_b" cols="50" rows="5"><? echo $res['opcao2']; ?></textarea></td>
  </tr>
  <tr>
    <td>C) 
      <input name="opcao" type="radio" id="radio3" value="C" <? if($res['opcao_correta'] == 'C'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_c" id="item_c" cols="50" rows="5"><? echo $res['opcao3']; ?></textarea></td>
  </tr>
  <tr>
    <td>D) 
      <input name="opcao" type="radio" id="radio4" value="D" v<? if($res['opcao_correta'] == 'D'){ ?>checked="checked" <? } ?>/>
    <label for="opcao"></label></td>
    <td><textarea name="item_d" id="item_d" cols="50" rows="5"><? echo $res['opcao4']; ?></textarea></td>
  </tr>
</table>
<? } ?>

<? } ?>
<input style="padding:8px; background:#039; text-decoration:none; border:2px solid #000; color:#FFF;" type="submit" name="confirmar" value="Confirmar" />
<a style="padding:8px; float:right; background:#099; text-decoration:none; border:2px solid #000; color:#FFF;" href="">Voltar</a>
</form>


<? if(isset($_POST['confirmar'])){

$opcao = $_POST['opcao'];
$item_a = $_POST['item_a'];
$item_b = $_POST['item_b'];
$item_c = $_POST['item_c'];
$item_d = $_POST['item_d'];

$type_envio = $_GET['type'];

$sql_altera = mysqli_query($conexao_bd, "UPDATE atividades_varios SET tipo_resposta = '$type_envio', opcao1 = '$item_a', opcao2 = '$item_b', opcao3 = '$item_c', opcao4 = '$item_d', opcao_correta = '$opcao' WHERE code_atividade = '".$_GET['code_atividade']."' AND questao = '".$_GET['atual']."'");

if($opcao == '' && $type_envio == 'Multipla'){
echo "<script language='javascript'>window.alert('Você deve informar a opção correta!');window.location='';</script>";
}elseif($item_a == '' && $type_envio == 'Multipla'){
echo "<script language='javascript'>window.alert('A alternativa A está em branco!');window.location='';</script>";
}elseif($item_b == '' && $type_envio == 'Multipla'){
echo "<script language='javascript'>window.alert('A alternativa B está em branco!');window.location='';</script>";
}elseif($item_c == '' && $type_envio == 'Multipla'){
echo "<script language='javascript'>window.alert('A alternativa C está em branco!');window.location='';</script>";
}elseif($item_d == '' && $type_envio == 'Multipla'){
echo "<script language='javascript'>window.alert('A alternativa D está em branco!');window.location='';</script>";
}else{

$atual = $_GET['atual'];

$atual++;

$turma = $_GET['turma'];
$documento = $_GET['documento'];
$tipo_envio = $_GET['tipo_envio'];
$code_atividade = $_GET['code_atividade'];
$total = $_GET['total'];

echo "<script language='javascript'>window.window.location='?p=5&turma=$turma&documento=$documento&tipo_envio=$tipo_envio&code_atividade=$code_atividade&total=$total&atual=$atual&type=frase';</script>";


}


}?>
</body>
</html>