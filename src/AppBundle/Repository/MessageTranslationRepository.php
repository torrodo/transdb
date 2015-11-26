<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MessageTranslationRepository extends EntityRepository
{
    /**
     * Get all translations by domain and language code.
     *
     * @param int $domainId
     * @param int $langId
     *
     * @return array
     */
    public function getTranslations($domainId, $langId)
    {
        $transColl =
            $this->createQueryBuilder('m')
                ->select('mt.messageKeyId, mt.messageText')
                ->from('AppBundle:MessageTranslation', 'mt')
                ->where('mt.messageDomainId = :domain')
                ->andWhere('mt.messageLanguageId = :lang')
                ->setParameter('domain', $domainId)
                ->setParameter('lang', $langId)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $trans = [];
        foreach ($transColl as $item) {
            $trans[$item['messageKeyId']] = $item['messageText'];
        }

        return $trans;
    }
}
