<?php

declare(strict_types=1);

namespace App\Bot\Commands;

use App\Models\Character;
use Telegram\Bot\Commands\Command;

class CharactersCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "characters";

    protected $pattern = '{page}';

    /**
     * @var string Command Description
     */
    protected $description = "Characters list";

    /**
     * @inheritdoc
     */
    public function handle($arguments = [])
    {
        $characters = Character::query()
            ->paginate(3, ['*'], 'page', $arguments['page'] ?? 1);

        $charactersText = $characters->getCollection()
            ->map(fn(Character $character) => "{$character->name} - /quotes_{$character->id}")
            ->implode("\n");

        try {
            $this->replyWithMessage([
                'text' => $charactersText . json_encode($this->getArguments()),
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => '<', 'callback_data' => '/characters_' . max($characters->currentPage() - 1, 1)],
                            ['text' => '>', 'callback_data' => '/characters_' . min($characters->currentPage() + 1, $characters->lastPage())]
                        ]
                    ],
                ], JSON_THROW_ON_ERROR),
            ]);

        } catch (\Exception $e) {
            $this->replyWithMessage(['text' => json_encode([$e->getMessage(), $e->getFile(), $e->getLine()], JSON_THROW_ON_ERROR)]);

            return;
        }
    }
}
