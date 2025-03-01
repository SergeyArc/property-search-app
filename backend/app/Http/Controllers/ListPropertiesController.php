<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\FilterData;
use App\ViewModels\GetProperties;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListPropertiesController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filterData = FilterData::validateAndCreate($request->all());
        $model = new GetProperties($request->get('page', 1));

        return response()->json($model->properties($filterData));
    }
}
