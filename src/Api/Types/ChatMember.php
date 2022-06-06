<?php


namespace Vashakidze\Telegram\Api\Types;


use Vashakidze\Telegram\Api\Type;
use Vashakidze\Telegram\Api\Enums\ChatMemberType;

/**
 * Class ChatMember
 * @package Vashakidze\Telegram\Api\Types
 *
 * @property-read ChatMemberType $type Member type
 * @property-read ChatMemberOwner|null $owner Represents a chat member that owns the chat and has all administrator privileges
 * @property-read ChatMemberAdministrator|null $administrator Represents a chat member that has some additional privileges
 * @property-read ChatMemberMember|null $member Represents a chat member that has no additional privileges or restrictions
 * @property-read ChatMemberRestricted|null $restricted Represents a chat member that is under certain restrictions in the chat. Supergroups only
 * @property-read ChatMemberLeft|null $left Represents a chat member that isn't currently a member of the chat, but may join it themselves
 * @property-read ChatMemberBanned|null $banned Represents a chat member that was banned in the chat and can't return to the chat or view chat messages
 */
class ChatMember extends Type
{
    protected ChatMemberType $type;
    protected ?ChatMemberOwner $owner = null;
    protected ?ChatMemberAdministrator $administrator = null;
    protected ?ChatMemberMember $member = null;
    protected ?ChatMemberRestricted $restricted = null;
    protected ?ChatMemberLeft $left = null;
    protected ?ChatMemberBanned $banned = null;

    public static function init(array $data): self
    {
        $chatMember = new self();

        $chatMember->type = ChatMemberType::fromStatus($data['status']);

        /**
         * @see ChatMember::setOwner()
         * @see ChatMember::setAdministrator()
         * @see ChatMember::setMember()
         * @see ChatMember::setRestricted()
         * @see ChatMember::setLeft()
         * @see ChatMember::setBanned()
         */
        $chatMember->{$chatMember->type->toSetMethodName()}($data);

        return $chatMember;
    }

    private function setOwner(array $data): void
    {
        $this->owner = ChatMemberOwner::init($data);
    }

    private function setAdministrator(array $data): void
    {
        $this->administrator = ChatMemberAdministrator::init($data);
    }

    private function setMember(array $data): void
    {
        $this->member = ChatMemberMember::init($data);
    }

    private function setRestricted(array $data): void
    {
        $this->restricted = ChatMemberRestricted::init($data);
    }

    private function setLeft(array $data): void
    {
        $this->left = ChatMemberLeft::init($data);
    }

    private function setBanned(array $data): void
    {
        $this->banned = ChatMemberBanned::init($data);
    }
}
