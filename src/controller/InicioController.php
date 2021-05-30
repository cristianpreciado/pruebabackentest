<?php
namespace zinobe\controller;

use zinobe\helper\doctrine\DoctrineHelper;
use zinobe\helper\twig\TwigHelper;

class InicioController {

	public function index() {
		session_start();
		if ($_SESSION["usuario"]) {
			return TwigHelper::renderTemplate('busqueda.html');
		}
		return TwigHelper::renderTemplate('index.html');
	}
	public function buqueda(){
		session_start();
		if (!$_SESSION["usuario"]) {
			return TwigHelper::renderTemplate('index.html');
		}
        return TwigHelper::renderTemplate('busqueda.html');
    }
}