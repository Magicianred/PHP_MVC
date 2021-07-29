<?php

	class HomeController{
		public function index(){
			try{
				$colecPostagens = Postagem::selecinaTodos();//Conecta na pagina Postagem e executa o método selecinaTodos()

				$loader = new \Twig\Loader\FilesystemLoader('app/View');
				$twig = new \Twig\Environment($loader);
				$template = $twig->load('home.html');

				$parametros = array();
				$parametros['postagens'] = $colecPostagens;
				// echo "<pre>";
				// var_dump($parametros['postagens']);
				// echo "</pre>";

				$conteudo = $template->render($parametros);

				echo $conteudo;				
				
			}catch(Exception $e){
				echo $e->getMessage();
			}			
		}
	}