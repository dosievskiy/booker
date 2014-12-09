<?php

namespace Booker\BookBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RoomsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoomsRepository extends EntityRepository
{
    /*
     * return array of all rooms in db.
     */
    public function getRooms()
    {
        $query = $this->createQueryBuilder('r')->select('r');
        
        return  $query->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
    }
}
