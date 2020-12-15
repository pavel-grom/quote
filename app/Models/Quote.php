<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Quote
 *
 * @property int $id
 * @property int $character_id
 * @property int $episode_id
 * @property string $quote
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereEpisodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quote whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Character $character
 * @property-read \App\Models\Episode $episode
 */
class Quote extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'quote',
        'character_episode',
    ];

    protected $appends = [
        'character_episode',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function setCharacterEpisodeAttribute(string $value): void
    {
//        dd('asdasd');
        [$characterId, $episodeId] = explode('_', $value);

        $this->attributes['character_id'] = $characterId;
        $this->attributes['episode_id'] = $episodeId;
    }

    public function getCharacterEpisodeAttribute(): string
    {
       return "{$this->character_id}_{$this->episode_id}";
    }
}
