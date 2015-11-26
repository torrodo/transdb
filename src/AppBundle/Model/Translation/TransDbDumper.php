<?php

namespace AppBundle\Model\Translation;

use Symfony\Component\Translation\Dumper\DumperInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\MessageDomain;
use AppBundle\Entity\MessageKey;
use AppBundle\Entity\MessageLanguage;
use AppBundle\Entity\MessageTranslation;

/**
 * Save translations into database after extraction performed.
 */
class TransDbDumper implements DumperInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

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
    public function dump(MessageCatalogue $messages, $options = [])
    {
        try {
            $msgLanguage = $this
                ->entityManager
                ->getRepository('AppBundle:MessageLanguage')
                ->findOneByName($messages->getLocale());

            if (null === $msgLanguage) {
                $msgLanguage = new MessageLanguage();
                $msgLanguage->setName($messages->getLocale());
                $this->entityManager->persist($msgLanguage);
                $this->entityManager->flush();
            }

            foreach ($messages->all() as $domain => $translationData) {
                $msgDomain = $this
                    ->entityManager
                    ->getRepository('AppBundle:MessageDomain')
                    ->findOneByName($domain);

                if (null === $msgDomain) {
                    $msgDomain = new MessageDomain();
                    $msgDomain->setName($domain);
                    $this->entityManager->persist($msgDomain);
                    $this->entityManager->flush();
                }

                foreach ($translationData as $data) {
                    if ('' === $data) {
                        continue;
                    }

                    $msgKey = $this
                        ->entityManager
                        ->getRepository('AppBundle:MessageKey')
                        ->findOneByName($data);

                    if (null === $msgKey) {
                        $msgKey = new MessageKey();
                        $msgKey->setName($data);
                        $this->entityManager->persist($msgKey);
                        $this->entityManager->flush();
                    }

                    $msgTranslation = $this
                        ->entityManager
                        ->getRepository('AppBundle:MessageTranslation')
                        ->findOneBy([
                            'messageDomainId' => $msgDomain->getId(),
                            'messageLanguageId' => $msgLanguage->getId(),
                            'messageKeyId' => $msgKey->getId(),
                        ]);

                    if (null !== $msgTranslation) {
                        continue;
                    }

                    $msgTranslation = new MessageTranslation();
                    $msgTranslation->setMessageDomainId($msgDomain->getId());
                    $msgTranslation->setMessageLanguageId($msgLanguage->getId());
                    $msgTranslation->setMessageKeyId($msgKey->getId());
                    $msgTranslation->setMessageText($data);
                    $this->entityManager->persist($msgTranslation);
                    $this->entityManager->flush();

                    echo sprintf(
                        "%s-%s-%s inserted\n",
                        $msgLanguage->getName(),
                        $msgDomain->getName(),
                        $msgKey->getName()
                    );
                }

                // to trick the JmsTranslationBundle
                $tmpFile = sprintf(
                    '%s%s%s.%s.db',
                    $options['path'],
                    \DIRECTORY_SEPARATOR,
                    $domain,
                    $messages->getLocale()
                );
                file_put_contents($tmpFile, ' ');
            }
        } catch (\Exception $e) {
            echo 'ERROR for inserting translation data: '.$e->getMessage();
        }
    }
}
