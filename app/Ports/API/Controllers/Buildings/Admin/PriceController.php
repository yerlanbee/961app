<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Buildings\Prices\DeletePriceByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Prices\GetAllPriceByBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\Prices\UpdatePriceByBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\UpdatePriceRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class PriceController extends Controller
{
    #[OA\Get(
        path: "/api/v1/admin/price/all",
        summary: "Get all",
        tags: ['Price'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            [
                                "id"         => 1,
                                "price_from" => "10",
                                "price_to"   => "100",
                                "discount"   => 20,
                                "installment" => 0
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
     * @param GetAllPriceByBuildingHandler $handler
     * @return JsonResponse
     */
    public function all(GetAllPriceByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/admin/price/{buildingId}",
        summary: "Find by Building Id",
        tags: ['Price'],
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
                            "id"         => 1,
                            "price_from" => "10",
                            "price_to"   => "100",
                            "discount"   => 20,
                            "installment" => 0
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
     * @param GetAllPriceByBuildingHandler $handler
     * @return JsonResponse
     */
    public function findByBuilding(int $buildingId, GetAllPriceByBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($buildingId)
        );
    }

    #[OA\Put(
        path: "/api/v1/price/{buildingId}/update",
        summary: "Update Price By Building",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
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
                    )
                ]
            )
        ),
        tags: ['Price'],
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
     * @param UpdatePriceRequest $request
     * @param UpdatePriceByBuildingHandler $handler
     * @return JsonResponse
     */
    public function updateByBuilding(
        int $buildingId,
        UpdatePriceRequest $request,
        UpdatePriceByBuildingHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setBuildingId($buildingId);
        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/price/{buildingId}/delete",
        summary: "Delete Price by BuildingId",
        tags: ['Price'],
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
     * @param DeletePriceByBuildingHandler $handler
     * @return JsonResponse
     */
    public function deleteByBuilding(int $buildingId, DeletePriceByBuildingHandler $handler): JsonResponse
    {
        $handler->handle($buildingId);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
