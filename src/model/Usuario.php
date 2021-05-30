<?php

namespace zinobe\model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;


/**
 * @Entity
 * @Table(name="usuarios")
 **/
class Usuario {
  /**
   * @Id
   * @GeneratedValue
   * @Column(type="integer")
   * @var int
   **/
  protected $id;

  /**
   * @Column(type="string")
   * @var string
   **/
  protected $nombre;

  /**
   * @Column(type="string")
   * @var string
   */
  protected $documento;

  /**
   * @Column(type="string")
   * @var string
   **/
  protected $correo;

  /**
   * @Column(type="string")
   * @var string
   */
  protected $pais;

  /**
   * @Column(type="string")
   * @var string
   */
  protected $clave;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getNombre(): string {
    return $this->nombre;
  }

  /**
   * @param string $nombre
   */
  public function setNombre(string $nombre): void {
    $this->nombre = $nombre;
  }

  /**
   * @return string
   */
  public function getDocumento(): string {
    return $this->documento;
  }

  /**
   * @param string $documento
   */
  public function setDocumento(string $documento): void {
    $this->documento = $documento;
  }

  /**
   * @return string
   */
  public function getCorreo(): string {
    return $this->correo;
  }

  /**
   * @param string $correo
   */
  public function setCorreo(string $correo): void {
    $this->correo = $correo;
  }

  /**
   * @return string
   */
  public function getPais(): string {
    return $this->pais;
  }

  /**
   * @param string $pais
   */
  public function setPais(string $pais): void {
    $this->pais = $pais;
  }

  /**
   * @return string
   */
  public function getClave(): string {
    return $this->clave;
  }

  /**
   * @param string $clave
   */
  public function setClave(string $clave): void {
    $this->clave = $clave;
  }

}