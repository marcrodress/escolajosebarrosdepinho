<?php
require "../../conexao.php";

session_start(); $_SESSION['id_atividade'] = base64_decode($_GET['ik']); $id_atividade = base64_decode($_GET['ik']);

$sql_atividade = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE id = '$id_atividade'");
while($res_atividade = mysqli_fetch_array($sql_atividade)){
	
	$habi = $res_atividade['objetivo'];
	$componente = $res_atividade['componente'];
	$turma = $res_atividade['turma'];
	$usuario = $res_atividade['usuario'];
	$code_entrega = $res_atividade['code_entrega'];
	$plano = $res_atividade['plano'];
	
}


?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
        
        	<h4><strong>Envio de plano de aula</strong></h4>
            <hr>
        <div class="row">
            <div class="col-sm">
              <p style="padding:5px; border-radius:5px;" class="p-3 mb-2 bg-primary text-white"><strong>Objetivo:</strong> <? echo $habi; ?></p>
              <p class="h6"><strong class="text-primary">Professor:</strong> 
			  <?
			  $sql_professor = mysqli_query($conexao_bd, "SELECT * FROM acesso_sistema WHERE code = '$usuario'");
              	while($res_professor = mysqli_fetch_array($sql_professor)){
                 	echo $res_professor['nome_escola'];
              	}
			  
			  ?>			  
              </p>
              <p class="h6"><strong class="text-primary">Turma:</strong> <? 
             
             $sql_disciplinas = mysqli_query($conexao_bd, "SELECT * FROM disciplinas WHERE code = '$componente'");
              while($res_disciplinas = mysqli_fetch_array($sql_disciplinas)){
                 $componente = $res_disciplinas['componente'];
              }
            
              $sql_turma = mysqli_query($conexao_bd, "SELECT * FROM turmas WHERE code_turma = '$turma'");
                while($res_turma = mysqli_fetch_array($sql_turma)){
                    echo $res_turma['code_serie']; echo "° ANO "; echo $res_turma['tipo_turma']; echo " - "; echo $componente; echo "
                     - TURNO: "; echo $res_turma['turno'];
                }
              ?></p>
              <p class="h6"><strong class="text-primary">Data m&aacute;xima de envio:</strong> 
			  <?
              
			  $sql_datas_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '$code_entrega'");
              	while($res_datas_vencimento = mysqli_fetch_array($sql_datas_vencimento)){
                 	echo $res_datas_vencimento['vencimento'];
              	}
			  
			  ?>
              </p>
            </div><!-- col-sm -->
            
            <? if($_GET['send'] == ''){?>
            <img style="float:left;" src="../img/whatsapp.png" width="20" height="20" /></strong><br /></h1>
            <input type="text" id="texto" style="font:12px Arial, Helvetica, sans-serif; float:left;" value="http://escolaleornebelem.com/upload_plano/?ik=<? echo $_GET['ik']; ?>&send=whatsapp" readonly="readonly" />
            <button style="font:12px Arial, Helvetica, sans-serif; float:left;" id="botao">Copiar</button>
            
            <script language="javascript">
            document.getElementById("botao").addEventListener("click", function(){
            
            document.getElementById("texto").select();
            
            document.execCommand('copy');
            
            });
            </script>
            <? } ?>
            
            
            
            <hr>
            <? if($plano != ''){ ?>
            Plano enviado
            <a target="_blank" href="../arquivos/<? echo $plano;  ?>">Verificar plano</a>
			<? } ?>            
        </div><!-- row -->
        
        
			<?php 
				  
			if(isset($_SESSION['msg'])){ 
				
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
				
			}
			?>
			<hr>
			<form action="#" class="form-horizontal"> 
		
				<div class="form-group">
					<div class="col-sm-10">
						<input type="file" name="enviar_docs" class="form-control">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-10">
						<div class="progress progress-striped active">
							<div class="progress-bar" style="width: 0%">
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button style="margin:-20px 0 0 0;" type="submit" class="btn btn-success upload">Enviar</button>
					</div>
				</div>
			</form>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
		<script>
			$(document).on('submit', 'form', function (e) {
				e.preventDefault();
				//Receber os dados
				$form = $(this);				
				var formdata = new FormData($form[0]);
				
				//Criar a conexao com o servidor
				var request = new XMLHttpRequest();
				
				//Progresso do Upload
				request.upload.addEventListener('progress', function (e) {
					var percent = Math.round(e.loaded / e.total * 100);
					$form.find('.progress-bar').width(percent + '%').html(percent + '%');
				});
				
				//Upload completo limpar a barra de progresso
				request.addEventListener('load', function(e){
					$form.find('.progress-bar').addClass('progress-bar-success').html('Plano sendo enviada, aguarde...');
					//Atualizar a página após o upload completo
					setTimeout("window.open(self.location, '_self');", 1000);
				});
				
				//Arquivo responsável em fazer o upload da imagem
				request.open('post', 'processa.php');
				request.send(formdata);
			});
		</script>
	</body>
</html>