<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Config\Definition\Exception\Exception;

use App\Service\PostService;

class PostTest extends KernelTestCase
{
    public function testSavePost(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        try{
          $new_post = array(
            'author_name'=> 'UserTest',
            'subject'=> 'Prueba',
            'body'=> 'Esto es una prueba'
          );
          $post_service = $container->get(PostService::class);
          $post_service->add($new_post);
          $this->assertTrue(true);
        } catch (InvalidArgumentException $notExpected) {
          $this->assertTrue(false);
        }
    }

    public function testExceptionsEmptyAuthor(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $post_service = $container->get(PostService::class);

        $new_post = array(
          'subject'=> 'Prueba',
          'body'=> 'Esto es una prueba'
        );
        $this->expectException("Exception");
        $post_service->add($new_post);
    }

    public function testExceptionsEmptySubject(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $post_service = $container->get(PostService::class);

        $new_post = array(
          'author_name'=> 'UserTest',
          'body'=> 'Esto es una prueba'
        );
        $this->expectException("Exception");
        $post_service->add($new_post);
    }

    public function testExceptionsEmptyBody(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $post_service = $container->get(PostService::class);

        $new_post = array(
          'author_name'=> 'UserTest',
          'subject'=> 'Prueba',
        );
        $this->expectException("Exception");
        $post_service->add($new_post);
    }

    public function testGetPost():void
    {
      $kernel = self::bootKernel();
      $container = static::getContainer();
      $post_service = $container->get(PostService::class);
      $post = $post_service->get(1);
      $this->assertEquals("UserTest",$post->getAuthor()->getName());
      $this->assertEquals("Prueba",$post->getSubject());
      $this->assertEquals("Esto es una prueba",$post->getBody());
    }
}
