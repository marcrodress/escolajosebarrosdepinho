<?php
session_start(); $aluno = $_SESSION['aluno']; $atividade = $_SESSION['atividade'];
require "../conexao.php";


//Receber os dados do formulário
$enviar_docs = $_FILES['enviar_docs']['name'];

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");

$arquivo = $enviar_docs;
$arquivo = strrchr($enviar_docs, '.');
$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);


if($enviar_docs == ''){
echo "<script language='javascript'>window.alert('Você não anexou a atividade!');</script>";
}else{

if(file_exists("../professor/arquivos/$enviar_docs")){ $a = 1;while(file_exists("../professor/arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}



$resultado_imagem = mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET presente = 'SIM', data = '$data_completa', status = 'AGUARDA', arquivo = '$enviar_docs' WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");

mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas_extras (data, status, arquivo, code_aluno, code_atividade) VALUES ('$data_completa', 'AGUARDA', '$enviar_docs', '$aluno', '$atividade')");



//Fazer o Upload
move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../professor/arquivos/".$enviar_docs);
//Salvar no BD

$dia_atividade = 0;
$mes_atividade = 0;
$ano_atividade = 0;
$turma = 0;
			$verifica_aluno_aee = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$aluno' AND especial = 'SIM'");
			 if(mysqli_num_rows($verifica_aluno_aee) >= 1){
				 
				 $sql_data_envio = mysqli_query($conexao_bd, "SELECT * FROM atividades WHERE code_atividade = '$atividade'");
					while($res_data_envio = mysqli_fetch_array($sql_data_envio)){
						$dia_atividade = $res_data_envio['dia'];
						$mes_atividade = $res_data_envio['mes'];
						$ano_atividade = $res_data_envio['ano'];
						$turma = $res_data_envio['turma'];
				   }
				 
				 
				 
				 
				 
				 $sql_registro_aee = mysqli_query($conexao_bd, "SELECT * FROM registro_aee WHERE aluno = '$aluno' AND dia_atividade = '$dia_atividade' AND mes_atividade = '$mes_atividade' AND ano_atividade = '$ano_atividade'");
				 if(mysqli_num_rows($sql_registro_aee) == ''){
					 mysqli_query($conexao_bd, "INSERT INTO registro_aee (ip, dia, mes, ano, data_completa, turma, aluno, usuario, dia_atividade, mes_atividade, ano_atividade) VALUES ('$ip', '$dia', '$mes', '$ano', '$data_completa', '$turma', '$aluno', '$operador', '$dia_atividade', '$mes_atividade', '$ano_atividade')");

				 }
				 
				 
			}




	if($resultado_imagem == ''){
		$_SESSION['msg'] = "<div class='alert alert-danger'>Ocorreu um erro em seu envio, tente novamente!</div>";
	}else{
		$_SESSION['msg'] = "<div class='alert alert-success'>Atividade enviada com sucesso! $destination_img</div>";
	}
}