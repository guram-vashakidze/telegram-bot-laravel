<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;

/**
 * Class Game
 * @package Vashakidze\Telegram\Api\Types
 *
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 *
 * @link https://core.telegram.org/bots/api#game
 *
 * @property-read string $title Title of the game
 * @property-read string $description Description of the game
 * @property-read PhotoSize[] $photo Photo that will be displayed in the game message in chats
 * @property-read string|null $text Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
 * @property-read MessageEntity[]|null $textEntities Special entities that appear in text, such as usernames, URLs, bot commands, etc.
 * @property-read Animation|null $animation Animation that will be displayed in the game message in chats. Upload via BotFather
 */
class Game extends Type
{
    protected string $title;
    protected string $description;
    protected array $photo;
    protected ?string $text;
    protected ?array $textEntities;
    protected ?Animation $animation;

    public static function init(array $data): self
    {
        $game = new self();

        $game->title = $data['title'];
        $game->description = $data['description'];

        $game->setPhoto($data);

        $game->text = $data['text'] ?? null;

        $game->setTextEntities($data);
        $game->animation = !empty($data['animation']) ? Animation::init($data['animation']) : null;
        return $game;
    }

    protected function setTextEntities(array $data): void
    {
        $this->textEntities = null;

        if (empty($data['text_entities'])) {
            return;
        }

        $this->textEntities = [];

        foreach ($data['text_entities'] as $entity) {
            $this->textEntities[] = MessageEntity::init($entity);
        }
    }

    protected function setPhoto(array $data): void
    {
        $this->photo = [];

        foreach ($data['photo'] as $photo) {
            $this->photo[] = PhotoSize::init($photo);
        }
    }
}
