<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Buildings\Layouts\DeleteLayoutByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Layouts\GetAllLayoutByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Layouts\UpdateLayoutByBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\UpdateLayoutRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class LayoutController extends Controller
{
    #[OA\Get(
        path: "/api/v1/admin/layout/all",
        summary: "Get all",
        tags: ['Layout'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            [
                                "square_from" => "10",
                                "square_to" => "100",
                                "rooms"     => "2",
                                "photo"     => "layouts/"
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
     * @param GetAllLayoutByBuildingHandler $handler
     * @return JsonResponse
     */
    public function all(GetAllLayoutByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/admin/layout/{buildingId}",
        summary: "Find by Building Id",
        tags: ['Layout'],
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
                            "square_from" => "10",
                            "square_to" => "100",
                            "rooms"     => "2",
                            "photo"     => "layouts/"
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
     * @param GetAllLayoutByBuildingHandler $handler
     * @return JsonResponse
     */
    public function findByBuilding(int $buildingId, GetAllLayoutByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($buildingId)
        );
    }

    #[OA\Put(
        path: "/api/v1/layout/{id}/update",
        summary: "Update Layout By Building",
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
                        property: 'square_from',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'square_to',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'rooms',
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
        tags: ['Layout'],
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
     * @param UpdateLayoutRequest $request
     * @param UpdateLayoutByBuildingHandler $handler
     * @return JsonResponse
     */
    public function updateByBuilding(
        int $id,
        UpdateLayoutRequest $request,
        UpdateLayoutByBuildingHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);
        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/layout/{id}/delete",
        summary: "Delete Layout by id",
        tags: ['Layout'],
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
     * @param DeleteLayoutByBuildingHandler $handler
     * @return JsonResponse
     */
    public function deleteByBuilding(int $buildingId, DeleteLayoutByBuildingHandler $handler): JsonResponse
    {
        $handler->handle($buildingId);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
