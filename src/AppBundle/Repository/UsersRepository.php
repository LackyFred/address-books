<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    public function byUser($keyword)
    {
        $q = $this->createQueryBuilder('u')
                ->select('u.username,u.id')
                ->where("u.username LIKE :username")
                ->orderBy('u.id')
                ->setParameter('username',$keyword.'%');

        return $q->getQuery()->getResult();
    }

    public function byUserContact($keyword)
    {
        $q = $this->createQueryBuilder('u')
            ->select('u.username, u.id')
            ->where("u.username LIKE :username")
            ->orderBy('u.id')
            ->setParameter('username',$keyword.'%');

        return $q->getQuery()->getResult();
    }
}