<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings;

use App\Domains\Buildings\Handlers\Buildings\FindBuildingHandler;
use App\Domains\Buildings\Handlers\Buildings\GetAllBuildingHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Buildings\FilterBuildingRequest;
use App\Ports\API\Requests\Buildings\Buildings\FindBuildingRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class BuildingController extends Controller
{
    #[OA\Get(
        path: "/api/v1/building/all",
        summary: "Get all",
        tags: ['Buildings'],
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
                                "name" => "Town house",
                                "square_from" => "150",
                                "square_to" => "300",
                                "number_floors" => 12,
                                "number_apartments" => 140,
                                "number_parking_spaces" => 200,
                                "is_mock" => false,
                                "photo" => "buildings/T1rx1kz7khqGlNz2C0EHu3hMs3XOurCMfPzOcOYs.jpg",
                            ]
                        ]
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param FilterBuildingRequest $request
     * @param GetAllBuildingHandler $handler
     * @return JsonResponse
     */
    public function all(FilterBuildingRequest $request, GetAllBuildingHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Get(
        path: "/api/v1/building/{id}/find",
        summary: "Retrieve Building by Id",
        tags: ['Buildings'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Building id",
                in: "path",
                required: true,
            ),
            new OA\Parameter(
                name: "include",
                description: "?include=address,locations,layouts,price",
                in: "query",
                required: false,
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
                            "id" => 14,
                            "name" => "Town house",
                            "square_from" => "150",
                            "square_to" => "300",
                            "number_floors" => 12,
                            "number_apartments" => 140,
                            "number_parking_spaces" => 200,
                            "is_mock" => false,
                            "photo" => "buildings/JpbCqIijlhiQxTVhKf3NPnrdQqO460v3treGyUZz.jpg",
                            "address" => [
                                "id" => 5,
                                "building_id" => 14,
                                "address" => "rteet",
                                "longitude" => "69.12",
                                "latitude" => "42.11",
                            ],
                            "locations" => [
                                [
                                    "id" => 1,
                                    "building_id" => 14,
                                    "name" => "Дендро парк в близи",
                                    "description" => "Самый большой парк",
                                ],
                            ],
                            "layouts" => [
                                [
                                    "id" => 4,
                                    "building_id" => 14,
                                    "photo" =>
                                        "layouts/GMexOjnX8DzaThxnBtZ9FxvX9QuLyfhBS1gbhT1M.jpg",
                                    "square_from" => "40",
                                    "square_to" => "110",
                                    "rooms" => 4,
                                ],
                            ],
                            "prices" => [
                                "id" => 4,
                                "building_id" => 14,
                                "price_from" => "100",
                                "price_to" => "1000",
                                "discount" => "35",
                                "installment" => "0",
                            ],
                        ],
                    ]
                )
            ),
            new OA\Response(response: Response::HTTP_NOT_FOUND, description: "Not found"),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Server Error")
        ]
    )]
    /**
     * @param int $id
     * @param FindBuildingRequest $request
     * @param FindBuildingHandler $handler
     * @return JsonResponse
     */
    public function find(int $id, FindBuildingRequest $request, FindBuildingHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);

        return $this->response(
            data: $handler->handle($dto)
        );
    }
}
