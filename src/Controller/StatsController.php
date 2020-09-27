<?php

namespace App\Controller;

use App\Model\Brand;

class StatsController extends AbstractController
{
    protected function getName()
    {
        return 'stats';
    }

    protected function getData()
    {
        $brandModel = new Brand();
        $brands = $brandModel->getStats();
        $title = 'Stats';

        return compact(
            'brands',
            'title'
        );
    }
}
