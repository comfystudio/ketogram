<div id="sidebar">
    <!-- Sidebar Brand -->

    <div id="sidebar-brand" class="themed-background">
        <a href="/" class="sidebar-title">
	        <i class="fa fa-cube"></i><span class="sidebar-nav-mini-hide">{{SITE_NAME}}</span>
	    </a>
    </div><!-- END Sidebar Brand -->
    <!-- Wrapper for scrolling functionality -->

    <div id="sidebar-scroll">
        <!-- Sidebar Content -->

        <div class="sidebar-content">
            <!-- Sidebar Navigation -->

            <ul class="sidebar-nav">
                <li>
                	<a href="/admin/admin-users/" @if(isset($meta['section']) && $meta['section'] == 'Admin Users') class = "active" @endif>
						<i class="fa fa-user sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Admin Users</span>
					</a>
				</li>
                <li>
                	<a href="/admin/users/" @if(isset($meta['section']) && $meta['section'] == 'Users') class = "active" @endif>
						<i class="fa fa-users sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Frontend Users</span>
					</a>
				</li>

				<li>
                    <a href="/admin/subscriptions/" @if(isset($meta['section']) && $meta['section'] == 'Subscription') class = "active" @endif>
                        <i class="fa fa-diamond sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Subscriptions</span>
                    </a>
                </li>

				<li>
                    <a href="/admin/orders/" @if(isset($meta['section']) && $meta['section'] == 'Order') class = "active" @endif>
                        <i class="fa fa-shopping-cart sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Orders</span>
                    </a>
                </li>

				<li>
                    <a href="#" class="sidebar-nav-menu @if(isset($meta['section']) && $meta['section'] == 'Item') open @endif">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="fa fa-cutlery sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Items</span>
                    </a>
                    <ul>
                        <li><a href="/admin/items/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Item') class = "active" @endif >Manage Items</a></li>
                        <li><a href="/admin/food_categories/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Food Categories') class = "active" @endif >Manage Items Categories</a></li>
                    </ul>
                </li>

				<li>
                    <a href="#" class="sidebar-nav-menu @if(isset($meta['section']) && $meta['section'] == 'News') open @endif">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="fa fa-newspaper-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">News</span>
                    </a>
                    <ul>
                        <li><a href="/admin/news/" @if(isset($meta['subSection']) && $meta['subSection'] == 'News') class = "active" @endif >Manage News</a></li>
                        <li><a href="/admin/categories/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Categories') class = "active" @endif >Manage News Categories</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="sidebar-nav-menu @if(isset($meta['section']) && $meta['section'] == 'Recipes') open @endif">
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        <i class="fa fa-heart sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Recipes</span>
                    </a>
                    <ul>
                        <li><a href="/admin/recipes/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Recipes') class = "active" @endif >Manage Recipes</a></li>
                        <li><a href="/admin/categories/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Categories') class = "active" @endif >Manage Recipe Categories</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/admin/queries/" @if(isset($meta['section']) && $meta['section'] == 'Query') class = "active" @endif>
                        <i class="fa fa-envelope-o sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Queries</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/coupons/" @if(isset($meta['section']) && $meta['section'] == 'Coupon') class = "active" @endif>
                        <i class="fa fa-ticket sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Coupons</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/emails/" @if(isset($meta['section']) && $meta['section'] == 'Email') class = "active" @endif>
                        <i class="fa fa-file-text sidebar-nav-icon"></i>
                        <span class="sidebar-nav-mini-hide">Emails</span>
                    </a>
                </li>

				{{--<li>--}}
                    {{--<a href="#" class="sidebar-nav-menu @if(isset($meta['section']) && $meta['section'] == 'Users') open @endif">--}}
                        {{--<i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>--}}
                        {{--<i class="fa fa-bed sidebar-nav-icon"></i>--}}
                        {{--<span class="sidebar-nav-mini-hide">Templates</span>--}}
                    {{--</a>--}}
                    {{--<ul>--}}
                        {{--<li><a href="/backoffice/templates/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Users') class = "active" @endif >Manage Templates</a></li>--}}
                        {{--<li><a href="/backoffice/rooms/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Users') class = "active" @endif >Manage Rooms</a></li>--}}
                        {{--<li><a href="/backoffice/items/" @if(isset($meta['subSection']) && $meta['subSection'] == 'Users') class = "active" @endif >Manage Items</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

            </ul><!-- END Sidebar Navigation -->
        </div><!-- END Sidebar Content -->
    </div><!-- END Wrapper for scrolling functionality -->
</div><!-- END Main Sidebar -->