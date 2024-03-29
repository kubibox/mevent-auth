<?php

declare(strict_types=1);

namespace App\Shared\Actions;

use JsonSerializable;

class ActionPayload implements JsonSerializable
{
    /**
     * @var int
     */
    private int $statusCode;

    /**
     * @var array|object|null
     */
    private $data;

    /**
     * @var ActionError|null
     */
    private ?ActionError $error;

    /**
     * @param int $statusCode
     * @param $data
     * @param ActionError|null $error
     */
    public function __construct(int $statusCode = 200, $data = null, ?ActionError $error = null) {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->error = $error;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array|null|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return ActionError|null
     */
    public function getError(): ?ActionError
    {
        return $this->error;
    }

    /**
     * @return int[]
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $payload = [
            'statusCode' => $this->statusCode,
        ];

        if ($this->data !== null) {
            $payload['data'] = $this->data;
        } elseif ($this->error !== null) {
            $payload['error'] = $this->error;
        }

        return $payload;
    }
}
