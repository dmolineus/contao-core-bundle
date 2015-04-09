<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Test\EventListener;

use Contao\CoreBundle\EventListener\AddToSearchIndexListener;
use Contao\CoreBundle\Test\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;

/**
 * Tests the AddToSearchIndexListener class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class AddToSearchIndexListenerTest extends TestCase
{
    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $listener = new AddToSearchIndexListener();

        $this->assertInstanceOf('Contao\\CoreBundle\\EventListener\\AddToSearchIndexListener', $listener);
    }

    /**
     * Tests that the listener does nothing if the Contao framework is not booted.
     */
    public function testWithoutContaoFramework()
    {
        $listener = new AddToSearchIndexListener();
        $event    = $this->mockPostResponseEvent();

        $event
            ->expects($this->never())
            ->method('getResponse')
        ;

        $listener->onKernelTerminate($event);
    }

    /**
     * Tests that the listener does use the response if the Contao framework is booted.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testWithContaoFramework()
    {
        $this->bootContaoFramework();

        $listener = new AddToSearchIndexListener();
        $event    = $this->mockPostResponseEvent();

        $event
            ->expects($this->once())
            ->method('getResponse')
        ;

        $listener->onKernelTerminate($event);
    }

    /**
     * Returns a PostResponseEvent mock object.
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|PostResponseEvent
     */
    private function mockPostResponseEvent()
    {
        $kernel   = $this->getMockForAbstractClass('Symfony\\Component\\HttpKernel\\Kernel', ['test', false]);
        $request  = new Request();
        $response = new Response();

        $event = $this->getMock(
            'Symfony\\Component\\HttpKernel\\Event\\PostResponseEvent',
            ['getResponse'],
            [$kernel, $request, $response]
        );

        return $event;
    }
}