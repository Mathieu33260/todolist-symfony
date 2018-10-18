<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FilterService
{
    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * @var Request $request
     */
    private $request;

    public function __construct(RequestStack $request, SessionInterface $session)
    {
        $this->session = $session;
        $this->request = $request->getMasterRequest();
    }

    /**
     * @return string
     */
    public function getFilter() {
        $filter = ($this->request->get('filter')) ? $this->request->get('filter') : $this->session->get('filter');
        return $filter;
    }
}