<?php

declare(strict_types=1);

namespace Modules\Product\Http\Exceptions;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Throwable;

class FailedToUploadImagesException extends Exception
{
    protected Throwable $originalException;

    public function __construct(string $message, Throwable $exception)
    {
        parent::__construct($message);
        $this->originalException = $exception;
    }

    public function report(): bool
    {
        return $this->originalException instanceof QueryException;
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Failed to upload product images. Try again or contact us.'
        ], 500);
    }
}