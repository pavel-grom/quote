<?php

namespace App\Transformers;

use App\Models\Quote;
use Flugg\Responder\Transformers\Transformer;

class QuoteTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    public function transform(Quote $quote): array
    {
        return [
            'id' => (int) $quote->id,
            'quote' => $quote->quote,
        ];
    }
}
