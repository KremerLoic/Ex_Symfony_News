<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 10/06/18
 * Time: 23:09
 */

namespace App\Services;


use App\Entity\Author;
use App\Entity\Category;
use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 5 ; $i++){
            $author = new Author();
            $author->setName('Name'.$i);
            $author->setFirstname('Firstname'.$i);
            $author->setDateOfBirth('21/04/1993');
            $author->setBiography('Biography_'.$i);
            $manager->persist($author);

            $news = new News();
            $news->setTitle('Title'.$i);
            $news->setContent('Contenu'.$i);
            $news->setPublicationDate('21/04/1993');
            $news->setImageUrl('http://via.placeholder.com/350x150');
            $manager->persist($news);

            $category = new Category();
            $category->setName('Category'.$i);
            $manager->persist($category);

        }
        $manager->flush();

    }

}