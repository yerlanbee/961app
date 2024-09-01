<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Recource\Technologies\CreateTechnologyHandler;
use App\Domains\Buildings\Handlers\Recource\Technologies\DeleteTechnologyHandler;
use App\Domains\Buildings\Handlers\Recource\Technologies\GetAllTechnologyHandler;
use App\Domains\Buildings\Handlers\Recource\Technologies\UpdateTechnologyHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Technologies\CreateTechnologyRequest;
use App\Ports\API\Requests\Buildings\Technologies\UpdateTechnologyRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class TechnologyController extends Controller
{
    #[OA\Get(
        path: "/api/v1/technology",
        summary: "Get all",
        tags: ['Technology'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            [
                                "id" => 1,
                                "title" => "Единый ключ доступа",
                                "description" => "",
                                "photo" => null,
                                "created_at" => null,
                                "updated_at" => null,
                            ]
                        ],
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param GetAllTechnologyHandler $handler
     * @return JsonResponse
     */
    public function index(GetAllTechnologyHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/technology/{id}",
        summary: "Retrieve Technology by Id",
        tags: ['Technology'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Technology id",
                in: "path",
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "title" => "Camera",
                            "description" => null,
                            "photo" => "technologies/pnGQWDxHsR15YMBPcfas6mYPFquZZkEGOiRNnw1O.jpg",
                            "updated_at" => "2024-09-01T06:20:03.000000Z",
                            "created_at" => "2024-09-01T06:20:03.000000Z",
                            "id" => 10,
                        ]
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param int $id
     * @param GetAllTechnologyHandler $handler
     * @return JsonResponse
     */
    public function show(int $id, GetAllTechnologyHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($id)
        );
    }

    #[OA\Post(
        path: "/api/v1/technology",
        summary: "Create Technology",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    'title','description'
                ],
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'photo',
                        description: 'Upload file',
                        type: 'string'
                    ),
                ]
            )
        ),
        tags: ['Technology'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "title" => "Camera",
                            "description" => null,
                            "photo" => "technologies/pnGQWDxHsR15YMBPcfas6mYPFquZZkEGOiRNnw1O.jpg",
                            "updated_at" => "2024-09-01T06:20:03.000000Z",
                            "created_at" => "2024-09-01T06:20:03.000000Z",
                            "id" => 10,
                        ]
                    ]
                )),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param CreateTechnologyRequest $request
     * @param CreateTechnologyHandler $handler
     * @return JsonResponse
     */
    public function store(CreateTechnologyRequest $request, CreateTechnologyHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Put(
        path: "/api/v1/technology/{id}",
        summary: "Update Technology",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    'title','description'
                ],
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'photo',
                        description: 'Upload file',
                        type: 'string'
                    ),
                ]
            )
        ),
        tags: ['Technology'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Technology id",
                in: "path",
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_NO_CONTENT,
                description: "Successfully",
            ),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param int $id
     * @param UpdateTechnologyRequest $request
     * @param UpdateTechnologyHandler $handler
     * @return JsonResponse
     */
    public function update(int $id, UpdateTechnologyRequest $request, UpdateTechnologyHandler $handler): JsonResponse
    {
        $handler->handle($request->toDto());

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/technology/{id}",
        summary: "Delete Technology by Id",
        tags: ['Technology'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Technology id",
                in: "path",
                required: true,
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_NO_CONTENT,
                description: "Successfully",
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param int $id
     * @param DeleteTechnologyHandler $handler
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteTechnologyHandler $handler): JsonResponse
    {
        $handler->handle($id);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
