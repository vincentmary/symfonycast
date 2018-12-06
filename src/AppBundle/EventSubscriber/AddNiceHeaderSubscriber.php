<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 05/12/2018
 * Time: 17:08
 */

namespace AppBundle\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AddNiceHeaderSubscriber implements EventSubscriberInterface
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function onKernelResponse(FilterResponseEvent $event)
    {
        $this->logger->info('Adding a nice loger');
        $event->getResponse()
            ->headers->set('X-NICE-MESSAGE', 'That was a great request');
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }

}