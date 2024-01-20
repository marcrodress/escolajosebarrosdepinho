<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/series.css" rel="stylesheet" type="text/css" />

<style>
#container_tuod{
	background:#FFF;
}
</style>
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm">
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_escola.php" rel="superbox[iframe][280x100]" class="btn btn-success">Cadastrar série</a>
        <hr />
        <p class="h4 text-primary">Séries cadastradas</p>
        <? if(@$_GET['acao'] == 'excluir'){
        
		echo "<div class='p-3 mb-2 bg-info text-white'>Escola excluída com sucesso! Aguarde..</div>";
		
		$escola = $_GET['escola'];
		
		mysqli_query($conexao_bd, "DELETE FROM escolas WHERE code_escola = '$escola'");
		
		?>
		
		  <script type="text/javascript">
              function redirectTime(){
                 window.location = "?p=escolas"
              }
           </script>
           <body onLoad="setTimeout('redirectTime()', 3000)">
		
		
		<? }?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">COD.</th>
              <th scope="col">Escola</th>
              <th scope="col">N° turmas</th>
              <th scope="col">N° alunos</th>
              <th scope="col">Opções</th>
            </tr>
          </thead>
          <tbody>
          <? $i = 0;
		  $sql = mysqli_query($conexao_bd, "SELECT * FROM escolas WHERE usuario = '5615616'");
		   while($res = mysqli_fetch_array($sql)){ $i++;
		  ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $res['code_escola']; ?></td>
              <td><? echo $res['nome_escola']; ?></td>
              <td>8</td>
              <td>36</td>
              <td>
              
              <script language=javascript>
				function confirmacao(){
				 if (confirm("Se confirmar, tudo relativo a essa escola será excluída. Você tem certeza?"))
				  window.location='?p=escolas&acao=excluir&escola=<? echo $res['code_escola']; ?>';
				}
				</script>
              
              <a onclick="return confirmacao();"><img src="https://pt.seaicons.com/wp-content/uploads/2017/02/delete-icon-1.png" width="20" height="20" title="Excluir" /></a>
              
              <a href="scripts/cadastrar_escola.php?escola=<? echo $res['code_escola']; ?>" rel="superbox[iframe][280x100]"> <img src="https://image.flaticon.com/icons/png/512/1159/1159633.png" width="20" height="20" title="Alterar nome" /></a>
              </td>
            </tr>
         <? } ?>
        </table>
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>