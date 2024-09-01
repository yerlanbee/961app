<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Buildings\CreateBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\DeleteBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\UpdateBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\CreateBuildingRequest;
use App\Ports\API\Requests\Buildings\Buildings\UpdateBuildingRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class BuildingController extends Controller
{
    #[OA\Post(
        path: "/api/v1/building",
        summary: "Create Building",
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
                        property: 'name',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'square_from',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'square_to',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_floors',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_apartments',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_parking_spaces',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'photo',
                        description: 'Upload file',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'relations',
                        properties: [
                            new OA\Property(
                                property: 'technologies',
                                type: 'array',
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: 'title',
                                            type: 'string'
                                        ),
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer'
                                        )
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: 'advantages',
                                type: 'array',
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: 'title',
                                            type: 'string'
                                        ),
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer'
                                        )
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: 'landscapings',
                                type: 'array',
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: 'title',
                                            type: 'string'
                                        ),
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer'
                                        )
                                    ]
                                )
                            ),
                            new OA\Property(
                                property: 'issuances',
                                type: 'array',
                                items: new OA\Items(
                                    properties: [
                                        new OA\Property(
                                            property: 'title',
                                            type: 'string'
                                        ),
                                        new OA\Property(
                                            property: 'id',
                                            type: 'integer'
                                        )
                                    ]
                                )
                            )
                        ],
                        type: 'object'
                    ),
                    new OA\Property(
                        property: 'address_info',
                        properties: [
                            new OA\Property(
                                property: 'address',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'longitude',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'latitude',
                                type: 'string'
                            ),
                        ],
                        type: 'object',
                    ),
                    new OA\Property(
                        property: 'price_info',
                        properties: [
                            new OA\Property(
                                property: 'price_from',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'price_to',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'discount',
                                type: 'string'
                            ),
                            new OA\Property(
                                property: 'installment',
                                type: 'string'
                            ),
                        ],
                        type: 'object',
                    ),
                    new OA\Property(
                        property: 'layout_info',
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: 'square_from',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'square_to',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'rooms',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'photo',
                                    description: 'Upload photo',
                                    type: 'string'
                                ),
                            ]
                        )
                    ),
                    new OA\Property(
                        property: 'location_info',
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(
                                    property: 'name',
                                    type: 'string'
                                ),
                                new OA\Property(
                                    property: 'description',
                                    type: 'string'
                                )
                            ]
                        )
                    ),
                ]
            )
        ),
        tags: ['Buildings'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "name" => "Town house",
                            "square_from" => 150,
                            "square_to" => 300,
                            "number_floors" => 12,
                            "number_apartments" => 140,
                            "number_parking_spaces" => 200,
                            "photo" => "buildings/ciMdg60pOHXzp8btdnZHJ2S8uOh2RvS0z910bqa5.jpg",
                            "id" => 16,
                        ],
                    ]
                )),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param CreateBuildingRequest $request
     * @param CreateBuildingHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CreateBuildingRequest $request, CreateBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Put(
        path: "/api/v1/building/{id}",
        summary: "Update Building",
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
                        property: 'name',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'square_from',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'square_to',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_floors',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_apartments',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'number_parking_spaces',
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
        tags: ['Buildings'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Building Id",
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
     * @param UpdateBuildingHandler $handler
     * @param UpdateBuildingRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateBuildingHandler $handler, UpdateBuildingRequest $request): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);

        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/building/{id}",
        summary: "Delete Building",
        tags: ['Buildings'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Building Id",
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
     * @param DeleteBuildingHandler $handler
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteBuildingHandler $handler): JsonResponse
    {
        $handler->handle($id);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
