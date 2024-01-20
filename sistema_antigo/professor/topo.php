<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<link href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
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

<? require "../variaveis.php"; ?>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
     <img src="../img/logo.fw.png" alt="..." width="180" height="150" class="rounded float-left">
    </div><!-- col-sm -->

    <div class="col-sm">
     <span style="text-align:center;">
     <p class="text-center">
     <? 
	 	if($apenas_hora >=5 && $apenas_hora < 9){
		 	echo "<img src='../img/amanhecer.png' width='100' height='50'><br>";
		 	echo "Bom dia!";
		}elseif($apenas_hora >=9 && $apenas_hora < 12){
			echo "<img src='../img/sol_da_manha.png' width='100' height='70'><br>";
		 	echo "Bom dia!";
	 	}elseif($apenas_hora >=12 && $apenas_hora < 16){
		 	echo "<img src='../img/sol_meio_dia.png' width='60' height='50'><br>";
		 	echo "Boa tarde!";
	 	}elseif($apenas_hora >=16 && $apenas_hora < 18){
			echo "<img src='../img/sol_se_pondo.png' width='100' height='70'><br>";
			echo "Quase anoitecendo!";
		}else{
		 	echo "<img src='../img/lua_noite.png' width='150' height='70'><br>";
			echo "Boa noite!";
     } ?>


     <br />
     <strong><? echo $nome; ?> -   <a href="?p=extras&sair=sair">Sair</a></strong><br />
     <a rel="superbox[iframe][230x220]" class="btn btn-info" href="scripts/alterar_senha.php?op=<? echo base64_encode($operador); ?>"><strong>Alterar senha</strong></a>
     </p>
     </span>
    </div><!-- col-sm -->
  </div><!-- row -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <? if($tipo == 'ESCOLA'){ ?>
      <li class="nav-item">
        <a style="margin:0 100px 0 0;" class="nav-link text-white" href="?p=anos">TURMAS</a>
      </li>
      <li class="nav-item">
        <a style="margin:0 100px 0 0;" class="nav-link text-white" href="?p=professores">PROFESSORES</a>
      </li>

    <? } ?>  
      
    <? if($tipo == 'PROFESSOR'){ ?>      
      <li class="nav-item">
        <a style="margin:0 100px 0 0;" class="nav-link text-white" href="?p=turmas">TURMAS</a>
      </li>

      <li class="nav-item">
        <a style="margin:0 100px 0 0;" class="nav-link text-white" href="?p=visao_geral_professor&code=<? echo $operador; ?>">MEU HISTÓRICO</a>
      </li>
    <? } ?> 

     <li><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
     <form action="?p=key&consulta= " method="get" enctype="multipart/form-data" name="">
     <input style="margin:0 0 0 20px;" name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
     </form>
     </li>
    
    </ul>
  </div>
</nav>
</div><!-- container -->

<? if(isset($_POST['consulta'])){

$consulta = $_POST['consulta'];

$sql_consulta = mysqli_query($conexao, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$consulta%'");
if(mysqli_num_rows($sql_consulta) == ''){
	echo "<script language='javascript'>window.alert('Não foi encontrado nenhum aluno com as informações digitadas!');</script>";
}else{
	echo "<script language='javascript'>window.location='?p=alunos&key=$consulta';</script>";
}
}?>



</body>
</html>
<? if(@$_GET['sair'] == 'sair'){

 session_start();
 $_SESSION['code'] = 01;
 
 echo "<script language='javascript'>window.location='';</script>";


}?>