<?php

declare(strict_types=1);

namespace Quenary\Tests;

use PHPUnit\Framework\TestCase;
use Quenary\Core\Autoloader;
use Quenary\Core\ConfigManager;
use Quenary\Tests\Autoloader\ConfigManagerStub;

class AutoloaderTest extends TestCase
{
    private Autoloader    $autoloader;
    private ConfigManager $configManagerMock;

    public function setUp(): void
    {
        $this->autoloader = container('Tests_Autoloader');

        $this->configManagerMock = $this
            ->getMockBuilder(ConfigManagerStub::class)
            ->setMethods(
                [
                    'load',
                    'save'
                ]
            )
            ->getMock();

        container(ConfigManagerStub::class)::injectMock($this->configManagerMock);
    }

    public function testDump()
    {
        $this->configManagerMock
            ->expects($this->once())
            ->method('save')
            ->with(container(ConfigManagerStub::class)->data());

        $this->autoloader->dump();
    }

    public function testLoad()
    {
        self::assertEqualsCanonicalizing(
            container(ConfigManagerStub::class)->data(),
            $this->autoloader->load()
        );
    }
}
