<?php
namespace zinobe\controller;

use zinobe\helper\service\ConsumoApi;
use zinobe\helper\service\Util;
use zinobe\helper\doctrine\DoctrineHelper;
use zinobe\helper\twig\TwigHelper;
use zinobe\model\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomerData {
    public function validarDocumento() {
        $documento=$_POST["ndocumento"];
        $respuesta=[];
        $usuarioRepository = DoctrineHelper::getRepository(Usuario::class)->findOneBy(array('documento' => $documento));
        $mensaje=false;
        $resultadoValidacion=$usuarioRepository;
        if (!$usuarioRepository) {
            $dataUsuarioIngles=ConsumoApi::getDataApi("http://www.mocky.io/v2/5d9f39263000005d005246ae?mocky-delay=10s");
            $resultadoValidacion=Util::recorridoApi($dataUsuarioIngles,"objects","document",$documento);
            if (!$resultadoValidacion) {
                $dataUsuario=ConsumoApi::getDataApi("http://www.mocky.io/v2/5d9f38fd3000005b005246ac?mocky-delay=10s");
                $resultadoValidacion=Util::recorridoApi($dataUsuario,"objects","cedula",$documento);
            }
            if ($resultadoValidacion) {
                if($resultadoValidacion["document"]){
                    $mensaje=self::crearUsuario($resultadoValidacion["first_name"]." ".$resultadoValidacion["last_name"],$resultadoValidacion["document"],$resultadoValidacion["email"],$resultadoValidacion["country"],"password1");
                }else{
                    $mensaje=self::crearUsuario($resultadoValidacion["primer_nombre"]." ".$resultadoValidacion["apellido"],$resultadoValidacion["cedula"],$resultadoValidacion["correo"],$resultadoValidacion["pais"],"clave1");
                }
            }
        }else{
            $mensaje="El usuario ya existe";
        }
        return ["validacion"=>$resultadoValidacion,"mensaje"=>$mensaje];
    }

    public function registrarUsuario(){
        $nombre=$_POST["nombre"];
        $documento=$_POST["documento"];
        $correo=$_POST["correo"];
        $pais=$_POST["pais"];
        $clave=$_POST["clave"];
        $usuarioRepository = DoctrineHelper::getRepository(Usuario::class)->findOneBy(array('documento' => $documento));
        $usuarioCorreoRepository = DoctrineHelper::getRepository(Usuario::class)->findOneBy(array('correo' => $correo));
        $mensaje="";
        if($nombre ==="" || $documento ==="" || $correo ==="" || $pais ==="" || $clave ===""){
            $mensaje.="<li>Todos los campos son obligatorios.</li>";
        }
        if(strlen($nombre) < 3){
            $mensaje.="<li>El nombre debe ser de minimo 3 caracteres.</li>";
        }
        if($usuarioRepository){
            $mensaje.="<li>El documento ya existe.</li>";
        }
        if($usuarioCorreoRepository){
            $mensaje.="<li>El correo ya existe.</li>";
        }
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $mensaje.="<li>El correo es invalido.</li>";
        }
        if(strlen($clave) < 6 || !preg_match('`[a-zA-Z0-9]`',$clave)){
            $mensaje.="<li>La clave debe cumplir con caracteres validos, minimo 6 cracteres y al menos un digito.</li>";
        }
        if(strlen($mensaje)==0){
            $mensaje="<li>".self::crearUsuario($nombre,$documento,$correo,$pais,$clave)."</li>";
        }
        return ["mensaje"=>$mensaje];
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
            return "No se pudo crear el usuario";
        }
        return "Usuario creado! ya puedes ingresar";
    }

    public function buscarUsurarios(){
        $busqueda=$_POST["busqueda"];
        $entityManager = DoctrineHelper::getEntityManager();
        $result = $entityManager->getRepository(Usuario::class)->createQueryBuilder('u')
        ->where('u.nombre = :nombre')
        ->orWhere('u.correo = :correo')
        ->setParameter('nombre', $busqueda)
        ->setParameter('correo', $busqueda)
        ->getQuery()
        ->getArrayResult();
        $twigTemplate = TwigHelper::renderTemplate('resultadosBusqueda.html',["resultadoUsuario"=>$result]);
        return new JsonResponse(['html' => $twigTemplate]);
    }
}