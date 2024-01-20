<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<link href="../bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

<style type="text/css">

/* ============ desktop view ============ */
@media all and (min-width: 992px) {

	.dropdown-menu li{
		position: relative;
	}
	.dropdown-menu .submenu{ 
		display: none;
		position: absolute;
		left:100%; top:-7px;
	}
	.dropdown-menu .submenu-left{ 
		right:100%; left:auto;
	}

	.dropdown-menu > li:hover{ background-color: #f1f1f1 }
	.dropdown-menu > li:hover > .submenu{
		display: block;
	}
}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

.dropdown-menu .dropdown-menu{
		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
}

}	
/* ============ small devices .end// ============ */

</style>


<script type="text/javascript">
//	window.addEventListener("resize", function() {
//		"use strict"; window.location.reload(); 
//	});


	document.addEventListener("DOMContentLoaded", function(){
        

    	/////// Prevent closing from click inside dropdown
		document.querySelectorAll('.dropdown-menu').forEach(function(element){
			element.addEventListener('click', function (e) {
			  e.stopPropagation();
			});
		})



		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});
			
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {
		
				  	let nextEl = this.nextElementSibling;
				  	if(nextEl && nextEl.classList.contains('submenu')) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				});
			})
		}
		// end if innerWidth

	}); 
	// DOMContentLoaded  end
</script>
<? require "../variaveis.php"; ?>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
     <img src="../img/logo.fw.png" alt="..." width="180" height="150" class="rounded float-left">
    </div><!-- col-sm -->

    <div class="col-sm">
     <span style="text-align:center;">
     <p class="text-center">
     <? 
	 	if($apenas_hora >=5 && $apenas_hora < 9){
		 	echo "<img src='../img/amanhecer.png' width='100' height='50'><br>";
		 	echo "Bom dia!";
		}elseif($apenas_hora >=9 && $apenas_hora < 12){
			echo "<img src='../img/sol_da_manha.png' width='100' height='70'><br>";
		 	echo "Bom dia!";
	 	}elseif($apenas_hora >=12 && $apenas_hora < 16){
		 	echo "<img src='../img/sol_meio_dia.png' width='60' height='50'><br>";
		 	echo "Boa tarde!";
	 	}elseif($apenas_hora >=16 && $apenas_hora < 18){
			echo "<img src='../img/sol_se_pondo.png' width='100' height='70'><br>";
			echo "Quase anoitecendo!";
		}else{
		 	echo "<img src='../img/lua_noite.png' width='150' height='70'><br>";
			echo "Boa noite!";
     } ?>


     <br />
     <strong><? echo $nome; ?> -   <a href="?p=extras&sair=sair">Sair</a></strong><br />
     <a rel="superbox[iframe][230x220]" class="btn btn-info" href="scripts/alterar_senha.php?op=<? echo base64_encode($operador); ?>"><strong>Alterar senha</strong></a>
     </p>
     </span>
    </div><!-- col-sm -->
  </div><!-- row -->
  
  

<div class="container">

<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <? if($tipo == 'PROFESSOR' || $tipo == 'AEE'){ ?>
  <div class="collapse navbar-collapse" id="main_nav">
	<ul class="navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> MINHAS TURMAS </a>
              <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=frequencia_dia">Frequência do dia</a>
			  <li><a class="dropdown-item" href="?p=<? if($_GET['p'] == 'lancar_frequencia'){ echo "aee"; }else{ echo "turmas"; } ?>">Listar turmas</a>
				 </ul>
			  </li>   
			<li><a class="nav-link dropdown-toggle" href="?p=listar_calendario&mes=<? echo date("m"); ?>"> CALENDÁRIO LETIVO </a></li>
			<li><a class="nav-link dropdown-toggle" href="?p=tutoriais"> TUTORIAIS </a></li>
            </ul>
     </ul>
  <? }else{ ?>
  
  <div class="collapse navbar-collapse" id="main_nav">
	<ul class="navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> PEGAGÓGICO </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="#">BNCC</a>
			  	 <ul class="submenu dropdown-menu">
				    <li><a class="dropdown-item" href="?p=eixo">Eixo temático</a></li>
				    <li><a class="dropdown-item" href="?p=conteudo">Conteúdos</a>
				    <li><a class="dropdown-item" href="?p=habilidade">Habilidades</a></li>
				    </li>
				 </ul>
			  </li>
			  <li><a class="dropdown-item" href="?p=anos">Turmas</a></li>
			  <li><a class="dropdown-item" href="?p=coordenadores">Controle de material didático</a>
			  	 <ul class="submenu dropdown-menu">
				    <li><a class="dropdown-item" href="?p=entrega_livros">Livros didáticos</a></li>
				    <li><a class="dropdown-item" href="?p=livros_extra_classe">Livros extra classe</a>
				    <li><a class="dropdown-item" href="?p=outros_recursos">Outros recursos</a>
				    </li>
				 </ul>              
              </li>
			  <li><a class="dropdown-item" href="?p=recursos_digitais">Agendamento Recursos digitais</a></li>
              <li><a class="dropdown-item" href="?p=anos">Acompanhamento</a>
			  	 <ul class="submenu dropdown-menu">
				    <li><a class="dropdown-item" href="?p=eixo">Discentes</a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item" href="?p=infrequencia">Infrequência</a>
                     	<ul class="submenu dropdown-menu">
                        	<li><a class="dropdown-item" rel="superbox[iframe][500x100]" href="scripts/filtro_infrequencia_relatorio_semanal.php">Relatório semanal</a></li>
	                    </ul>
                        </li>
                        <li><a class="dropdown-item" href="?p=notas_baixas">Notas baixa</a></li>
                        <li><a class="dropdown-item" href="?p=evasao">Risco de evasão</a></li>
                        <li><a class="dropdown-item" href="?p=infrequencia_auxilio_brasil">Auxilio Brasil</a></li>
                        </li>
                     </ul>                      
                    </li>
				    <li><a class="dropdown-item" href="?p=eixo">Docentes</a>
                     <ul class="submenu dropdown-menu">
                        <li><a class="dropdown-item">Plano de aula</a>
                     		<ul class="submenu dropdown-menu">
		                        <li><a class="dropdown-item" href="?p=plano_de_aula_pendente">Planos de aula pendentes</a>
                                    <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" href="?p=plano_de_aula_pendente_iniciais">Planos anos iniciais</a></li>
                                    <li><a class="dropdown-item" href="?p=plano_de_aula_pendente">Planos anos finais</a></li>
                                    </ul>
                                </li>
		                        <li><a class="dropdown-item" href="?p=consultar_planos_finais">Consulta de planos de aula</a></li>                                <li><a class="dropdown-item" href="?p=plano_de_aula_visao_semanal">Visão semanal</a></li>
		                    </ul>
                        </li>
                        <li><a class="dropdown-item" href="?p=postagem_atividades">Postagem de atividades</a></li>
                        <li><a class="dropdown-item" href="?p=postagem_frequencia">Postagem de frequência</a></li>
                        <li><a class="dropdown-item" href="?p=correcao_atividades">Correção de atividades</a></li>
                        <li><a class="dropdown-item" href="?p=lancamento_notas">Lançamento de notas</a></li>
                        </li>
                     </ul>                      
                    </li>                    
                    </li>
				    </li>
				 </ul>              
              </li>
			  <li><a class="dropdown-item" href="?p=coordenadores">Atividades Online</a>
               <ul class="submenu dropdown-menu">
                  <li><a class="dropdown-item" href="?p=eixo">Impressão de materiais impressos</a></li>
                  <li><a class="dropdown-item" href="?p=eixo">Acompnhamento de material impresso</a></li>
                  <li><a class="dropdown-item" href="?p=eixo">Devolução de atividades impressas</a></li>
                  <li><a class="dropdown-item" href="?p=eixo">Lançar notas e frequências de material impresso</a></li>
              </ul>                 
              </li>              
              <li><a class="dropdown-item" href="?p=tutoriais">Tutoriais</a></li>
              </li>
		    </ul>
		</li>

 
         
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> ALUNO </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=cadastrar_aluno">Cadastrar aluno</a></li>
			  <li><a class="dropdown-item" href="?p=listar_alunos">Listar alunos</a></li>
			  <li><a class="dropdown-item" href="?p=cadastrar_transportes">Comunidades</a></li>
			  <li><a class="dropdown-item" href="?p=cadastrar_rota">Rota</a></li>
			  <li><a class="dropdown-item" href="?p=listar_alunos">Livro de ocorrências</a></li>
			  <li><a class="dropdown-item" href="?p=relatorio_vacinacao_alunos">Relatório de vacinação</a>
              <ul class="submenu dropdown-menu">
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao_alunos">Visão geral</a></li>
                  <li><a class="dropdown-item" href="?p=relatorio_por_tuma">Relatório por turma</a></li>
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao">Relatório de não vacinados</a></li>
              </ul> 
              </li>
		    </ul>
		</li>
         
         
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> PROFESSORES </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=professores">Listar professores</a></li>
		    </ul>
		</li>
        
 
         
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> COLABORADORES </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=novocolaborador">Cadastrar novo colaborador</a></li>
			  <li><a class="dropdown-item" href="?p=mostra_colaboradores">Listar colaboradores</a></li>
			  <li><a class="dropdown-item" href="?p=mostra_colaboradores">Vacinação COVID-19</a>
              <ul class="submenu dropdown-menu">
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao">Relatório de vacinados</a></li>
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao">Relatório de vacinação 1° dose</a></li>
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao">Relatório de vacinação 2° dose</a></li>
                  <li><a class="dropdown-item" href="?p=relatorio_vacinacao">Relatório de vacinação 3° dose</a></li>
              </ul>               
              </li>
		    </ul>
		</li>   
        
 
         
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> CALENDÁRIO LETIVO </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=calendario_nova_atividade">Nova atividade</a></li>
			  <li><a class="dropdown-item" href="?p=listar_calendario&mes=<? echo date("m"); ?>">Listar calendário</a></li>
		    </ul>
		</li>  
         
        <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> SITE </a>
		    <ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="?p=calendario_nova_atividade">Nova publicação</a></li>
			  <li><a class="dropdown-item" href="?p=listar_calendario&mes=<? echo date("m"); ?>">Listar calendário</a></li>
		    </ul>
		</li>          
        
        <li class="nav-item dropdown">
         <form name="" method="post" action="" enctype="multipart/form-data">
          <input type="text" class="form-control" name="consulta" placeholder="Digite o nome do aluno" />
         </form>
        </li>
	</ul>
	<? } ?>
  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>
  
  
  
  
  
</div><!-- container -->

<? if(isset($_POST['consulta'])){

$consulta = $_POST['consulta'];

$sql_consulta = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno LIKE '%$consulta%'");
if(mysqli_num_rows($sql_consulta) == ''){
	echo "<script language='javascript'>window.alert('Não foi encontrado nenhum aluno com as informações digitadas! $consulta');</script>";
}else{
	echo "<script language='javascript'>window.location='?p=alunos&key=$consulta';</script>";
}
}?>



</body>
</html>
<? if(@$_GET['sair'] == 'sair'){

 session_start();
 $_SESSION['code'] = 01;
 
 echo "<script language='javascript'>window.location='';</script>";


}?>