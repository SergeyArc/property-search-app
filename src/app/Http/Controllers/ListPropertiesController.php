<?php

namespace App\Http\Controllers;

use App\ViewModels\GetProperties;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\DataTransferObjects\FilterData;

class ListPropertiesController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filterData = FilterData::validateAndCreate($request->all());
        $model = new GetProperties($request->get('page', 1));

        return response()->json($model->properties($filterData));
    }
}
