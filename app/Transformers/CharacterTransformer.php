<?php

namespace App\Transformers;

use App\Models\Character;
use Flugg\Responder\Transformers\Transformer;

class CharacterTransformer extends Transformer
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

    public function transform(Character $character): array
    {
        return [
            'id' => (int) $character->id,
            'name' => $character->name,
            'birthday' => $character->birthday->toDateString(),
            'occupations' => $character->occupations,
            'img' => $character->img,
            'nickname' => $character->nickname,
            'portrayed' => $character->portrayed,
            'episode_ids' => $character->episodes->pluck('id'),
            'quote_ids' => $character->quotes->pluck('id'),
        ];
    }
}
