<?php
namespace zinobe\controller;

use zinobe\helper\doctrine\DoctrineHelper;
use zinobe\helper\twig\TwigHelper;

class InicioController {

	public function index() {
		return TwigHelper::renderTemplate('index.html',["algo"=>"esto"]);
	}

}