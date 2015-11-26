<?php

namespace AppBundle\Model\Translation;

use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Doctrine\ORM\EntityManager;

/**
 * Load translations from database when catalogue is generated.
 */
class TransDbLoader implements LoaderInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritedDoc}.
     */
    public function load($resource, $lang, $domain = 'messages')
    {
        $msgLanguage = $this
            ->entityManager
            ->getRepository('AppBundle:MessageLanguage')
            ->findOneByName($lang);

        $msgDomain = $this
            ->entityManager
            ->getRepository('AppBundle:MessageDomain')
            ->findOneByName($domain);

        $catalogue = new MessageCatalogue($lang);
        if ((null !== $msgLanguage) && (null !== $msgDomain)) {
            $translations = $this
                ->entityManager
                ->getRepository('AppBundle:MessageTranslation')
                ->getTranslations(
                    $msgDomain->getId(),
                    $msgLanguage->getId()
                );

            $keys = $this
                ->entityManager
                ->getRepository('AppBundle:MessageKey')
                ->getKeys();

            foreach ($translations as $id => $item) {
                $catalogue->set($keys[$id], $item, $domain);
            }
        }

        return $catalogue;
    }
}
