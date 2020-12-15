<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Transformers\CharacterTransformer;
use Flugg\Responder\TransformBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(Request $request, TransformBuilder $transformation): ?array
    {
        $limit = getRightApiLimit((int) $request->get('limit', 10));

        $charactersPagination = Character::query()
            ->with('episodes:id', 'quotes:id,character_id')
            ->when(
                $request->get('name'),
                fn(Builder $builder, string $name) => $builder->where('name', 'like', "%$name%")
            )
            ->paginate($limit);

        return $transformation
            ->resource($charactersPagination, CharacterTransformer::class)
            ->transform();
    }

    public function random(TransformBuilder $transformation): ?array
    {
        $randomCharacter = Character::query()
            ->with('episodes:id', 'quotes:id,character_id')
            ->inRandomOrder()
            ->first();

        return $transformation
            ->resource($randomCharacter, CharacterTransformer::class)
            ->with('characters')
            ->transform();
    }
}
