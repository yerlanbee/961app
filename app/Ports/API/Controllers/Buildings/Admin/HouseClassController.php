<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Recource\HouseClasses\CreateHouseClassHandler;
use App\Domains\Buildings\Handlers\Recource\HouseClasses\DeleteHouseClassHandler;
use App\Domains\Buildings\Handlers\Recource\HouseClasses\GetAllHouseClassHandler;
use App\Domains\Buildings\Handlers\Recource\HouseClasses\UpdateHouseClassHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\HouseClasses\CreateHouseClassRequest;
use App\Ports\API\Requests\Buildings\HouseClasses\UpdateHouseClassRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class HouseClassController extends Controller
{
    #[OA\Get(
        path: "/api/v1/house-class",
        summary: "Get all",
        tags: ['HouseClass'],
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
                                "title" => "",
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
     * @param GetAllHouseClassHandler $handler
     * @return JsonResponse
     */
    public function index(GetAllHouseClassHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/house-class/{id}",
        summary: "Retrieve HouseClass by Id",
        tags: ['HouseClass'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "HouseClass id",
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
     * @param GetAllHouseClassHandler $handler
     * @return JsonResponse
     */
    public function show(int $id, GetAllHouseClassHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($id)
        );
    }

    #[OA\Post(
        path: "/api/v1/house-class",
        summary: "Create HouseClass",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    'title',
                ],
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'published',
                        type: 'bool'
                    ),
                ]
            )
        ),
        tags: ['HouseClass'],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "Successfully",
                content: new OA\JsonContent(
                    example: [
                        "message" => "Success",
                        "data" => [
                            "title" => "",
                            "id" => 10,
                        ]
                    ]
                )),
            new OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: "Internal Server Error")
        ]
    )]
    /**
     * @param CreateHouseClassRequest $request
     * @param CreateHouseClassHandler $handler
     * @return JsonResponse
     */
    public function store(CreateHouseClassRequest $request, CreateHouseClassHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Put(
        path: "/api/v1/house-class/{id}",
        summary: "Update HouseClass",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    'title'
                ],
                properties: [
                    new OA\Property(
                        property: 'title',
                        type: 'string'
                    ),
                    new OA\Property(
                        property: 'published',
                        type: 'bool'
                    )
                ]
            )
        ),
        tags: ['HouseClass'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "HouseClass id",
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
     * @param UpdateHouseClassRequest $request
     * @param UpdateHouseClassHandler $handler
     * @return JsonResponse
     */
    public function update(int $id, UpdateHouseClassRequest $request, UpdateHouseClassHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);
        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/house-class/{id}",
        summary: "Delete HouseClass by Id",
        tags: ['HouseClass'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "HouseClass id",
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
     * @param DeleteHouseClassHandler $handler
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteHouseClassHandler $handler): JsonResponse
    {
        $handler->handle($id);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
