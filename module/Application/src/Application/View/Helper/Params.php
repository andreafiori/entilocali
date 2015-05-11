<?php

namespace Application\View\Helper;

use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface;
use Zend\View\Helper\AbstractHelper;

/**
 * This helper allows to use route, post and get from view
 * 
 * @author Andrea Fiori
 * @since  10 December 2014
 */
class Params extends AbstractHelper
{
    /**
     * @var RequestInterface 
     */
    protected $request;
    
    /**
     * @var MvcEvent
     */
    protected $event;
    
    /**
     * @param RequestInterface $request
     * @param MvcEvent $event
     */
    public function __construct(RequestInterface $request, MvcEvent $event)
    {
        $this->request = $request;
        $this->event = $event;
    }

    /**
     * @param mixed|null $param
     * @param mixed|null
     * @return mixed
     */
    public function fromPost($param = null, $default = null)
    {
        if ($param === null) {
            return $this->request->getPost($param, $default)->toArray();
        }

        return $this->request->getPost($param, $default);
    }

    /**
     * @param string $param
     * @param null $default
     * @return mixed
     */
    public function fromQuery($param = null, $default = null)
    {
        if ($param === null) {
            return $this->request->getQuery($param, $default)->toArray();
        }

        return $this->request->getPost($param, $default);
    }

    /**
     * @param null $param
     * @param null $default
     * @return array|mixed|null
     */
    public function fromRoute($param = null, $default = null)
    {
        if ($param === null) {
            return $this->event->getRouteMatch()->getParams();
        }

        return $this->event->getRouteMatch()->getParam($param, $default);
    }
}
