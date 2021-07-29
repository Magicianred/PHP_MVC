<?php

	class AdminController{
		public function index(){//Método
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('admin.html');//Localizando/Chamando a pasta View

				$objPostagens = Postagem::selecinaTodos();
				
				$parametros = array();
				$parametros['postagens'] = $objPostagens;

				//Passando para View
				$conteudo = $template->render($parametros);
				echo $conteudo;			
		}

		public function create(){//Método
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('create.html');//Localizando/Chamando na pasta View

				//Passando para View
				$parametros = array();
				
				$conteudo = $template->render($parametros);
				echo $conteudo;
		}

		public function insert(){			
			try{
				//Enviando para class Postagem na model Postagem
				Postagem::insert($_POST);

				echo '<script>alert("Publicação inserida com sucesso!");</script>';
				// Modificar URL no site online!!!
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=create"</script>';
			}
		}

		public function change($paramId){
			$loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
			$template = $twig->load('update.html');//Localizando/Chamando na pasta View

			$post = Postagem::selecionaporId($paramId);//Consegue acessar de forma direta porque os atributos estão como public
			
			//Passando para View
			$parametros = array();
			$parametros['id'] = $post->id;
			$parametros['titulo'] = $post->titulo;
			$parametros['conteudo'] = $post->conteudo;
			
			$conteudo = $template->render($parametros);
			echo $conteudo;
		}

		public function update(){
			try{
				Postagem::update($_POST);
				echo '<script>alert("Publicação alterada com sucesso!");</script>';
				// Modificar URL no site online!!!
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=change&id='.$_POST['id'].'"</script>';
			}		
		}

		public function delete($paramId){//Isso $paramId funciona porque foi setado no core de inicio
			
			try{
				Postagem::delete($paramId);
				echo '<script>alert("Publicação deletada com sucesso!");</script>';
				// Modificar URL no site online!!!
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=index"</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=admin&metodo=index"</script>';
			}
		}
	}