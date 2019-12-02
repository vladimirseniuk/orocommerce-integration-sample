<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Entity that stores transport specific settings.
 *
 * @ORM\Entity()
 */
class MockDataSettings extends Transport
{
    /**
     * @var string
     *
     * @ORM\Column(name="mock_data_api_url", type="string", length=255, nullable=true)
     */
    private $apiUrl = 'http://localhost:8080';

    /** @var ParameterBag */
    private $settingsBag;

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     *
     * @return MockDataSettings
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSettingsBag()
    {
        if (null === $this->settingsBag) {
            $this->settingsBag = new ParameterBag([
                'api_url' => $this->getApiUrl()
            ]);
        }

        return $this->settingsBag;
    }
}
