<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?

switch($_GET['p']){

// ESCOLAS
	case 'anos';
	include 'anos.php';
	break;

	case 'lancar_frequencia';
	include 'lancar_frequencia.php';
	break;
	
	case 'visao_geral_de_alunos';
	include 'visao_geral_de_alunos.php';
	break;
	
	case 'componentes';
	include 'componentes.php';
	break;

	case 'professores';
	include 'professores.php';
	break;
	
	case 'visao_geral_professor';
	include 'visao_geral_professor.php';
	break;
// FIM DA ESCOLA

	case 'lancar_nota';
	include 'lancar_nota.php';
	break;
	
	case 'escolas';
	include 'escolas.php';
	break;
		
	case 'series';
	include 'series.php';
	break;
		
	case 'turmas';
	include 'turmas.php';
	break;
	
	case 'componentes';
	include 'componentes.php';
	break;
	
	case 'habilidades';
	include 'habilidades.php';
	break;
	
	case 'alunos';
	include 'alunos.php';
	break;

	case 'atividades';
	include 'atividades.php';
	break;
	
	case 'extras';
	include 'extras.php';
	break;

	case 'mostrar_atividades_turma';
	include 'mostrar_atividades_turma.php';
	break;
	
	case 'fazer_correcao';
	include 'fazer_correcao.php';
	break;
	
	case 'fazer_correcao_multiplica';
	include 'fazer_correcao_multiplica.php';
	break;	
	
	
}


?>
</body>
</html>