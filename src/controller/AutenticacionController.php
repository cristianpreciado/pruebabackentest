<?php
namespace zinobe\controller;

use zinobe\helper\doctrine\DoctrineHelper;
use zinobe\helper\twig\TwigHelper;
use zinobe\model\Usuario;

class AutenticacionController {

	public function login() {
        $documento=$_POST["usuario"];
        $clave=$_POST["claveIngreso"];
        $usuario = DoctrineHelper::getRepository(Usuario::class)->findOneBy(array('documento' => $documento));
        if (!empty($usuario)) {
            if ($clave == $usuario->getClave()) {
                self::crearSeccion($usuario->getId(), $usuario->getDocumento(), $usuario->getCorreo());
                return ["ingreso"=>'/busquedainicio'];
            } else {
                return ["mensaje"=>'Contraseña incorrecta'];
            }
        } else {
            return ["mensaje"=>'Usuario no encontrado'];
        }
	}

    private function crearSeccion(int $id, string $usuario, string $correo) {
        session_start();
        $_SESSION['usuarioId']  = $id;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['correo']    = $correo;
    }

    public function logout(){
        session_start();
        unset($_SESSION['usuarioId']);
        unset($_SESSION['usuario']);
        unset($_SESSION['correo']);
        session_destroy();
        return TwigHelper::renderTemplate('index.html');
    }
}