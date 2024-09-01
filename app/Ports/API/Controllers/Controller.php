<?php

namespace App\Ports\API\Controllers;

use App\Support\Traits\ResponseTrait;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="2.0",
 *         title="961 Apart Docs",
 *         description="Description to Api",
 *     )
 * )
 */
abstract class Controller
{
    const SUCCESS = 'Success';

    use ResponseTrait;
}
