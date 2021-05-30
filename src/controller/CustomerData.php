<?php
namespace zinobe\controller;

use zinobe\helper\service\ConsumoApi;
use zinobe\helper\service\Util;
use zinobe\helper\doctrine\DoctrineHelper;
use zinobe\model\Usuario;

class CustomerData {
    public function validarDocumento($documento) {
        $respuesta=[];
        $dataUsuarioIngles=ConsumoApi::getDataApi("http://www.mocky.io/v2/5d9f39263000005d005246ae?mocky-delay=10s");
        $resultadoValidacion=Util::recorridoApi($dataUsuarioIngles,"objects","document",$documento);
        if (!$resultadoValidacion) {
            $dataUsuario=ConsumoApi::getDataApi("http://www.mocky.io/v2/5d9f38fd3000005b005246ac?mocky-delay=10s");
            $resultadoValidacion=Util::recorridoApi($dataUsuario,"objects","cedula",$documento);
        }
        $mensaje=false;
        if ($resultadoValidacion) {
            if($resultadoValidacion["document"]){
                $mensaje=self::crearUsuario($resultadoValidacion["first_name"]." ".$resultadoValidacion["last_name"],$resultadoValidacion["document"],$resultadoValidacion["email"],$resultadoValidacion["country"],"password1");
            }else{
                $mensaje=self::crearUsuario($resultadoValidacion["primer_nombre"]." ".$resultadoValidacion["apellido"],$resultadoValidacion["cedula"],$resultadoValidacion["correo"],$resultadoValidacion["pais"],"clave1");
            }
        }
        return ["validacion"=>$resultadoValidacion,"mensaje"=>$mensaje];
    }

    private function crearUsuario($nombre,$documento,$email,$pais,$password){
        $entityManager = DoctrineHelper::getEntityManager();
        $usuario = new Usuario();
        $usuario->setNombre($nombre);
        $usuario->setDocumento($documento);
        $usuario->setCorreo($email);
        $usuario->setPais($pais);
        $usuario->setClave($password);
        try {
            $entityManager->persist($usuario);
            $entityManager->flush($usuario);
        } catch (Exception $e) {
            return ["mensaje"=>"No se pudo crear el usuario"];
        }
        return ["mensaje"=>"Usuario creado"];
    }
}