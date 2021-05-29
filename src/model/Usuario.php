<?php

namespace zinobe\model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;


/**
 * @Entity
 * @UniqueEntity("documento")
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
   * @Column(type="integer", unique=true)
   * @var int
   */
  protected $documento;

  /**
   * @Column(type="string")
   * @var string
   */
  protected $email;

  /**
   * @Column(type="integer")
   * @var int
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
   * @return int
   */
  public function getDocumento(): int {
    return $this->documento;
  }

  /**
   * @param int $documento
   */
  public function setDocumento(int $documento): void {
    $this->documento = $documento;
  }

  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail(string $email): void {
    $this->email = $email;
  }

  /**
   * @return int
   */
  public function getPais(): int {
    return $this->pais;
  }

  /**
   * @param int $pais
   */
  public function setPais(int $pais): void {
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