### 0.2.0

#### Breaking changes

1. `Dsl\MyTarget\Domain\V1\Remarketing\RemarketingUserList` and `Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting`
    were completely changed to reflect the real state of things.
2. `Package::targetings` is now of type `CampaignTargeting` rather than `Targeting`.
3. `Dsl\MyTarget\Domain\V1\Targeting\Targeting` class was removed.
4. `RemarketingItem::usersLists` type was changed to `RemarketingItemUserList`
5. `RateLimitProvider::isLimitReached()` was removed in favour of `RateLimitProvider::rateLimitTimeout()`.
    A new method has to return a number of seconds to wait while rate limit is held.

#### Fixes

1. Fixed `Creative->variants` hydrating type

### 0.1.0

Initial release
