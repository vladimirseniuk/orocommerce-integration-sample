<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Iterator;

use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\AbstractRestIterator as BaseAbstractRestIterator;
use Oro\Bundle\IntegrationBundle\Provider\Rest\Client\RestClientInterface;

/**
 * Abstract class that helps to load data from the Mock Data API.
 */
abstract class AbstractRestIterator extends BaseAbstractRestIterator
{
    private const PAGE_LIMIT = 200;

    /** @var int */
    private $page = 1;

    /**
     * @return string
     */
    abstract protected function getResource();

    /**
     * {@inheritdoc}
     */
    protected function loadPage(RestClientInterface $client)
    {
        $result = $client->getJSON($this->getResource(), $this->getHeaders());

        $this->page++;

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    protected function getTotalCountFromPageData(array $data, $previousValue)
    {
        return null;
    }

    /**
     * @return array
     */
    protected function getHeaders()
    {
        return ['_page' => $this->page, '_limit' => self::PAGE_LIMIT];
    }
}
