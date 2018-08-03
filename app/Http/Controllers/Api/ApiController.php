<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class ApiController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param Model|mixed $item
     *
     * @return array
     */
    protected function item($item)
    {
        $item = new Item($item, new UserTransformer());

        return (new Manager())->createData($item)->toArray();
    }
}
