<?php

namespace Phpactor\Extension\CodeTransform\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Phpactor\CodeTransform\CodeTransform;
use Phpactor\CodeTransform\Domain\Generators;
use Phpactor\Container\Container;
use Phpactor\Container\PhpactorContainer;
use Phpactor\Extension\ClassToFile\ClassToFileExtension;
use Phpactor\Extension\CodeTransform\CodeTransformExtension;
use Phpactor\Extension\ComposerAutoloader\ComposerAutoloaderExtension;
use Phpactor\Extension\Logger\LoggingExtension;
use Phpactor\Extension\Php\PhpExtension;
use Phpactor\Extension\Rpc\Handler;
use Phpactor\Extension\Rpc\RpcExtension;
use Phpactor\Extension\WorseReflection\WorseReflectionExtension;
use Phpactor\FilePathResolverExtension\FilePathResolverExtension;

class CodeTransformExtensionTest extends TestCase
{
    public function testLoadServices()
    {
        $container = $this->createContainer();

        foreach ($container->getServiceIds() as $serviceId) {
            $service = $container->get($serviceId);
            self::assertNotNull($service);
        }
    }

    private function createContainer(): Container
    {
        $container = PhpactorContainer::fromExtensions([
            CodeTransformExtension::class,
            ClassToFileExtension::class,
            ComposerAutoloaderExtension::class,
            FilePathResolverExtension::class,
            LoggingExtension::class,
            PhpExtension::class,
            WorseReflectionExtension::class,
        ], [
            CodeTransformExtension::PARAM_TEMPLATE_PATHS => [],
            FilePathResolverExtension::PARAM_APPLICATION_ROOT => __DIR__,
        ]);

        return $container;
    }
}
