<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

    <li class="nav-header text-underline">Initialization</li>

    {{-- Dashboard --}}
    <x-back.new-nav-link fa_icon="" title="Dashboard" route="admin.dashboard"
        fa_icon="fa-tachometer-alt"></x-back.new-nav-link>
    {{-- <x-back.new-nav-link fa_icon="" title="Analytics" route="admin.analytics" fa_icon="fa-chart-bar"></x-back.new-nav-link> --}}
    <x-back.new-nav-link-dropdown title="Settings" route="admin.settings*" fa_icon="fa-cogs">
        <x-back.new-nav-link fa_icon="" title="General" route="admin.settings.general"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Mail" route="admin.settings.mail"></x-back.new-nav-link>

    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Roles" route="admin.roles*" fa_icon="fa-tags">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.roles.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.roles.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>


    <li class="nav-header text-underline">Entity Management</li>
    <x-back.new-nav-link-dropdown title="Users" route="admin.users*" fa_icon="fa-user-secret">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.users.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.users.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Clients" route="admin.clients*" fa_icon="fa-users">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.clients.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.clients.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Event Types" route="admin.event-types*" fa_icon="fa-calendar-alt">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.event-types.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.event-types.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Payment Methods" route="admin.payment-methods*" fa_icon="fa-handshake">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.payment-methods.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.payment-methods.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Blog Categories" route="admin.post-categories*" fa_icon="fa-layer-group">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.post-categories.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.post-categories.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>

    <li class="nav-header text-underline">Blog Engine</li>



    <li class="nav-header text-underline">Booking Engine</li>




</ul>
