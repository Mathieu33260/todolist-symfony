<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class FilterService
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
    public function getFilter() {
        $filter = $this->request->get('filter');
        return $filter;
    }
}