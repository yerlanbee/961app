<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Buildings\Locations\DeleteLocationByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Locations\GetAllLocationByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Locations\UpdateLocationByBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\UpdateLocationRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class LocationController extends Controller
{
    #[OA\Get(
        path: "/api/v1/admin/location/all",
        summary: "Get all",
        tags: ['Location'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            [
                                "name" => "Test",
                                "description" => "test"
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
     * @param GetAllLocationByBuildingHandler $handler
     * @return JsonResponse
     */
    public function all(GetAllLocationByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/admin/location/{buildingId}",
        summary: "Find by Building Id",
        tags: ['Location'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Building id",
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
                            "name" => "Test",
                            "description" => "test"
                        ],
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param int $buildingId
     * @param GetAllLocationByBuildingHandler $handler
     * @return JsonResponse
     */
    public function findByBuilding(int $buildingId, GetAllLocationByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($buildingId)
        );
    }

    #[OA\Put(
        path: "/api/v1/location/{id}/update",
        summary: "Update Location By Building",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['building_id'],
                properties: [
                    new OA\Property(
                        property: 'building_id',
                        type: 'integer'
                    ),
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
        tags: ['Location'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Building id",
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
     * @param UpdateLocationRequest $request
     * @param UpdateLocationByBuildingHandler $handler
     * @return JsonResponse
     */
    public function updateByBuilding(
        int $id,
        UpdateLocationRequest $request,
        UpdateLocationByBuildingHandler $handler
    ): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);
        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/location/{Id}/delete",
        summary: "Delete Location by Id",
        tags: ['Location'],
        parameters: [
            new OA\Parameter(
                name: "id",
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
     * @param int $buildingId
     * @param DeleteLocationByBuildingHandler $handler
     * @return JsonResponse
     */
    public function deleteByBuilding(int $buildingId, DeleteLocationByBuildingHandler $handler): JsonResponse
    {
        $handler->handle($buildingId);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
