<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setName("Bale");
        $manager->persist($actor);
        
        $actor2 = new Actor();
        $actor2->setName("Baleson");
        $manager->persist($actor2);

        $actor3 = new Actor();
        $actor3->setName("Balenois");
        $manager->persist($actor3);

        $actor4 = new Actor();
        $actor4->setName("Baleaus");
        $manager->persist($actor4);

        $manager->flush();

    }
}
