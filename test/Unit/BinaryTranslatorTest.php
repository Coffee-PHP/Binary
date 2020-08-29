<?php

/**
 * BinaryTranslatorTest.php
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
 * @since 2020-08-01
 */

declare (strict_types=1);

namespace CoffeePhp\Binary\Test\Unit;


use CoffeePhp\Binary\BinaryTranslator;
use PHPUnit\Framework\TestCase;
use stdClass;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;
use function serialize;

/**
 * Class BinaryTranslatorTest
 * @package coffeephp\binary
 * @since 2020-08-01
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @see BinaryTranslator
 */
final class BinaryTranslatorTest extends TestCase
{
    /**
     * @see BinaryTranslator::serializeArray()
     * @see BinaryTranslator::unserializeArray()
     */
    public function testSerializeAndUnserializeArray(): void
    {
        $array = [
            'a' => 'b',
            'c' => 2,
            'd' => true,
            'e' => null,
            null => 2,
            2 => null
        ];

        $instance = new BinaryTranslator();

        $serialized = $instance->serializeArray($array);

        assertSame(
            serialize($array),
            $serialized
        );

        $unserialized = $instance->unserializeArray($serialized);

        assertSame(
            $array,
            $unserialized
        );
    }

    /**
     * @see BinaryTranslator::serializeObject()
     * @see BinaryTranslator::unserializeObject()
     */
    public function testSerializeAndUnserializeClass(): void
    {
        $class = new stdClass();
        $class->a = 'b';
        $class->c = 2;
        $class->d = true;
        $class->e = null;
        $class->null = 2;

        $instance = new BinaryTranslator();

        $serialized = $instance->serializeObject($class);

        assertSame(
            serialize($class),
            $serialized
        );

        $unserialized = $instance->unserializeObject($serialized);

        assertEquals(
            $class,
            $unserialized
        );
    }
}
