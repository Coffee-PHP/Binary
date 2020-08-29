<?php

/**
 * BinaryComponentRegistrar.php
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

declare(strict_types=1);

namespace CoffeePhp\Binary\Integration;


use CoffeePhp\Binary\BinaryTranslator;
use CoffeePhp\Binary\Contract\BinaryTranslatorInterface;
use CoffeePhp\ComponentRegistry\Contract\ComponentRegistrarInterface;
use CoffeePhp\Di\Contract\ContainerInterface;
use CoffeePhp\Edi\Contract\EdiArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiExtendedArrayTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiObjectTranslatorInterface;
use CoffeePhp\Edi\Contract\EdiTranslatorInterface;
use CoffeePhp\Serialize\Contract\SerializerInterface;
use CoffeePhp\Unserialize\Contract\UnserializerInterface;

/**
 * Class BinaryComponentRegistrar
 * @package coffeephp\binary
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2020-08-29
 */
final class BinaryComponentRegistrar implements ComponentRegistrarInterface
{

    /**
     * @inheritDoc
     */
    public function register(ContainerInterface $di): void
    {
        $di->bind(SerializerInterface::class, BinaryTranslatorInterface::class);
        $di->bind(UnserializerInterface::class, BinaryTranslatorInterface::class);

        $di->bind(EdiArrayTranslatorInterface::class, BinaryTranslatorInterface::class);
        $di->bind(EdiExtendedArrayTranslatorInterface::class, BinaryTranslatorInterface::class);
        $di->bind(EdiObjectTranslatorInterface::class, BinaryTranslatorInterface::class);
        $di->bind(EdiTranslatorInterface::class, BinaryTranslatorInterface::class);

        $di->bind(BinaryTranslatorInterface::class, BinaryTranslator::class);
        $di->bind(BinaryTranslator::class, BinaryTranslator::class);
    }
}
