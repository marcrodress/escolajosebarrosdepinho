<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>

<?
$mesa = 0;
$datashow = 0;
$tablet = 0;
$notebook = 0;

$sql = mysqli_query($conexao_bd, "SELECT * FROM recursos_tecnologicos");
while($res = mysqli_fetch_array($sql)){
		
		$recurso = $res['recurso'];
		if($recurso == 'Notebook'){
			$notebook = $res['quantidade'];
		}elseif($recurso == 'Datashow'){
			$datashow = $res['quantidade'];
		}elseif($recurso == 'Tablet'){
			$tablet = $res['quantidade'];
		}elseif($recurso == 'Mesa digitalizadora'){
			$mesa = $res['quantidade'];
		}else{
		}
		
	
	}


?>


<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
        <br />
       	  <h5><strong>Recursos pedagógicos digitais</strong></h5>
   		 <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Rcurso</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Agendado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mesa digitalizadora</td>
              <td>
                <form name="form" id="form">
                  <select name="mesa" size="1" style="border:1px solid #000; padding:5px;"  onchange="MM_jumpMenu('parent',this,0)">
                    <option value=""><? echo $mesa; ?></option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=0">0 unidade</option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=1">1 unidade</option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=2">2 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=3">3 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=4">4 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Mesa digitalizadora&quantidade=5">5 unidades</option>
                  </select>
              </form>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Tablet</td>
              <td>
                <form name="form" id="form">
                  <select name="mesa" size="1" style="border:1px solid #000; padding:5px;"  onchange="MM_jumpMenu('parent',this,0)">
                    <option value=""><? echo $tablet; ?></option>
                    <option value="?p=recursos_digitais&recurso=Tablet&quantidade=1">1 unidade</option>
                    <option value="?p=recursos_digitais&recurso=Tablet&quantidade=2">2 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Tablet&quantidade=3">3 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Tablet&quantidade=4">4 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Tablet&quantidade=5">5 unidades</option>
                  </select>
              </form>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Datashow</td>
              <td>
                <form name="form" id="form">
                  <select name="mesa" size="1" style="border:1px solid #000; padding:5px;"  onchange="MM_jumpMenu('parent',this,0)">
                    <option value=""><? echo $datashow; ?></option>
                    <option value="?p=recursos_digitais&recurso=Datashow&quantidade=1">1 unidade</option>
                    <option value="?p=recursos_digitais&recurso=Datashow&quantidade=2">2 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Datashow&quantidade=3">3 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Datashow&quantidade=4">4 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Datashow&quantidade=5">5 unidades</option>
                  </select>
              </form>
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>Notebook</td>
              <td>
                <form name="form" id="form">
                  <select name="mesa" size="1" style="border:1px solid #000; padding:5px;"  onchange="MM_jumpMenu('parent',this,0)">
                    <option value=""><? echo $notebook; ?></option>
                    <option value="?p=recursos_digitais&recurso=Notebook&quantidade=1">1 unidade</option>
                    <option value="?p=recursos_digitais&recurso=Notebook&quantidade=2">2 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Notebook&quantidade=3">3 unidades</option>
                    <option value="?p=recursos_digitais&recurso=Notebook&quantidade=4">4 unidadse</option>
                    <option value="?p=recursos_digitais&recurso=Notebook&quantidade=5">5 unidades</option>
                  </select>
              </form>              
              </td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>

        </div>
      </div>
    </div>
</div>
</body>
</html>
<? if($_GET['recurso'] != ''){ $recurso = $_GET['recurso'];  $quantidade = $_GET['quantidade'];

mysqli_query($conexao_bd, "UPDATE recursos_tecnologicos SET quantidade = '$quantidade' WHERE recurso = '$recurso'");

echo "<script language='javascript'>window.location='?p=recursos_digitais';</script>";

}?>
