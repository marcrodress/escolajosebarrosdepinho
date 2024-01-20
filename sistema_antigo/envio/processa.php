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



$resultado_imagem = mysqli_query($conexao_bd, "UPDATE atividades_enviadas SET data = '$data_completa', status = 'AGUARDA', arquivo = '$enviar_docs' WHERE code_atividade = '$atividade' AND code_aluno = '$aluno'");

mysqli_query($conexao_bd, "INSERT INTO atividades_enviadas_extras (data, status, arquivo, code_aluno, code_atividade) VALUES ('$data_completa', 'AGUARDA', '$enviar_docs', '$aluno', '$atividade')");



//Fazer o Upload
move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../professor/arquivos/".$enviar_docs);

//Salvar no BD





	if($resultado_imagem == ''){
		$_SESSION['msg'] = "<div class='alert alert-danger'>Ocorreu um erro em seu envio, tente novamente!</div>";
	}else{
		$_SESSION['msg'] = "<div class='alert alert-success'>Imagem enviada com sucesso!</div>";
	}
}