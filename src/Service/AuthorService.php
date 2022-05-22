<?php
namespace App\Service;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Author;

class AuthorService
{
  private $entityManager;
  private $doctrine;

  public function __construct(ManagerRegistry $doctrine)
  {
      $this->entityManager = $doctrine->getManager();
  }

  public function findByName($name){
    $author = $this->entityManager->getRepository(Author::class)->findOneBy(['name' => $name]);
    if($author == null)
      return $this->addandget($name);
    else
      return $author;
  }

  private function addandget($name){
    $author = new Author();
    $author->setName($name);
    $this->entityManager->persist($author);
    return $author;
  }

}
