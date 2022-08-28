<?php

namespace App\Http\Response;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Arr;

class HttpResponse extends Facade
{
    private static function format(int $code, string $message = ''): array
    {
        return [
            'responseCode' => $code,
            'responseMessage' => $message
        ];
    }

    // OK define response with status OK
    public static function ok(array $data = []): array
    {
        return Arr::collapse([
            self::format(200, 'Successful'), empty($data) ? [] : ['data' => $data]
        ]);
    }

    // Created define response with status created
    public static function created(array $data = []): array
    {
        return Arr::collapse([
            self::format(201, 'Successful'), empty($data) ? [] : ['data' => $data]
        ]);
    }

    // InvalidArgument define response invalid argument from client
    public static function invalidArgument(array $messages): array
    {
        list($message) = $messages;
        return self::format(400, $message);
    }

    // InternalServerError define response for unknown internal server error
    // Please avoid return this if we can categorize it to more specific such as BadGateway
    public static function internalServerError(string $message = ''): array
    {
        return self::format(500, empty($message) ? 'Internal Server Error' : $message);
    }

    public static function notFound(string $message = '')
    {
        return self::format(404, empty($message) ? 'Not found' : $message);
    }
}
