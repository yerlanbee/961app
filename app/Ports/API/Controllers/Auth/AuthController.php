<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Domains\Auth\Handlers\RegisterHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Auth\RegisterRequest;
use App\Domains\Auth\Handlers\LoginHandler;
use App\Ports\API\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: "/api/v1/auth/register",
        summary: "User Register",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['first_name', 'last_name', 'password', 'password_confirmation', 'phone'],
                properties: [
                    new OA\Property(
                        property: 'phone',
                        description: 'User phone number',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'password',
                        description: 'Password',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'password_confirmation',
                        description: 'Confirm Password',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'first_name',
                        description: 'Name',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'last_name',
                        description: 'Last name',
                        type: 'string'
                    )
                ]
            )
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "user" => [
                                "first_name" => "Vasya",
                                "last_name" => "Pupkin",
                                "phone" => "77076753444",
                                "id" => 3,
                            ],
                            "token" => "2|bWbibKB1dgaTF5BCHi8YAPfiTqpU8bQyC34GB9D8d4f2221a",
                        ],
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param RegisterRequest $request
     * @param RegisterHandler $handler
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterHandler $handler): JsonResponse
    {
        return $this->response(
            message: self::SUCCESS,
            data: $handler->handle($request->toDto())
        );
    }


    #[OA\Post(
        path: "/api/v1/auth/login",
        summary: "Login",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['phone', 'password'],
                properties: [
                    new OA\Property(
                        property: 'phone',
                        description: 'User phone number',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'password',
                        description: 'Password',
                        type: 'string'
                    ),
                ]
            )
        ),
        tags: ['Auth'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "user" => [
                                "first_name" => "Vasya",
                                "last_name" => "Pupkin",
                                "phone" => "77076753444",
                                "id" => 3,
                            ],
                            "token" => "2|bWbibKB1dgaTF5BCHi8YAPfiTqpU8bQyC34GB9D8d4f2221a",
                        ],
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param LoginRequest $request
     * @param LoginHandler $handler
     * @return JsonResponse
     */
    public function login(LoginRequest $request, LoginHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }
}
