<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Mapper\Annotation\Field;

/**
 * Called `Targetings` in MyTarget documentation
 */
class RemarketingItem
{
    /**
     * @var RemarketingCounterInterval[]
     * @Field(name="remarketing_counters", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingCounterInterval>")
     */
    private $counters;

    /**
     * @var RemarketingGameInterval[]
     * @Field(name="remarketing_game_payers", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGameInterval>")
     */
    private $gamePayers;

    /**
     * @var RemarketingGameInterval[]
     * @Field(name="remarketing_game_players", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGameInterval>")
     */
    private $gamePlayers;

    /**
     * @var RemarketingInterval[]
     * @Field(name="remarketing_payers", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingInterval>")
     */
    private $payers;

    /**
     * @var RemarketingInterval[]
     * @Field(name="remarketing_players", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingInterval>")
     */
    private $players;

    /**
     * @var RemarketingGroupMembership[]
     * @Field(name="remarketing_groups", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingGroupMembership>")
     */
    private $groups;

    /**
     * @var RemarketingItemUserList[]
     * @Field(name="remarketing_users_lists", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingItemUserList>")
     */
    private $usersLists;

    /**
     * @var RemarketingContextPhrasesInterval[]
     * @Field(name="remarketing_context_phrases", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingContextPhrasesInterval>")
     */
    private $contextPhrases;

    /**
     * @var RemarketingPricelistInterval[]
     * @Field(name="remarketing_pricelists", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingPricelistInterval>")
     */
    private $pricelists;

    /**
     * @var RemarketingMobileApps[]
     * @Field(name="remarketing_mobile_apps", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingMobileApps>")
     */
    private $mobileApps;

    /**
     * TODO unsupported due to being undocumented in my.com docs...
     * @Field(name="remarketing_custom_audiences", type="mixed")
     */
    private $_audiences;

    /**
     * @var RemarketingVkGroup[]
     * @Field(name="remarketing_vk_groups", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkGroup>")
     */
    private $vkGroups;

    /**
     * @var RemarketingVkApp[]
     * @Field(name="remarketing_vk_apps", type="array<Dsl\MyTarget\Domain\V1\Remarketing\RemarketingVkApp>")
     */
    private $vkApps;

    /**
     * TODO unsupported due to being undocumented in docs
     * @Field(name="remarketing_android_categories", type="mixed")
     */
    private $_androidCategories;

    /**
     * @return RemarketingCounterInterval[]
     */
    public function getCounters()
    {
        return $this->counters;
    }

    /**
     * @param RemarketingCounterInterval[] $counters
     */
    public function setCounters($counters)
    {
        $this->counters = $counters;
    }

    /**
     * @return RemarketingGameInterval[]
     */
    public function getGamePayers()
    {
        return $this->gamePayers;
    }

    /**
     * @param RemarketingGameInterval[] $gamePayers
     */
    public function setGamePayers($gamePayers)
    {
        $this->gamePayers = $gamePayers;
    }

    /**
     * @return RemarketingGameInterval[]
     */
    public function getGamePlayers()
    {
        return $this->gamePlayers;
    }

    /**
     * @param RemarketingGameInterval[] $gamePlayers
     */
    public function setGamePlayers($gamePlayers)
    {
        $this->gamePlayers = $gamePlayers;
    }

    /**
     * @return RemarketingInterval[]
     */
    public function getPayers()
    {
        return $this->payers;
    }

    /**
     * @param RemarketingInterval[] $payers
     */
    public function setPayers($payers)
    {
        $this->payers = $payers;
    }

    /**
     * @return RemarketingInterval[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param RemarketingInterval[] $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @return RemarketingGroupMembership[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param RemarketingGroupMembership[] $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return RemarketingItemUserList[]
     */
    public function getUsersLists()
    {
        return $this->usersLists;
    }

    /**
     * @param RemarketingItemUserList[] $usersLists
     */
    public function setUsersLists($usersLists)
    {
        $this->usersLists = $usersLists;
    }

    /**
     * @return RemarketingContextPhrasesInterval[]
     */
    public function getContextPhrases()
    {
        return $this->contextPhrases;
    }

    /**
     * @param RemarketingContextPhrasesInterval[] $contextPhrases
     */
    public function setContextPhrases($contextPhrases)
    {
        $this->contextPhrases = $contextPhrases;
    }

    /**
     * @return RemarketingPricelistInterval[]
     */
    public function getPricelists()
    {
        return $this->pricelists;
    }

    /**
     * @param RemarketingPricelistInterval[] $pricelists
     */
    public function setPricelists($pricelists)
    {
        $this->pricelists = $pricelists;
    }

    /**
     * @return RemarketingMobileApps[]
     */
    public function getMobileApps()
    {
        return $this->mobileApps;
    }

    /**
     * @param RemarketingMobileApps[] $mobileApps
     */
    public function setMobileApps($mobileApps)
    {
        $this->mobileApps = $mobileApps;
    }

    /**
     * @deprecated Subject to removal (and introducing no-underscored method in place) when it will be clear what does API expect/give us here
     * @return mixed
     */
    public function _getAudiences()
    {
        return $this->_audiences;
    }

    /**
     * @deprecated Subject to removal (and introducing no-underscored method in place) when it will be clear what does API expect/give us here
     * @param mixed $_audiences
     */
    public function _setAudiences($_audiences)
    {
        $this->_audiences = $_audiences;
    }

    /**
     * @return RemarketingVkGroup[]
     */
    public function getVkGroups()
    {
        return $this->vkGroups;
    }

    /**
     * @param RemarketingVkGroup[] $vkGroups
     */
    public function setVkGroups($vkGroups)
    {
        $this->vkGroups = $vkGroups;
    }

    /**
     * @return RemarketingVkApp[]
     */
    public function getVkApps()
    {
        return $this->vkApps;
    }

    /**
     * @param RemarketingVkApp[] $vkApps
     */
    public function setVkApps($vkApps)
    {
        $this->vkApps = $vkApps;
    }

    /**
     * @deprecated Subject to removal (and introducing no-underscored method in place) when it will be clear what does API expect/give us here
     * @return mixed
     */
    public function _getAndroidCategories()
    {
        return $this->_androidCategories;
    }

    /**
     * @deprecated Subject to removal (and introducing no-underscored method in place) when it will be clear what does API expect/give us here
     * @param mixed $_androidCategories
     */
    public function _setAndroidCategories($_androidCategories)
    {
        $this->_androidCategories = $_androidCategories;
    }
}
