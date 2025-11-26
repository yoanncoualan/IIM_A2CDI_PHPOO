<?php
class Categorie
{
 private $id;
 private $nom;
 private $description;

 public function getId(): int
 {
  return $this->id;
 }

 public function getNom(): string
 {
  return $this->nom;
 }

 public function getDescription(): ?string
 {
  return $this->description;
 }

 public function __toString(): string
 {
  return '<h2>' . $this->getNom() . '</h2>' .
   '<p>' . $this->getDescription() . '</p><hr>';
 }
}
