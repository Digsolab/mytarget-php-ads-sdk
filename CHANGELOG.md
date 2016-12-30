### 0.6.0

#### Breaking changes

1. Eradicated `Client*Operator` operators completely, use context instead to pass client's username.
2. Every method that was expecting `array $context` will now expect `Context $context`, if you want e.g. to make a request for client with username `"foo"` you can now do it via `$operator->requestMethod(... params, Context::forClient("foo"))`.

...

### 0.2.0

#### Breaking changes

1. `Dsl\MyTarget\Domain\V1\Remarketing\RemarketingUserList` and `Dsl\MyTarget\Domain\V1\Targeting\RemarketingTargeting`
    were completely changed to reflect the real state of things.
2. `Package::targetings` is now of type `CampaignTargeting` rather than `Targeting`.
3. `Dsl\MyTarget\Domain\V1\Targeting\Targeting` class was removed.
4. `RemarketingItem::usersLists` type was changed to `RemarketingItemUserList`
5. `RateLimitProvider::isLimitReached()` was removed in favour of `RateLimitProvider::rateLimitTimeout()`.
    A new method has to return a number of seconds to wait while rate limit is held.
6. `Dsl\MyTarget\Domain\V1\Statistic\DatedStat` was completely removed as it was redundant in the hierarchy.
7. `BannerOperator::findAll()` signature was changed.

#### Fixes

1. Fixed `Creative->variants` hydrating type
2. Add `Banner->content` field (for banners of newer packages)
3. `V2\Creative->variants` should have a type of `dict<Variant>` now (it was `Variant` before which is wrong)

#### Features

1. `ClientErrorException` was specified to 403- and 404-HTTP-specific exceptions: `AccessForbiddenException` and
    `NotFoundException`. Otherwise `ClientErrorException` will be thrown as always.

### 0.1.0

Initial release
