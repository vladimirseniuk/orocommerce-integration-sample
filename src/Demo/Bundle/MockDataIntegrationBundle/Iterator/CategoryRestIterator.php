<?php

namespace Demo\Bundle\MockDataIntegrationBundle\Iterator;

/**
 * Load Category data from the Mock Data API.
 */
class CategoryRestIterator extends AbstractRestIterator
{
    /**
     * {@inheritdoc}
     */
    protected function getRowsFromPageData(array $data)
    {
        $rows = [];
        foreach ($data as $item) {
            $rows[] = [
                'mockDataId' => $item['id'],
                'titles.default.value' => $item['title']
            ];
        }

        return $rows;
    }

    /**
     * {@inheritdoc}s
     */
    protected function getResource()
    {
        return 'categories';
    }
}
