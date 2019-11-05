<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Créer 6 articles
        for ($i = 1; $i < 7; $i++) {
            $article = new Article();
            $article->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit '.$i);
            $article->setContent("On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' vous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voire des phrases embarassantes).");
            $article->setPublishedAt(new \DateTime());
            $article->setImageUrl("http://127.0.0.1:8000/assets/img/voiture{$i}.jpg");
            $manager->persist($article);
        }

        // Créer 1 admin
        for ($i = 0; $i < 1; $i++) {
            $user = new User();
            $user->setEmail('admin@dawan.fr');
            $user->setRoles(array('ROLE_ADMIN'));
            $password = $this->encoder->encodePassword($user, '12345');
            $user->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
