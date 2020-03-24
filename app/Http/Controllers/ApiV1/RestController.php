<?php

namespace App\Http\Controllers\ApiV1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class RestController, in case of different approach of code treatment than  [Controller class].
 * @package App\Http\Controllers\ApiV1
 */
class RestController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
