<?php
declare(strict_types=1);

namespace App\Ports\API\Controllers\Buildings\Admin;

use App\Domains\Buildings\Handlers\Recource\Advantages\CreateAdvantageHandler;
use App\Domains\Buildings\Handlers\Recource\Advantages\DeleteAdvantageHandler;
use App\Domains\Buildings\Handlers\Recource\Advantages\GetAllAdvantageHandler;
use App\Domains\Buildings\Handlers\Recource\Advantages\UpdateAdvantageHandler;
use App\Ports\API\Controllers\Controller;
use App\Ports\API\Requests\Buildings\Advantages\CreateAdvantageRequest;
use App\Ports\API\Requests\Buildings\Advantages\UpdateAdvantageRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class AdvantageController extends Controller
{
    #[OA\Get(
        path: "/api/v1/advantage",
        summary: "Get all",
        tags: ['Advantage'],
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
     * @param GetAllAdvantageHandler $handler
     * @return JsonResponse
     */
    public function index(GetAllAdvantageHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle()
        );
    }

    #[OA\Get(
        path: "/api/v1/advantage/{id}",
        summary: "Retrieve Advantage by Id",
        tags: ['Advantage'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Advantage id",
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
     * @param GetAllAdvantageHandler $handler
     * @return JsonResponse
     */
    public function show(int $id, GetAllAdvantageHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($id)
        );
    }

    #[OA\Post(
        path: "/api/v1/advantage",
        summary: "Create advantage",
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
        tags: ['Advantage'],
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
                            "photo" => "advantages/pnGQWDxHsR15YMBPcfas6mYPFquZZkEGOiRNnw1O.jpg",
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
     * @param CreateAdvantageRequest $request
     * @param CreateAdvantageHandler $handler
     * @return JsonResponse
     */
    public function store(CreateAdvantageRequest $request, CreateAdvantageHandler $handler): JsonResponse
    {
        return $this->response(
            data: $handler->handle($request->toDto())
        );
    }

    #[OA\Put(
        path: "/api/v1/advantage/{id}",
        summary: "Update Advantage",
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
        tags: ['Advantage'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Advantage id",
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
     * @param UpdateAdvantageRequest $request
     * @param UpdateAdvantageHandler $handler
     * @return JsonResponse
     */
    public function update(int $id, UpdateAdvantageRequest $request, UpdateAdvantageHandler $handler): JsonResponse
    {
        $dto = $request->toDto();
        $dto->setId($id);

        $handler->handle($dto);

        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }

    #[OA\Delete(
        path: "/api/v1/advantage/{id}",
        summary: "Delete advantage by Id",
        tags: ['Advantage'],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Advantage id",
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
     * @param DeleteAdvantageHandler $handler
     * @return JsonResponse
     */
    public function destroy(int $id, DeleteAdvantageHandler $handler): JsonResponse
    {
        $handler->handle($id);
        return $this->response(
            code: Response::HTTP_NO_CONTENT
        );
    }
}
