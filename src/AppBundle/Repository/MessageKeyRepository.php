<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageKeyRepository extends EntityRepository
{
    /**
     * Get all keys in [key_id] => [key_name] format.
     *
     * @return array
     */
    public function getKeys()
    {
        $keysColl =
            $this->createQueryBuilder('mk')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $keys = [];
        foreach ($keysColl as $item) {
            $keys[$item['id']] = $item['name'];
        }

        return $keys;
    }
}
