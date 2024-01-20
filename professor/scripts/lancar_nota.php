<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../../conexao.php"; ?>
</head>

<body>
<form action="../?p=lancar_nota&componente=<? echo $_GET['componente']; ?>&turma=<? echo $_GET['turma']; ?>&operador=<? echo $_GET['operador']; ?>" method="post" enctype="multipart/form-data" name="" target="_top">
<em><strong style="font:12px Arial, Helvetica, sans-serif;"><strong>Selecione o mês</strong></strong></em><br>
<select style="font:12px Arial, Helvetica, sans-serif; padding:5px;" name="bimestre" size="1">
  <option value="1">1° Bimestre</option>
  <option value="2">2° Bimestre</option>
  <option value="3">3° Bimestre</option>
  <option value="4">4° Bimestre</option>
</select>
<input style="font:12px Arial, Helvetica, sans-serif; padding:5px;" type="submit" name="" value="Emitir" />
</form>
</body>
</html>