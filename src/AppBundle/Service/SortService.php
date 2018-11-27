<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class SortService
{
    /**
     * @var Request $request
     */
    private $request;

    public function __construct(RequestStack $request)
    {
        $this->request = $request->getMasterRequest();
    }

    /**
     * @return string
     */
    public function getSort() {
        $sort = $this->request->get('sort');
        return $sort;
    }
}