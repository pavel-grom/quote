<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Transformers\EpisodeTransformer;
use Flugg\Responder\TransformBuilder;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Request $request, TransformBuilder $transformation): ?array
    {
        $limit = getRightApiLimit((int) $request->get('limit', 10));

        return $transformation
            ->resource(Episode::query()->paginate($limit), EpisodeTransformer::class)
            ->transform();
    }

    public function show(TransformBuilder $transformation, $id): ?array
    {
        return $transformation
            ->resource(Episode::query()->findOrFail($id), EpisodeTransformer::class)
            ->with('characters')
            ->transform();
    }
}
