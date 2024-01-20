<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
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
<? require "../../conexao.php"; ?>

<div class="container_fluid"> <? $turma = $_GET['turma']; $mes_at = $_GET['mes']; $professor = $_GET['operador']; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm">
  		<? $turma = $_GET['turma']; $livro = $_GET['livro'];
				   $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
	         		while($res_turma = mysqli_fetch_array($sql_turma)){
			  
		?>
      </div>
      <table class="table table-striped" border="1">
        <thead>
          <tr>
            <th width="5%" align="center" scope="col"><img src="../../img/logo.png" alt="" width="80" height="80" /></th>
            <th colspan="7" align="center" scope="col"><h2><strong>RELAT&Oacute;RIO DE ENTREGA: 
            <?
            $sql_controle_livros_extra = mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra WHERE code_livro = '$livro'");
			   while($res_livros_extra = mysqli_fetch_array($sql_controle_livros_extra)){
				   echo strtoupper($res_livros_extra['nome_livro']);
			}
			?>
            
            </strong></h2></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th colspan="2" scope="row"><strong>ESCOLA</strong></th>
            <td ><strong>ANO</strong></td>
            <td ><strong>FASE</strong></td>
            <td ><strong>TURMA</strong></td>
            <td ><strong>TURNO</strong></td>
            <td><strong>SALA</strong></td>
            <td><strong>COORDENADOR</strong></td>
          </tr>
          <tr>
            <th height="66" colspan="2" scope="row">E.E.F. DEPUTADO LEORNE BEL&Eacute;M</th>
            <td><? echo $res_turma['code_serie']; ?>° ano</td>
            <td><? echo $res_turma['fase']; ?></td>
            <td><? echo $res_turma['tipo_turma']; ?></td>
            <td><? echo $res_turma['turno']; ?></td>
            <td><? echo $res_turma['sala']; ?></td>
            <td>
             <?
				   $sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '".$res_turma['coordenador']."'");
	         		while($res_acesso = mysqli_fetch_array($sql_acesso)){
					   $sql_coordendador = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '".$res_acesso['cpf']."'");
						while($res_coordenador = mysqli_fetch_array($sql_coordendador)){		
						
							echo $res_coordenador['nome'];
											
					}}
			  
			?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
      <? } ?>
        <br />
        <table width="449" class="table table-bordered" style="font:12px Arial, Helvetica, sans-serif; border:2px solid #000;">
          <thead class="thead-light">
            <tr>
              <th width="5" scope="row">N&deg;</th>
              <th width="333"><strong>NOME DO ALUNO</strong></th>
              <th width="76" align="center"><strong>RECEBIDO</strong></th>
              <th width="76" align="center"><strong>DEVOLVIDO</strong></th>
            </tr>
          </thead>
           <? $i = 0; $turma = $_GET['turma'];
		   $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM turmas_alunos WHERE turma = '$turma'");
		    while($res_1 = mysqli_fetch_array($sql_1)){ $i++;
			$aluno = $res_1['aluno'];
			$sql_2 = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '".$res_1['aluno']."'");
		    while($res_2 = mysqli_fetch_array($sql_2)){
		  ?>
            <tr>
              <th scope="row"><? echo $res_1['n_chamada']; ?></th>
              <td><? echo $res_2['nome_aluno']; ?></td>
              <td align="center">
              <?
				$sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND aluno = '$aluno' AND ano = '$ano' AND recebido = 'SIM'"));
			  ?>
              
              <? if($sql_recebido >= 1){ echo "<img src='../img/corretos.png' width='15' height='15'";  }else{ echo "<img src='../img/errado.png' width='15' height='15'"; }?> </td>
              
              <td align="center">
              <?
				$sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND aluno = '$aluno' AND ano = '$ano' AND entregue = 'SIM'"));
			  ?>
              
              <? if($sql_recebido >= 1){ echo "<img src='../img/corretos.png' width='15' height='15'";  }else{ echo "<img src='../img/errado.png' width='15' height='15'"; }?> </td>              
            </tr>
            <? }} ?>
            <tr>
              <th colspan="2" scope="row">&nbsp;</th>
              <td align="center"><? echo $sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND ano = '$ano' AND recebido = 'SIM'")); ?> livros</td>
              <td align="center"><? echo $sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND ano = '$ano' AND entregue = 'SIM'")); ?> livros</td>
            </tr>
            <tr>
              <th colspan="3" scope="row" align="right">TOTAL DE LIVROS ENTREGUES: <? echo $sql_recebido = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND ano = '$ano' AND recebido = 'SIM'")); ?> livros</th>
            </tr>
            <tr>
              <th colspan="3" scope="row" align="right">CARÊNCIA DE LIVROS: <? echo $i-mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM controle_livros_extra_aluno WHERE turma = '$turma' AND ano = '$ano' AND recebido = 'SIM'")); ?> livros</th>
              <td align="center"></td>
            </tr>
        </table>        
    </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>
