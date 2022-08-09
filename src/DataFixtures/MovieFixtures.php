<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle("The Dark");
        $movie->setReleaseYear(2008);
        $movie->setDescription("The Description");
        $movie->setImagePath("https://prawie.pro/wp-content/uploads/2017/10/76140090_pedaly-spd-pd-m540-czarne-bloki-shimano_712x534_TRS_pad-300x225.png");
        $manager->persist($movie);


        $movie2 = new Movie();
        $movie2->setTitle("The Dark 2");
        $movie2->setReleaseYear(2009);
        $movie2->setDescription("The Description 2");
        $movie2->setImagePath("https://prawie.pro/wp-content/uploads/2017/10/76140090_pedaly-spd-pd-m540-czarne-bloki-shimano_712x534_TRS_pad-300x225.png");
        $manager->persist($movie2);

        $manager->flush();
    }
}
