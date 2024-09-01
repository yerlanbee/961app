<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Buildings\Address\DeleteAddressByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Address\GetAllAddressByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Address\UpdateAddressByBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\UpdateAddressRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class AddressController extends Controller
{
    #[OA\Get(
        path: "/api/v1/admin/address/all",
        summary: "Get all",
        tags: ['Address'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            [
                                "address"   => "",
                                "longitude" => "42.3",
                                "latitude"  => "69.123"
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
     * @param GetAllAddressByBuildingHandler $handler
     * @return JsonResponse
     */
    public function all(GetAllAddressByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/admin/address/{buildingId}",
        summary: "Find by Building Id",
        tags: ['Address'],
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
                            "address"   => "",
                            "longitude" => "42.3",
                            "latitude"  => "69.123"
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
     * @param GetAllAddressByBuildingHandler $handler
     * @return JsonResponse
     */
    public function findByBuilding(int $buildingId, GetAllAddressByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($buildingId)
        );
    }

    #[OA\Put(
        path: "/api/v1/address/{buildingId}/update",
        summary: "Update Address By Building",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'address',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'longitude',
                        type: 'integer'
                    ),
                    new OA\Property(
                        property: 'latitude',
                        type: 'string'
                    ),
                ]
            )
        ),
        tags: ['Address'],
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
     * @param int $buildingId
     * @param UpdateAddressRequest $request
     * @param UpdateAddressByBuildingHandler $handler
     * @return JsonResponse
     */
    public function updateByBuilding(int $buildingId, UpdateAddressRequest $request, UpdateAddressByBuildingHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setBuildingId($buildingId);
        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/address/{buildingId}/delete",
        summary: "Delete Address by BuildingId",
        tags: ['Address'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "BuildingId",
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
     * @param DeleteAddressByBuildingHandler $handler
     * @return JsonResponse
     */
    public function deleteByBuilding(int $buildingId, DeleteAddressByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
