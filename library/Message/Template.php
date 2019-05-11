<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

final class Template
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $id;

    public function __construct(string $message, string $id = 'standard')
    {
        $this->message = $message;
        $this->id = $id;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
