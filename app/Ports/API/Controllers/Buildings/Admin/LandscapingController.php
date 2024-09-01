<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Resource\Landscapings\CreateLandscapingHandler;
use App\Domains\Buildings\Handlers\Resource\Landscapings\DeleteLandscapingHandler;
use App\Domains\Buildings\Handlers\Resource\Landscapings\GetAllLandscapingHandler;
use App\Domains\Buildings\Handlers\Resource\Landscapings\UpdateLandscapingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Landscapings\CreateLandscapingRequest;
use App\Ports\API\Requests\Buildings\Landscapings\UpdateLandscapingRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class LandscapingController extends Controller
{
    #[OA\Get(
        path: "/api/v1/landscaping",
        summary: "Get all",
        tags: ['Landscaping'],
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
     * @param GetAllLandscapingHandler $handler
     * @return JsonResponse
     */
    public function index(GetAllLandscapingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/landscaping/{id}",
        summary: "Retrieve Landscaping by Id",
        tags: ['Landscaping'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Landscaping id",
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
                            "title" => "",
                            "description" => null,
                            "photo" => "landscapings/pnGQWDxHsR15YMBPcfas6mYPFquZZkEGOiRNnw1O.jpg",
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
     * @param GetAllLandscapingHandler $handler
     * @return JsonResponse
     */
    public function show(int $id, GetAllLandscapingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($id)
        );
    }

    #[OA\Post(
        path: "/api/v1/landscaping",
        summary: "Create Landscaping",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    'name',
                    'square_from', 'square_to',
                    'number_floors', 'number_apartments', 'number_parking_spaces', 'photo',
                    'relations', 'address_info', 'layout_info', 'price_info'
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
        tags: ['Landscaping'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "title" => "",
                            "description" => null,
                            "photo" => "landscapings/pnGQWDxHsR15YMBPcfas6mYPFquZZkEGOiRNnw1O.jpg",
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
     * @param CreateLandscapingRequest $request
     * @param CreateLandscapingHandler $handler
     * @return JsonResponse
     */
    public function store(CreateLandscapingRequest $request, CreateLandscapingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Put(
        path: "/api/v1/landscaping/{id}",
        summary: "Update Landscaping",
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
        tags: ['Landscaping'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Landscaping id",
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
     * @param UpdateLandscapingRequest $request
     * @param UpdateLandscapingHandler $handler
     * @return JsonResponse
     */
    public function update(int $id, UpdateLandscapingRequest $request, UpdateLandscapingHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);

        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/landscaping/{id}",
        summary: "Delete landscaping by Id",
        tags: ['Landscaping'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Landscaping id",
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
     * @param DeleteLandscapingHandler $handler
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteLandscapingHandler $handler): JsonResponse
    {
        $handler->handle($id);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
