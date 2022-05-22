<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Config\Definition\Exception\Exception;

use App\Service\AuthorService;

class AuthorTest extends KernelTestCase
{
  public function testGetAuthor():void
  {
    $kernel = self::bootKernel();
    $container = static::getContainer();
    $author_service = $container->get(AuthorService::class);
    $author = $author_service->findByName("UserTest");
    $this->assertEquals("UserTest",$author->getName());
  }
}
