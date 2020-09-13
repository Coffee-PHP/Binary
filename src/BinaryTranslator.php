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

use function get_class;
use function is_array;
use function is_object;
use function is_string;
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
            $serialized = serialize($array);
            if (!is_string($serialized)) {
                throw new BinarySerializeException(
                    'Data returned from array is not a binary string.'
                );
            }
            return $serialized;
        } catch (BinarySerializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new BinarySerializeException(
                "Failed to serialize data: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeArray(string $string): array
    {
        try {
            /** @noinspection UnserializeExploitsInspection */
            $unserialized = unserialize($string);
            if (!is_array($unserialized)) {
                throw new BinaryUnserializeException(
                    "Data returned from binary string is not an array ; String: $string"
                );
            }
            return $unserialized;
        } catch (BinaryUnserializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new BinaryUnserializeException(
                "Failed to unserialize string: $string ; Error: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function serializeObject(object $class): string
    {
        try {
            $serialized = serialize($class);
            if (!is_string($serialized)) {
                $className = get_class($class);
                throw new BinarySerializeException(
                    "Data returned from class is not a binary string: $className"
                );
            }
            return $serialized;
        } catch (BinarySerializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            $className = get_class($class);
            throw new BinarySerializeException(
                "Failed to serialize class: $className ; Error: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function unserializeObject(string $string): object
    {
        try {
            /** @noinspection UnserializeExploitsInspection */
            $unserialized = unserialize($string);
            if (!is_object($unserialized)) {
                throw new BinaryUnserializeException(
                    "Data returned from binary string failed to unserialize into an object: $string"
                );
            }
            return $unserialized;
        } catch (BinaryUnserializeException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new BinaryUnserializeException(
                "Failed to unserialize string: $string ; Error: {$e->getMessage()}",
                $e->getCode(),
                $e
            );
        }
    }
}
