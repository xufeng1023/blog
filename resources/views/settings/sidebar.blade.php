<aside class="menu">
	<p class="menu-label">
    	Account
  	</p>
    <ul class="menu-list">
        <li><a href="/settings" class="{{ $uri == 'settings'? 'is-active':'' }}">Update Account</a></li>
        <li><a href="/settings/card" class="{{ $uri == 'settings/card'? 'is-active':'' }}">Update Credit Card</a></li>
    </ul>
    <p class="menu-label">
    	Subscription
  	</p>
  	<ul class="menu-list">
      @if(!auth()->user()->subscription('main')->cancelled())
        <li>
          <a href="/settings/plan" class="{{ $uri == 'settings/plan'? 'is-active':'' }}">
            Change Plan
          </a>
      </li>
      @endif
        <li><a href="/settings/cancel" class="{{ $uri == 'settings/cancel'? 'is-active':'' }}">Cancel</a></li>
    </ul>
</aside>