<?php

/**
 * BinaryComponentRegistrarTest.php
 *
 * Copyright 2020 Danny Damsky
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package coffeephp\binary
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2020-08-29
 */

declare (strict_types=1);

namespace CoffeePhp\Binary\Test\Integration;


use CoffeePhp\Binary\BinaryTranslator;
use CoffeePhp\Binary\Contract\BinaryTranslatorInterface;
use CoffeePhp\Binary\Integration\BinaryComponentRegistrar;
use CoffeePhp\ComponentRegistry\ComponentRegistry;
use CoffeePhp\Di\Container;
use CoffeePhp\Di\Contract\ContainerInterface;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

/**
 * Class BinaryComponentRegistrarTest
 * @package coffeephp\binary
 * @since 2020-08-29
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @see BinaryComponentRegistrar
 */
final class BinaryComponentRegistrarTest extends TestCase
{
    private static ContainerInterface $di;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$di = new Container();
        $registry = new ComponentRegistry(self::$di);
        $registry->register(BinaryComponentRegistrar::class);
    }

    /**
     * @see BinaryComponentRegistrar::register()
     */
    public function testRegister(): void
    {
        assertTrue(
            self::$di->has(BinaryTranslatorInterface::class)
        );
        assertTrue(
            self::$di->has(BinaryTranslator::class)
        );
        assertInstanceOf(
            BinaryTranslator::class,
            self::$di->get(BinaryTranslator::class)
        );
        assertSame(
            self::$di->get(BinaryTranslator::class),
            self::$di->get(BinaryTranslatorInterface::class)
        );
    }
}
