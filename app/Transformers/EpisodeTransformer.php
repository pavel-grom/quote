<?php

namespace App\Transformers;

use App\Models\Episode;
use Flugg\Responder\Transformers\Transformer;

class EpisodeTransformer extends Transformer
{
    /**: array
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'characters' => CharacterTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    public function transform(Episode $episode): array
    {
        return [
            'id' => (int) $episode->id,
            'title' => $episode->title,
            'air_date' => $episode->air_date->toDateString(),
        ];
    }
}
