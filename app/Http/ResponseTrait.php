<?php

namespace App\Http;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    /**
     * The current class of resource to respond.
     */
    protected string $resourceItem;

    /**
     * The current class of collection resource to respond.
     */
    protected string $resourceCollection;

    protected function respondWithCustomData($data, $message = null, $status = 200): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
            'message' => $message,
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], $status);
    }

    protected function getTimestampInMilliseconds(): int
    {
        return intdiv((int) now()->format('Uu'), 1000);
    }

    /**
     * Return no content for delete requests.
     */
    protected function respondWithNoContent(): JsonResponse
    {
        return new JsonResponse([
            'data' => null,
            'message' => null,
            'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
        ], Response::HTTP_NO_CONTENT);
    }

    /**
     * Return collection paginate response from the application.
     */
    protected function respondWithCollection(LengthAwarePaginator $collection, $message = null)
    {
        return (new $this->resourceCollection($collection))->additional(
            [
                'message' => $message,
                'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
            ]
        );
    }

    /**
     * Return collection response from the application.
     */
    protected function respondWithList(Collection $collection, $message = null)
    {
        return (new $this->resourceCollection($collection))->additional(
            [
                'message' => $message,
                'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
            ]
        );
    }

    /**
     * Return single item response from the application.
     */
    protected function respondWithItem(Model $item, $message = null)
    {
        return (new $this->resourceItem($item))->additional(
            [
                'message' => $message,
                'meta' => ['timestamp' => $this->getTimestampInMilliseconds()],
            ]
        );
    }
}
