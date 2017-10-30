<aside class="menu">
    <ul class="menu-list">
        <li>
            <a href="/settings" class="{{ $uri == 'settings'? 'is-active':'' }}">Update Account</a>
        </li>
        <li>
            <a href="/settings/card" class="{{ $uri == 'settings/card'? 'is-active':'' }}">Update Credit Card</a>
        </li>
        <li>
            <a href="/settings/subscription" class="{{ $uri == 'settings/plan'? 'is-active':'' }}">Subscription</a>
        </li>
        <li>
            <a href="/settings/invoices" class="{{ $uri == 'settings/invoices'? 'is-active':'' }}">Invoices</a>
        </li>
        @if(!auth()->user()->subscription('main')->cancelled())
            <li>
                <a href="/settings/cancel" class="{{ $uri == 'settings/cancel'? 'is-active':'' }}">Cancel</a>
            </li>
        @endif
    </ul>
</aside>