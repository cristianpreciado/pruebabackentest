<?php

namespace zinobe\helper\service;

class Util {
    public function recorridoApi($data,$llavePrincipal,$llaveSegundaria,$documento){
        $documentoEncontrado=false;
        if ($data[$llavePrincipal]) {
            foreach ($data[$llavePrincipal] as $value) {
                if ($value[$llaveSegundaria]===$documento) {
                    $documentoEncontrado=$value;
                    break;
                }
            }
        }
        return $documentoEncontrado;
    }
}