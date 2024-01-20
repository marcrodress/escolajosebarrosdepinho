<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <? if(isset($_POST['button'])){
			
			
		 $titulo = $_POST['titulo'];
		 $inicio = $_POST['inicio'];
		 $fim = $_POST['fim'];
		 $tipo = $_POST['tipo'];
		 
		$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$inicio'");
		while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
			$inicio = $res_code_vencimento['codigo'];
		}
		$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$fim'");
		while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
			$fim = $res_code_vencimento['codigo'];
		}
		
		$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM calendativo_letivo WHERE titulo = '$titulo' AND inicio = '$inicio' AND fim = '$fim'");	 
      	 if(mysqli_num_rows($sql_verifica) >= 1){
			 echo "<br><div class='alert alert-danger' role='alert'><h6> Esta atividade já foi postada!</h6></div>";
		 }else{
			 
			 mysqli_query($conexao_bd, "INSERT INTO calendativo_letivo (usuario, code_atividade, status, ordem, titulo, data, tipo, turma, componente, professor) VALUES ('$operador', '".rand()."', 'Ativo', 'INICIO', '$titulo', '$inicio', '$tipo', '', '', '')");
			 
			 if($fim != ''){
			 mysqli_query($conexao_bd, "INSERT INTO calendativo_letivo (usuario, code_atividade, status, ordem, titulo, data, tipo, turma, componente, professor) VALUES ('$operador', '".rand()."', 'Ativo', 'FIM', '$titulo', '$fim', '$tipo', '', '', '')");
			 }

			 echo "<br><div class='alert alert-success' role='alert'><h6> Atividade adicionada com sucesso!</h6></div>";
			 
		 }
		
		}?>
		  <h5 class="text-primary" style="margin:5px;"><strong>Nova atividade no calendário letivo</strong></h5>
		  <hr />
          <form name="" method="post" enctype="multipart/form-data">
            <table width="800" border="1" class="table">
              <tr>
                <td colspan="3"><strong>TITULO DA ATIVIDADE</strong></td>
              </tr>
              <tr>
                <td colspan="3"><label for="textfield"></label>
                <input class="form-control form-control-lg" type="text" name="titulo" id="textfield"></td>
              </tr>
              <tr>
                <td width="201"><strong>DATA DE ÍNICIO</strong></td>
                <td width="237"><strong>DATA DO FIM</strong></td>
                <td width="340"><strong>TIPO DE ATIVIDADE</strong></td>
              </tr>
              <tr>
                <td><label for="textfield2"></label>
                  <span id="sprytextfield1">
                  <input class="form-control form-control-lg" type="text" name="inicio" id="textfield2" />
                  </span></td>
                <td><label for="textfield3"></label>
                  <span id="sprytextfield2">
                  <input class="form-control form-control-lg" type="text" name="fim" id="textfield3" />
                  </span></td>
                <td><label for="select"></label>
                  <select class="form-control form-control-lg" name="tipo" size="1" id="select">
                    <option value="ATIVIDADE">ATIVIDADE</option>
                    <option value="FERIADO">FERIADO</option>
                    <option value="PONTO FACULTATIVO">PONTO FACULTATIVO</option>
                    <option value="AVALIAÇÃO">AVALIAÇÃO</option>
                    <option value="AVALIAÇÃO PARCIAL">AVALIAÇÃO PARCIAL</option>
                    <option value="RECUPERAÇÃO PARALELA">RECUPERAÇÃO PARALELA</option>
                </select></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><input type="submit"  class="btn btn-primary mb-2" name="button" id="button" value="Postar"></td>
              </tr>
            </table>
          </form>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>