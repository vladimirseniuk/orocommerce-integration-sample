<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Iterator;

/**
 * Load Product data from the Mock Data API.
 */
class ProductRestIterator extends AbstractRestIterator
{
    /**
     * {@inheritdoc}
     */
    protected function getRowsFromPageData(array $data)
    {
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'sku' => $item['sku'],
                'names.default.value' => $item['name'],
                'inventory_status.id' => $item['inventory_status'],
                'featured' => (int) $item['is_featured'],
                'status' => $item['status'],
                'category.default.title' => $item['category']['title'],
                'type' => 'simple',
                'attributeFamily.code' => 'default_family',
                'primaryUnitPrecision.unit.code' => 'each',
                'primaryUnitPrecision.precision' => 0
            ];
        }

        return $rows;
    }

    /**
     * {@inheritdoc}s
     */
    protected function getResource()
    {
        return 'products';
    }

    /**
     * @return array
     */
    protected function getHeaders()
    {
        $headers = parent::getHeaders();
        $headers['_expand'] = 'category';

        return $headers;
    }
}
