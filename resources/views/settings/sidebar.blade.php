<aside class="menu">
    <ul class="menu-list">
        <li>
            <a href="/settings" class="{{ $uri == 'settings'? 'is-active':'' }}">@lang('index.update account')</a>
        </li>
        <li>
            <a href="/settings/card" class="{{ $uri == 'settings/card'? 'is-active':'' }}">@lang('index.update cc')</a>
        </li>
        @if(!$auth->subscribed('main') || ($auth->subscribed('main') && $auth->subscription('main')->cancelled()))
            <li>
                <a href="/settings/subscription" class="{{ $uri == 'settings/subscription'? 'is-active':'' }}">@lang('index.subscription')</a>
            </li>
        @endif
        <li>
            <a href="/settings/invoices" class="{{ $uri == 'settings/invoices'? 'is-active':'' }}">@lang('index.invoices')</a>
        </li>
        @if($auth->subscribed('main') && !$auth->subscription('main')->cancelled())
            <li>
                <a href="/settings/cancel" class="{{ $uri == 'settings/cancel'? 'is-active':'' }}">@lang('index.cancel sub')</a>
            </li>
        @endif
    </ul>
</aside>