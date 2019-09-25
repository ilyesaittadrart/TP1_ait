<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        for($i = 1; $i <= 20; $i++) {
            $article = new Article();

            $libelle = $faker->sentence();
            $image = $faker->imageUrl(1000,350);
            $description = $faker->paragraph(2);
            
            $article->setLibelle($libelle)
                    ->setImage($image)
                    ->setDescription($description)
                    ->setPrix(mt_rand(40,200));

            $manager->persist($article);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
