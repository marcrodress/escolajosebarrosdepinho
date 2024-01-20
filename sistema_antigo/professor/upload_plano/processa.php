<?php
session_start(); $id_atividade = $_SESSION['id_atividade'];
require "../../conexao.php";


//Receber os dados do formulário
$enviar_docs = $_FILES['enviar_docs']['name'];

$code_enviar_docs = rand()+rand()+45+date("d")+date("m")+date("Y");

$arquivo = $enviar_docs;
$arquivo = strrchr($enviar_docs, '.');
$enviar_docs = str_replace($enviar_docs, "$code_enviar_docs$arquivo", $enviar_docs);

if($enviar_docs == ''){
echo "<script language='javascript'>window.alert('Você não anexou o plano!');</script>";
}else{

if(file_exists("../arquivos/$enviar_docs")){ $a = 1;while(file_exists("../arquivos/[$a]$enviar_docs")){$a++;}$enviar_docs = "[".$a."]".$enviar_docs;}



$resultado_imagem = mysqli_query($conexao_bd, "UPDATE atividades SET plano = '$enviar_docs' WHERE id = '$id_atividade'");


mysqli_query($conexao_bd, "INSERT INTO acao_professor (ip, data, data_completa, acao, usuario) VALUES ('$ip', '$data', '$data_completa', 'PROFESSOR $usuario, FEZ O ENVIO DO PLANO DE AULA DA ATIVIDADE DO COMPONENTE $componente', '$usuario')");



//Fazer o Upload
move_uploaded_file($_FILES['enviar_docs']['tmp_name'], "../arquivos/".$enviar_docs);
				 
				 


	if($resultado_imagem == ''){
		$_SESSION['msg'] = "<div class='alert alert-danger'>Ocorreu um erro em seu envio, tente novamente!</div>";
	}else{
		$_SESSION['msg'] = "<div class='alert alert-success'>Plano enviado com sucesso!</div>";
	}
}