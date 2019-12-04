<?php

namespace Demo\Bundle\MockDataIntegrationBundle\EventListener;

use Demo\Bundle\MockDataIntegrationBundle\Channel\MockDataChannel;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Oro\Bundle\CatalogBundle\Entity\Category;
use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Oro\Bundle\IntegrationBundle\Manager\SyncScheduler;

class CategoryChangeListener
{
    /** @var Category[] */
    protected $entities = [];

    /** @var SyncScheduler */
    private $syncScheduler;

    /** @var DoctrineHelper */
    private $doctrineHelper;

    /**
     * @param SyncScheduler $syncScheduler
     * @param DoctrineHelper $doctrineHelper
     */
    public function __construct(SyncScheduler $syncScheduler, DoctrineHelper $doctrineHelper)
    {
        $this->syncScheduler = $syncScheduler;
        $this->doctrineHelper = $doctrineHelper;
    }

    /**
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args)
    {
        $channels = $this->getEnabledChannels();
        foreach ($this->entities as $entity) {
            foreach ($channels as $channel) {
                if (!$this->isTwoWaySyncEnabled($channel)) {
                    continue;
                }

                $this->syncScheduler->schedule($channel->getId(), 'category', [
                    'id' => $entity->getId()
                ]);
            }

            unset($this->entities[$entity->getId()]);
        }
    }

    /**
     * @param OnFlushEventArgs $args
     */
    public function onFlush(OnFlushEventArgs $args)
    {
        $uow = $args->getEntityManager()->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Category) {
                $this->entities[$entity->getId()] = $entity;
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Category) {
                $this->entities[$entity->getId()] = $entity;
            }
        }
    }

    /**
     * @param Channel $channel
     *
     * @return mixed
     */
    private function isTwoWaySyncEnabled(Channel $channel)
    {
        return $channel->getSynchronizationSettings()->offsetGetOr('isTwoWaySyncEnabled', false);
    }

    /**
     * @return Channel[]
     */
    private function getEnabledChannels()
    {
        return $this->doctrineHelper
            ->getEntityRepository(Channel::class)
            ->findBy(['type' => MockDataChannel::TYPE, 'enabled' => true]);
    }
}
