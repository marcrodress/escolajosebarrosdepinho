<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/turmas.css" rel="stylesheet" type="text/css" />
<style>
body table{
	font:12px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
	font:10px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row">
        <div class="col-sm"><p></p>
        <p class="h4 text-primary">Disciplinas</p>
       	
        <a style="margin:5px 0 0 0;" href="scripts/cadastrar_componente.php?operador=<? echo $operador; ?>" rel="superbox[iframe][340x150]" class="btn btn-success">Cadastrar componente</a>
        <br /><br />
		<div class="alert alert-warning" role="alert">Após o cadastro a exclusão só pode ser realizada pelo o WhatsApp (85) 98422.8226!</div>
       	  <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">C&oacute;digo da disciplina</th>
                  <th scope="col">Nome do componente</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <? $i=0;
			   $sqlListaDisciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas");
			    while($resListaDisciplinas = mysqli_fetch_array($sqlListaDisciplinas)){ $i++;
			  ?>
                <tr>
                  <th scope="row"><? echo $i; ?></th>
                  <td><? echo $resListaDisciplinas['code']; ?></td>
                  <td><? echo $resListaDisciplinas['componente']; ?></td>
                  <td><a rel="superbox[iframe][340x150]" href="scripts/editar_componente.php?id=<? echo $resListaDisciplinas['id']; ?>"><img src="img/edita.png" width="25" height="25" /></a></td>
                </tr>
			   <? } ?>
              </tbody>
            </table>
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>