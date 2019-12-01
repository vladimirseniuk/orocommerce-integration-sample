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
    /** @var ParameterBag */
    private $settingsBag;

    /**
     * {@inheritdoc}
     */
    public function getSettingsBag()
    {
        if (null === $this->settingsBag) {
            $this->settingsBag = new ParameterBag();
        }

        return $this->settingsBag;
    }
}
