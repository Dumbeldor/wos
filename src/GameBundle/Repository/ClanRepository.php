<?php

namespace GameBundle\Repository;

/**
 * ClanRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClanRepository extends \Doctrine\ORM\EntityRepository
{
    public function getList() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT PARTIAL c.{id, name, point, xp} FROM GameBundle:Clan c
                 ORDER BY c.point')
            ->getResult();
    }

    public function getName($id) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT PARTIAL c.{id, name} FROM GameBundle:Clan c
                 WHERE c.id = :id'
            )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function getClan($id) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT PARTIAL c.{id, name, texte, point, xp}, u, PARTIAL us.{id, username}, r, PARTIAL can.{id, texte, user}, PARTIAL a.{id, name} FROM GameBundle:Clan c
                 JOIN c.users u
                 JOIN u.user us
                 JOIN u.rank r
                 LEFT JOIN c.ally a
                 LEFT JOIN c.candidatures can
                 JOIN can.user canUser
                 WHERE c.id = :id
                 '
            )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function getClanInfoForUser($id, $user) {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT PARTIAL c.{id, name, texte, point, xp}, u, PARTIAL us.{id, username}, PARTIAL ca.{id, texte}  FROM GameBundle:Clan c
                 JOIN c.users u
                 JOIN u.user us
                 LEFT JOIN c.candidatures ca WITH ca.user = :user
                 WHERE c.id = :id
                 '
            )
            ->setParameter('id', $id)
            ->setParameter('user', $user)
            ->getOneOrNullResult();
    }

}
