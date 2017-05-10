<?php 

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;


class CorstEventListerner
{
    private $cors;
    private $logger;
    private $container;


    public function __construct($cors,$container) 
    {
        $this->cors = $cors;
        $this->logger = $container->get('logger');
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->logger->info('Evento que intercepta  orequest');
        if (!$event->isMasterRequest()) {
            return;
        }
        $request = $event->getRequest();
        
        $method  = $request->getRealMethod();
        if ('OPTIONS' == $method && (isset($this->cors['allowed_origin']) && !empty($this->cors['allowed_origin']))) {
            $response = new Response();
            $response->headers->set('Access-Control-Allow-Origin', $this->cors['allowed_origin']);
            $response->setStatusCode(Response::HTTP_OK);
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
               return;
        }

        if (isset($this->cors['allowed_origin']) && !empty($this->cors['allowed_origin'])) {
            $response = $event->getResponse();
            $response->headers->set('Access-Control-Allow-Origin', $this->cors['allowed_origin']);
             $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, OPTIONS');

            if (isset($this->cors['allowed_headers']) && ! empty($this->cors['allowed_headers'])) {
                $response->headers->set('Access-Control-Allow-Headers', implode(',', $this->cors['allowed_headers']));
            }
        }
    }
}