<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

    <li class="nav-header text-underline">Initialization</li>

    {{-- Dashboard --}}
    <x-back.new-nav-link fa_icon="" title="Dashboard" route="admin.dashboard" fa_icon="fa-tachometer-alt"></x-back.new-nav-link>
    {{-- <x-back.new-nav-link fa_icon="" title="Analytics" route="admin.analytics" fa_icon="fa-chart-bar"></x-back.new-nav-link> --}}
    <x-back.new-nav-link-dropdown title="Settings" route="admin.settings*" fa_icon="fa-cogs">
        <x-back.new-nav-link fa_icon="" title="General" route="admin.settings.general"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Mail" route="admin.settings.mail"></x-back.new-nav-link>

    </x-back.new-nav-link-dropdown>


</ul>
