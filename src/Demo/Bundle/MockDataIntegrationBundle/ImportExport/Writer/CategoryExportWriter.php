<?php

namespace Demo\Bundle\MockDataIntegrationBundle\ImportExport\Writer;

use Akeneo\Bundle\BatchBundle\Entity\StepExecution;
use Akeneo\Bundle\BatchBundle\Item\ItemWriterInterface;
use Akeneo\Bundle\BatchBundle\Step\StepExecutionAwareInterface;
use Demo\Bundle\MockDataIntegrationBundle\Transport\MockDataTransport;
use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\ImportExportBundle\Context\ContextAwareInterface;
use Oro\Bundle\ImportExportBundle\Context\ContextInterface;
use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\IntegrationBundle\Entity\Channel;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class CategoryExportWriter implements
    ItemWriterInterface,
    StepExecutionAwareInterface,
    ContextAwareInterface,
    LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var ContextRegistry */
    private $contextRegistry;

    /** @var ContextInterface */
    private $context;

    /** @var DoctrineHelper */
    private $doctrineHelper;

    /** @var MockDataTransport */
    private $transport;

    /**
     * @param ContextRegistry $contextRegistry
     */
    public function setContextRegistry(ContextRegistry $contextRegistry)
    {
        $this->contextRegistry = $contextRegistry;
    }

    /**
     * @param DoctrineHelper $doctrineHelper
     */
    public function setDoctrineHelper(DoctrineHelper $doctrineHelper)
    {
        $this->doctrineHelper = $doctrineHelper;
    }

    /**
     * @param MockDataTransport $transport
     */
    public function setTransport(MockDataTransport $transport)
    {
        $this->transport = $transport;
    }

    /**
     * {@inheritdoc}
     */
    public function write(array $items)
    {
        $channelId = $this->context->getOption('channel');
        $channel = $this->getChannel($channelId);

        $this->transport->init($channel->getTransport());
        foreach ($this->getRowsFromData($items) as $row) {
            $this->transport->getClient()->put('categories/' . $row['id'], $row, [
                'Content-Type' => 'application/json'
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setStepExecution(StepExecution $stepExecution)
    {
        $this->setImportExportContext($this->contextRegistry->getByStepExecution($stepExecution));
    }

    /**
     * {@inheritdoc}
     */
    public function setImportExportContext(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * {@inheritdoc}
     */
    private function getRowsFromData(array $data)
    {
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'id' => $item['mockDataId'],
                'title' => $item['titles.default.value']
            ];
        }

        return $rows;
    }

    /**
     * @param int $channelId
     *
     * @return Channel
     */
    private function getChannel($channelId)
    {
        return $this->doctrineHelper
            ->getEntityRepository(Channel::class)
            ->find($channelId);
    }
}
