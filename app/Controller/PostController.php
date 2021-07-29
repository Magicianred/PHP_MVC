<?php

	class PostController{
		public function index($params){			
			try{
				$postagem = Postagem::selecionaPorId($params);//Conecta na pagina Postagem e executa o método selecinaTodos()

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('single.html');

				//Passando para View
				$parametros = array();
				$parametros['id'] = $postagem->id;
				$parametros['titulo'] = $postagem->titulo;
				$parametros['conteudo'] = $postagem->conteudo;
				$parametros['comentarios'] = $postagem->comentarios;

				$conteudo = $template->render($parametros);

				echo $conteudo;				
				
			}catch(Exception $e){
				echo $e->getMessage();
			}			
		}

		public function addComent(){
			try{
				Comentario::inserir($_POST);

				header("Location: http://localhost/projetorecicladarte/index.php?pagina=post&id=".$_POST['id']);
			} catch(Exception $e) {
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="http://localhost/projetorecicladarte/?pagina=post&id='.$_POST['id'].'"</script>';
			}			
		}
	}