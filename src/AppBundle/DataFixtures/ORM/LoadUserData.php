<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
{
    /**
    * @var ContainerInterface
    */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('lacky')
            ->setEmail("frederic.pernin@epitech.eu")
            ->setEnabled(1)
            ->setAddress('8 place Jean-Giraudoux, Créteil')
            ->setPhone('0650881534')
            ->setSurname('frédéric')
            ->setName('pernin')
            ->setWebsite('https://fr.linkedin.com/')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user1, 'appartoo'));

        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('humanshade')
            ->setEmail("humanshade@hotmail.fr")
            ->setEnabled(1)
            ->setAddress('32 Rue Arago, Saint-Maur-des-Fossés')
            ->setPhone('0650881234')
            ->setSurname('yvan')
            ->setName('bertimon')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user2, 'appartoo'));

        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('jojobernard')
            ->setEmail("jojo.bernard@gmail.com")
            ->setEnabled(1)
            ->setAddress('23 Rue de Dunkerque, Paris')
            ->setPhone('0650111534')
            ->setSurname('Joelle')
            ->setName('Bernardo')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user3, 'appartoo'));

        $manager->persist($user3);

        $user4 = new User();
        $user4->setUsername('freddy')
            ->setEmail("freddy.errasmuti@gmail.com")
            ->setEnabled(1)
            ->setAddress('228 Rue du Faubourg Saint-Martin, Paris')
            ->setPhone('0650881590')
            ->setSurname('freddy')
            ->setName('errasmuti')
            ->setWebsite('https://www.twitter.com/')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user4, 'appartoo'));

        $manager->persist($user4);

        $user5 = new User();
        $user5->setUsername('lafouin')
            ->setEmail("fuier@gmail.com")
            ->setEnabled(1)
            ->setAddress('14 Rue des Lyonnais, Paris')
            ->setPhone('0755181034')
            ->setSurname('bob')
            ->setName('dalin')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user5, 'appartoo'));

        $manager->persist($user5);

        $user6 = new User();
        $user6->setUsername('lacourette')
            ->setEmail("lac.rouette@gmail.com")
            ->setEnabled(1)
            ->setAddress('98 Rue Victor Hugo, Ivry-sur-Seine')
            ->setPhone('0650886984')
            ->setSurname('loic')
            ->setName('latonade')
            ->setWebsite('https://www.facebook.com/')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user6, 'appartoo'));

        $manager->persist($user6);

        $user7 = new User();
        $user7->setUsername('jouane')
            ->setEmail("boomba@gmail.com")
            ->setEnabled(1)
            ->setAddress('97 Avenue de France, Paris')
            ->setPhone('0650822224')
            ->setSurname('laetitia')
            ->setName('perrez')
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($user7, 'appartoo'));

        $manager->persist($user7);





        $manager->flush();
        $this->addReference('user1',$user1);
        $this->addReference('user2',$user2);
        $this->addReference('user3',$user3);
        $this->addReference('user4',$user4);
        $this->addReference('user5',$user5);
        $this->addReference('user6',$user6);
        $this->addReference('user7',$user7);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 7;
    }
}