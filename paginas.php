<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?

switch($_GET['p']){

// COORDENAÇÃO
	case 'eixo';
	include 'eixo.php';
	break;
	
	case 'habilidade';
	include 'habilidades.php';
	break;
	
	case 'conteudo';
	include 'conteudo.php';
	break;
	
	case 'recursos_digitais';
	include 'recursos_digitais.php';
	break;
	
	case 'entrega_livros';
	include 'entrega_livros.php';
	break;
	
	case 'livros_extra_classe';
	include 'livros_extra_classe.php';
	break;
	
	case 'outros_recursos';
	include 'outros_recursos.php';
	break;
	
	case 'calendario_nova_atividade';
	include 'calendario_nova_atividade.php';
	break;
	
	case 'listar_calendario';
	include 'listar_calendario.php';
	break;
	
	case 'postagem_atividades';
	include 'postagem_atividades.php';
	break;
	
	case 'plano_de_aula_pendente';
	include 'plano_de_aula_pendente.php';
	break;
	
	case 'plano_de_aula_pendente_iniciais';
	include 'plano_de_aula_pendente_iniciais.php';
	break;
	
	case 'consultar_planos_finais';
	include 'consultar_planos_finais.php';
	break;
	
	case 'plano_de_aula_visao_semanal';
	include 'plano_de_aula_visao_semanal.php';
	break;
	
	case 'tutoriais';
	include 'tutoriais.php';
	break;
	
	case 'infrequencia_relatorio_semanal';
	include 'infrequencia_relatorio_semanal.php';
	break;
	
	case 'infrequencia';
	include 'infrequencia.php';
	break;
	
	case 'evasao';
	include 'evasao.php';
	break;
	
	case 'notas_baixas';
	include 'notas_baixas.php';
	break;
	
	case 'infrequencia_auxilio_brasil';
	include 'infrequencia_auxilio_brasil.php';
	break;
// FIM DA COORDENAÇÃO


// DIREAÇÃO
	case 'novocolaborador';
	include 'novocolaborador.php';
	break;
	
	case 'mostra_colaboradores';
	include 'mostra_colaboradores.php';
	break;	
	
	case 'coordenadores';
	include 'coordenadores.php';
	break;	
	
	case 'postagem_atividades';
	include 'postagem_atividades.php';
	break;	
	
	case 'relatorio_vacinacao_alunos';
	include 'relatorio_vacinacao_alunos.php';
	break;	
	
//



// SECRETARIA
	case 'cadastrar_aluno';
	include 'cadastrar_aluno.php';
	break;
	
	case 'listar_alunos';
	include 'listar_alunos.php';
	break;

	
	case 'relatorio_por_tuma';
	include 'relatorio_por_tuma.php';
	break;

// DIRETOR
	case 'anos';
	include 'anos.php';
	break;

// PROFESSORES

	case 'turmas';
	include 'turmas.php';
	break;
	
	case 'aee';
	include 'aee.php';
	break;
	
	case 'frequencia_dia';
	include 'frequencia_dia.php';
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
		

	
	case 'componentes';
	include 'componentes.php';
	break;
	
	case 'habilidades';
	include 'habilidades.php';
	break;
	
	case 'alunos';
	include 'alunos.php';
	break;
	
	case 'cadastrar_transportes';
	include 'cadastrar_transportes.php';
	break;
	
	case 'cadastrar_rota';
	include 'cadastrar_rota.php';
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

	case 'plano_de_aula';
	include 'plano_de_aula.php';
	break;

	case 'plano_de_aula_finais';
	include 'plano_de_aula_finais.php';
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