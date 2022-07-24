<?php

declare(strict_types=1);

namespace Qenary\Tests;

use PHPUnit\Framework\TestCase;
use Qenary\Core\Autoloader;
use Qenary\Core\ConfigManager;
use Qenary\Tests\Autoloader\ConfigManagerStub;

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
