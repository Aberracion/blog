<?php
namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Config\Definition\Exception\Exception;
use Monolog\DateTimeImmutable;

use App\Entity\Post;
use App\Service\AuthorService;

class PostService
{
    private $authorService;
    private $entityManager;

    public function __construct(AuthorService $authorService, ManagerRegistry $doctrine)
    {
        $this->authorService = $authorService;
        $this->entityManager = $doctrine->getManager();
    }

    public function add($new_post)
    {
        try{
          $this->checkValidPost($new_post);
          $author = $this->authorService->findByName($new_post['author_name']);
          $post = new Post();
          $post->setAuthor($author)
              ->setSubject($new_post['subject'])
              ->setBody($new_post['body'])
              ->setCreatedAt(new DateTimeImmutable('now'));
          $this->entityManager->persist($post);
          $this->entityManager->flush();
        } catch(Exception $exc){
          throw new Exception($exc->getMessage());
        }
    }

    public function get($id)
    {
        try{
          $post = $this->entityManager->getRepository(Post::class)->find($id);
          return $post;
        } catch(Exception $exc){
          throw new Exception($exc->getMessage());
        }
    }

    private function checkValidPost($new_post){
      if(!isset($new_post['author_name']))
        throw new Exception('Undefined author_name');
      if(!isset($new_post['subject']))
        throw new Exception('Undefined subject');
      if(!isset($new_post['body']))
        throw new Exception('Undefined body');
      return true;
    }
}
