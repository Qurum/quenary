<?php

declare(strict_types=1);

namespace Qenary\Tests;

use PHPUnit\Framework\TestCase;
use Qenary\Core\Dispatcher;
use Qenary\Tests\Dispatcher\DataObjectStub;
use Qenary\Tests\Dispatcher\EventTypes;
use Qenary\Tests\Dispatcher\SomeInterface;
use Qenary\Tests\Dispatcher\SomeService;

class DispatcherTest extends TestCase
{
    private Dispatcher    $dispatcher;
    private SomeService   $service;
    private SomeInterface $mock;

    public function setUp(): void
    {
        $this->dispatcher = container('Tests_Dispatcher');
        $this->service    = container(SomeService::class);
        $this->mock       = $this
            ->getMockBuilder(SomeInterface::class)
            ->setMethods(
                [
                    'redEvent',
                    'barCommand',
                    'greenQuery'
                ]
            )
            ->getMock();

        $this->service::injectMock($this->mock);
    }

    public function testDispatch()
    {
        $this->mock
            ->expects($this->exactly(2))
            ->method('redEvent')
            ->withConsecutive(
                [$this->equalTo(new DataObjectStub('Some event data 1'))],
                [$this->equalTo(new DataObjectStub('Some event data 2'))]
            );

        $this->dispatcher->dispatch(
            EventTypes::RED_EVENT->value,
            json_encode(new DataObjectStub('Some event data 1'))
        );

        $this->dispatcher->dispatch(
            EventTypes::RED_EVENT->value,
            json_encode(new DataObjectStub('Some event data 2'))
        );

        $this->mock
            ->expects($this->exactly(1))
            ->method('greenQuery')->withConsecutive(
                [$this->equalTo(new DataObjectStub('Some query data 1'))]
            );
        $this->mock
            ->expects($this->exactly(3))
            ->method('barCommand')
            ->withConsecutive(
                [$this->equalTo(new DataObjectStub('Some command data 1'))],
                [$this->equalTo(new DataObjectStub('Some command data 2'))],
                [$this->equalTo(new DataObjectStub('Some command data 3'))],
            );

        $this->dispatcher->dispatch(
            EventTypes::BAR_COMMAND->value,
            json_encode(new DataObjectStub('Some command data 1'))
        );
        $this->dispatcher->dispatch(
            EventTypes::BAR_COMMAND->value,
            json_encode(new DataObjectStub('Some command data 2'))
        );
        $this->dispatcher->dispatch(
            EventTypes::GREEN_QUERY->value,
            json_encode(new DataObjectStub('Some query data 1'))
        );
        $this->dispatcher->dispatch(
            EventTypes::BAR_COMMAND->value,
            json_encode(new DataObjectStub('Some command data 3'))
        );
    }
}
