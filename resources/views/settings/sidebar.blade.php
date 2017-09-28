<aside class="menu">
    <ul class="menu-list">
        <li><a href="/settings" class="{{ $uri == 'settings'? 'is-active':'' }}">Update Account</a></li>
        <li><a href="/settings/subscription" class="{{ $uri == 'settings/subscription'? 'is-active':'' }}">Subscription</a></li>
        <li><a href="/settings/card" class="{{ $uri == 'settings/card'? 'is-active':'' }}">Credit Card</a></li>
        <li><a href="" class="{{ $uri == 'settings/cancel'? 'is-active':'' }}">Cancel</a></li>
    </ul>
</aside>