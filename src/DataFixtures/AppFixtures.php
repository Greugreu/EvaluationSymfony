<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Category;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $action = new Category();
        $action->setName("Action");
        $action->setCreatedAt(new \DateTime());
        $manager->persist($action);

        $drama = new Category();
        $drama->setName("Drama");
        $drama->setCreatedAt(new \DateTime());
        $manager->persist($drama);

        $johnWick = new Movie();
        $johnWick->setName("John Wick");
        $johnWick->setYear(2014);
        $johnWick->setCategories($action);
        $johnWick->setCreatedAt(new \DateTime());
        $manager->persist($johnWick);

        $meetJoeBlack = new Movie();
        $meetJoeBlack->setName("Meet Joe Black");
        $meetJoeBlack->setYear(1998);
        $meetJoeBlack->setCategories($drama);
        $meetJoeBlack->setCreatedAt(new \DateTime());
        $manager->persist($meetJoeBlack);

        $keanue = new Actor();
        $keanue->setName("Keanue Reeves");
        $keanue->setCreatedAt(new \DateTime());
        $keanue->addMovie($johnWick);
        $manager->persist($keanue);


        $hopkins = new Actor();
        $hopkins->setName("Anthony Hopkins");
        $hopkins->setCreatedAt(new \DateTime());
        $hopkins->addMovie($meetJoeBlack);
        $manager->persist($hopkins);

        $manager->flush();
    }
}
