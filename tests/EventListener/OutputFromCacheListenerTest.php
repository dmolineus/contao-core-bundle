<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Test\EventListener;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\CoreBundle\EventListener\OutputFromCacheListener;
use Contao\CoreBundle\Test\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Contao\CoreBundle\Framework\ContaoFramework;

/**
 * Tests the OutputFromCacheListener class.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class OutputFromCacheListenerTest extends TestCase
{
    /**
     * @var ContaoFramework|\PHPUnit_Framework_MockObject_MockObject
     */
    private $framework;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->framework = $this
            ->getMockBuilder('Contao\CoreBundle\Framework\ContaoFramework')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $frontendAdapter = $this
            ->getMockBuilder('Contao\CoreBundle\Framework\Adapter')
            ->setMethods(['getResponseFromCache'])
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $frontendAdapter
            ->expects($this->any())
            ->method('getResponseFromCache')
            ->willReturn(new Response())
        ;

        $this->framework
            ->expects($this->any())
            ->method('getAdapter')
            ->willReturn($frontendAdapter)
        ;
    }

    /**
     * Tests the object instantiation.
     */
    public function testInstantiation()
    {
        $listener = new OutputFromCacheListener($this->framework);

        $this->assertInstanceOf('Contao\CoreBundle\EventListener\OutputFromCacheListener', $listener);
    }

    /**
     * Tests adding a response to the event.
     */
    public function testFrontendScope()
    {
        /** @var HttpKernelInterface $kernel */
        $kernel = $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', ['test', false]);

        $request = new Request();
        $request->attributes->set('_route', 'dummy');
        $request->attributes->set('_scope', ContaoCoreBundle::SCOPE_FRONTEND);

        $event = new GetResponseEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST);

        $listener = new OutputFromCacheListener($this->framework);
        $listener->setContainer($this->mockContainerWithContaoScopes(ContaoCoreBundle::SCOPE_FRONTEND));
        $listener->onKernelRequest($event);

        $this->assertTrue($event->hasResponse());
    }

    /**
     * Tests that there is no repsonse if the scope is not "frontend".
     */
    public function testInvalidScope()
    {
        /** @var HttpKernelInterface $kernel */
        $kernel = $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', ['test', false]);

        $request = new Request();
        $request->attributes->set('_route', 'dummy');
        $request->attributes->set('_scope', 'invalid');

        $event = new GetResponseEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST);

        $listener = new OutputFromCacheListener($this->framework);
        $listener->setContainer($this->mockContainerWithContaoScopes(ContaoCoreBundle::SCOPE_BACKEND));
        $listener->onKernelRequest($event);

        $this->assertFalse($event->hasResponse());
    }

    /**
     * Tests that there is no repsonse if there is no container.
     */
    public function testWithoutContainer()
    {
        /** @var HttpKernelInterface $kernel */
        $kernel = $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', ['test', false]);

        $request = new Request();
        $request->attributes->set('_route', 'dummy');
        $request->attributes->set('_scope', ContaoCoreBundle::SCOPE_FRONTEND);

        $event = new GetResponseEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST);

        $listener = new OutputFromCacheListener($this->framework);
        $listener->onKernelRequest($event);

        $this->assertFalse($event->hasResponse());
    }
}
