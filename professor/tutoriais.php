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
</head>

<body>

<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
      	<? if($_GET['acao'] == 'cadastrar'){ ?>
        <? if(isset($_POST['button'])){
			
			$titulo = $_POST['titulo'];
			$video = $_POST['video'];
			
			$link1 = $_POST['link1'];
			$link2 = $_POST['link2'];
			$link3 = $_POST['link3'];
			$link4 = $_POST['link4'];
			
			$name_1 = $_POST['name_1'];
			$name_2 = $_POST['name_2'];
			$name_3 = $_POST['name_3'];
			$name_4 = $_POST['name_4'];
			
			$download_1 = $_FILES['download_1']['name'];
			$download_2 = $_FILES['download_2']['name'];
			$download_3 = $_FILES['download_3']['name'];
			$download_4 = $_FILES['download_4']['name'];
				
			$mensagem = $_POST['mensagem'];
			
			
			$sql_1 = mysqli_query($conexao_bd, "INSERT INTO tutoriais (operador, status, titulo, video, link1, link2, link3, link4, name_1, name_2, name_3, name_4, download_1, download_2, download_3, download_4, mensagem) VALUES ('$operador', 'Ativo', '$titulo', '$video', '$link1', '$link2', '$link3', '$link4', '$name_1', '$name_2', '$name_3', '$name_4', '$download_1', '$download_2', '$download_3', '$download_4', '$mensagem')");
        	
 if(file_exists("tutorial/$download_1")){ $a = 1;while(file_exists("tutorial/[$a]$download_1")){ $a++;}$download_1 = "[".$a."]".$download_1; }
 if(file_exists("tutorial/$download_2")){ $a = 1;while(file_exists("tutorial/[$a]$download_2")){ $a++;}$download_2 = "[".$a."]".$download_2; }
 if(file_exists("tutorial/$download_3")){ $a = 1;while(file_exists("tutorial/[$a]$download_3")){ $a++;}$download_3 = "[".$a."]".$download_3; }
 if(file_exists("tutorial/$download_4")){ $a = 1;while(file_exists("tutorial/[$a]$download_4")){ $a++;}$download_4 = "[".$a."]".$download_4; }
			
			(move_uploaded_file($_FILES['download_1']['tmp_name'], "tutorial/".$download_1));
			(move_uploaded_file($_FILES['download_2']['tmp_name'], "tutorial/".$download_2));
			(move_uploaded_file($_FILES['download_3']['tmp_name'], "tutorial/".$download_3));
			(move_uploaded_file($_FILES['download_4']['tmp_name'], "tutorial/".$download_4));
			
			
			
			echo "<script language='javascript'>window.alert('Tutorial postado com sucesso!');window.location='?p=tutoriais'</script>";
		
		
		}?>
        <form name="" method="post" action="" enctype="multipart/form-data">
        <table width="900" border="0"  class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th colspan="4" bgcolor="#CCCCCC"><strong>Titulo</strong></th>
          </tr>
          <tr>
            <td colspan="4"><label for="titulo"></label>
            <input name="titulo" type="text" class="form-control" id="titulo" size="50"></td>
          </tr>
          <tr>
            <th colspan="4" bgcolor="#CCCCCC"><strong>Vídeo 1</strong></th>
          </tr>
          <tr>
            <td colspan="4"><label for="video"></label>
            <input name="video" type="text" class="form-control" id="video" size="50">              <label for="link1"></label></td>
          </tr>
          <tr>
            <th width="218" bgcolor="#CCCCCC"><strong>Link externo 1</strong></th>
            <th width="218" bgcolor="#CCCCCC"><strong>Link externo 2</strong></th>
            <th width="218" bgcolor="#CCCCCC"><strong>Link externo 3</strong></th>
            <th width="218" bgcolor="#CCCCCC"><strong>Link externo 4</strong></th>
          </tr>
          <tr>
            <td><input type="text" class="form-control" name="link1" id="link1" /></td>
            <td><input type="text" class="form-control" name="link2" id="link2" /></td>
            <td><input type="text" class="form-control" name="link3" id="link3" /></td>
            <td><input type="text" class="form-control" name="link4" id="link4" /></td>
          </tr>
          <tr>
            <th bgcolor="#CCCCCC"><strong>Nome do download 1</strong></th>
            <th bgcolor="#CCCCCC"><strong>Nome do download 2</strong></th>
            <th bgcolor="#CCCCCC"><strong>Nome do download 3</strong></th>
            <th bgcolor="#CCCCCC"><strong>Nome do download 4</strong></th>
          </tr>
          <tr>
            <td><input type="text" class="form-control" name="name_1" id="name_1" /></td>
            <td><input type="text" class="form-control" name="name_2" id="name_2" /></td>
            <td><input type="text" class="form-control" name="name_3" id="name_3" /></td>
            <td><input type="text" class="form-control" name="name_4" id="name_4" /></td>
          </tr>
          <tr>
            <th bgcolor="#CCCCCC"><strong>Download 1</strong></th>
            <th bgcolor="#CCCCCC"><strong>Download 2</strong></th>
            <th bgcolor="#CCCCCC"><strong>Download 3</strong></th>
            <th bgcolor="#CCCCCC"><strong>Donwload 4</strong></th>
          </tr>
          <tr>
            <td><label for="download_1"></label>
            <input type="file" class="form-control-file" name="download_1" id="download_1" /></td>
            <td><label for="download_2"></label>
            <input type="file" class="form-control-file" name="download_2" id="download_2" /></td>
            <td><label for="download_3"></label>
            <input type="file" class="form-control-file" name="download_3" id="download_3" /></td>
            <td><label for="download_3"></label>
            <input type="file" class="form-control-file" name="download_4" id="download_4" /></td>
          </tr>
          <tr>
            <th colspan="4" bgcolor="#CCCCCC"><strong>Mensagem</strong></th>
          </tr>
          <tr>
            <td colspan="4"><label for="mensagem"></label>
            <textarea name="mensagem" class="form-control" id="mensagem" cols="45" rows="5"></textarea></td>
          </tr>
          <tr>
            <td colspan="4"><input type="submit" name="button"  class="btn btn-primary mb-2" value="Enviar"></td>
          </tr>
         </table>
        </table>
		</form>
 		<? } ?>
        
        
        
      	<? if($_GET['acao'] == '' && $tipo != 'PROFESSOR'){ ?>
        <a style="margin:5px 0 0 0;" href="?p=tutoriais&acao=cadastrar" class="btn btn-success">Cadastrar tutorais</a>
        <hr />
 		<? } ?>
        <br />
        <p class="h4 text-primary"><strong>Tutorais salvos</strong></p>
        
        
        <table width="831" class="table table-bordered">
        <thead class="thead-dark">
          <?
		   $sql_tuto = mysqli_query($conexao_bd, "SELECT * FROM tutoriais");
		  	while($res_tuto = mysqli_fetch_array($sql_tuto)){
		  ?>
          <tr>
            <th colspan="2"><h6 style="padding:0; margin:0;" class="h6"><strong><? echo $res_tuto['titulo']; ?></strong></h6></th>
          </tr>
          <tr>
            <td colspan="2"><strong>Vídeos: </strong><a target="_blank" href="<? echo $res_tuto['video']; ?>"><? echo $res_tuto['video']; ?></a></td>
          </tr>
          <tr>
            <td width="304" height="23"><strong>Links:</strong> 
             <? if($res_tuto['link1'] != ''){ ?> <a target="_blank" href="<? echo $res_tuto['link1']; ?>">Link 1</a> | <? } ?>
             <? if($res_tuto['link2'] != ''){ ?> <a target="_blank" href="<? echo $res_tuto['link2']; ?>">Link 2</a> | <? } ?>
             <? if($res_tuto['link2'] != ''){ ?> <a target="_blank" href="<? echo $res_tuto['link3']; ?>">Link 3</a> | <? } ?>
             <? if($res_tuto['link2'] != ''){ ?><a target="_blank" href="<? echo $res_tuto['link4']; ?>">Link 4</a>    <? } ?>
            </td>
            <td width="511"><strong>Downloads:</strong> 
            	<? if($res_tuto['download_1'] != ''){ ?>
                <a target="_blank" href="tutorial/<? echo $res_tuto['download_1']; ?>"><img src="../img/baixar.png" width="29" height="25" border="0" /></a> 
                <? } ?>
                
            	<? if($res_tuto['download_2'] != ''){ ?>
                <a target="_blank" href="tutorial/<? echo $res_tuto['download_2']; ?>"><img src="../img/baixar.png" width="29" height="25" border="0" /></a> 
                <? } ?>
                
            	<? if($res_tuto['download_3'] != ''){ ?>
                <a target="_blank" href="tutorial/<? echo $res_tuto['download_3']; ?>"><img src="../img/baixar.png" width="29" height="25" border="0" /></a> 
                <? } ?>
                
            	<? if($res_tuto['download_4'] != ''){ ?>
                <a target="_blank" href="tutorial/<? echo $res_tuto['download_4']; ?>"><img src="../img/baixar.png" width="29" height="25" border="0" /></a> 
                <? } ?>                
            </td>
          </tr>
          <? } ?>
          </thead>
        </table>

        
        
        
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
</body>
</html>