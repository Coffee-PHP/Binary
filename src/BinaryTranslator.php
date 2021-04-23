<?php

/**
 * BinaryTranslator.php
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
 * @since 2020-08-07
 */

declare(strict_types=1);

namespace CoffeePhp\Binary;

use CoffeePhp\Binary\Contract\BinaryTranslatorInterface;
use CoffeePhp\Binary\Exception\BinarySerializeException;
use CoffeePhp\Binary\Exception\BinaryUnserializeException;
use Throwable;

use function serialize;
use function unserialize;

/**
 * Class BinaryTranslator
 * @package coffeephp\binary
 * @since 2020-08-07
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class BinaryTranslator implements BinaryTranslatorInterface
{
    /**
     * @inheritDoc
     */
    public function serializeArray(array $array): string
    {
        try {
            return serialize($array);
        } catch (Throwable $e) {
            throw new BinarySerializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     * @noinspection UnserializeExploitsInspection
     */
    public function unserializeArray(string $string): array
    {
        try {
            return (array)unserialize($string);
        } catch (Throwable $e) {
            throw new BinaryUnserializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function serializeObject(object $object): string
    {
        try {
            return serialize($object);
        } catch (Throwable $e) {
            throw new BinarySerializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @inheritDoc
     * @noinspection UnserializeExploitsInspection
     */
    public function unserializeObject(string $string): object
    {
        try {
            return (object)unserialize($string);
        } catch (Throwable $e) {
            throw new BinaryUnserializeException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}
