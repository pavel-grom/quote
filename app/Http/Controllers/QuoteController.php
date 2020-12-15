<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Transformers\QuoteTransformer;
use Flugg\Responder\TransformBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index(Request $request, TransformBuilder $transformation): ?array
    {
        $limit = getRightApiLimit((int) $request->get('limit', 10));

        $quotePagination = Quote::query()
            ->when(
                $request->get('author'),
                fn(Builder $builder, string $author) => $builder->whereHas(
                    'character',
                    fn(Builder $subBuilder) => $subBuilder->where('name', 'like', "%$author%")
                )
            )
            ->paginate($limit);

        return $transformation
            ->resource($quotePagination, QuoteTransformer::class)
            ->transform();
    }

    public function random(TransformBuilder $transformation): ?array
    {
        $randomQuote = Quote::query()->inRandomOrder()->first();

        return $transformation
            ->resource($randomQuote, QuoteTransformer::class)
            ->transform();
    }
}
