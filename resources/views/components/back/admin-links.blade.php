<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-header text-underline">Initialization</li>
    <x-back.new-nav-link fa_icon="" title="Dashboard" route="admin.dashboard" fa_icon="fa-tachometer-alt">
    </x-back.new-nav-link>
    <x-back.new-nav-link-dropdown title="Settings" route="admin.settings*" fa_icon="fa-cogs">
        <x-back.new-nav-link fa_icon="" title="General" route="admin.settings.general"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Mail" route="admin.settings.mail"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Roles" route="admin.roles*" fa_icon="fa-tags">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.roles.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.roles.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <br>
    <br>


    <li class="nav-header text-underline">Entity Management</li>
    <x-back.new-nav-link-dropdown title="Users" route="admin.users*" fa_icon="fa-user-secret">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.users.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.users.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Clients" route="admin.clients*" fa_icon="fa-users">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.clients.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.clients.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Menu Categories" route="admin.menu-categories*" fa_icon="fa-list">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.menu-categories.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.menu-categories.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Menu" route="admin.menus*" fa_icon="fa-pizza-slice">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.menus.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.menus.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Event Types" route="admin.event-types*" fa_icon="fa-calendar-alt">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.event-types.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.event-types.create"></x-back.new-nav-link>
        {{-- <x-back.new-nav-link fa_icon="" title="Edit" route="admin.event-types.create"></x-back.new-nav-link> --}}
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Payment Methods" route="admin.payment-methods*" fa_icon="fa-handshake">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.payment-methods.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.payment-methods.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>

    <br>
    <br>


    <li class="nav-header text-underline">Booking Engine</li>
    <x-back.new-nav-link fa_icon="fa-calendar" title="Booking Requests" route="admin.booking-requests.index"></x-back.new-nav-link>
    <x-back.new-nav-link-dropdown title="Packages" route="admin.packages*" fa_icon="fa-box-open">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.packages.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.packages.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Bookings" route="admin.bookings*" fa_icon="fa-calendar-check">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.bookings.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.bookings.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Payments" route="admin.payments*" fa_icon="fa-money-bill-wave">
        <x-back.new-nav-link fa_icon="" title="Booking Payments" route="admin.payments.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create Payment" route="admin.payments.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <br>
    <br>

    <li class="nav-header text-underline">Content Management</li>
    <x-back.new-nav-link fa_icon="fa-file-word" title="Word Content" route="admin.cms.content"></x-back.new-nav-link>
    {{-- <x-back.new-nav-link fa_icon="fa-photo-video" title="Photos" route="admin.cms.photos"></x-back.new-nav-link> --}}

    <x-back.new-nav-link-dropdown title="Gallery" route="admin.gallery*" fa_icon="fa-money-bill-wave">
        <x-back.new-nav-link fa_icon="" title="Photos List" route="admin.gallery.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Add a Photo" route="admin.gallery.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>

    <x-back.new-nav-link fa_icon="fa-question-circle" title="FAQs" route="admin.cms.faq"></x-back.new-nav-link>
    <x-back.new-nav-link-dropdown title="Testimonials" route="admin.testimonials*" fa_icon="fa-money-bill-wave">
        <x-back.new-nav-link fa_icon="" title="Testimonials List" route="admin.testimonials.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create Testimonial" route="admin.testimonials.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>



    <li class="nav-header text-underline">Blog Engine</li>
    <x-back.new-nav-link-dropdown title="Blog Categories" route="admin.post-categories*" fa_icon="fa-layer-group">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.post-categories.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.post-categories.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>
    <x-back.new-nav-link-dropdown title="Blog Posts" route="admin.blog-posts*" fa_icon="fa-rss-square">
        <x-back.new-nav-link fa_icon="" title="Overview" route="admin.blog-posts.index"></x-back.new-nav-link>
        <x-back.new-nav-link fa_icon="" title="Create" route="admin.blog-posts.create"></x-back.new-nav-link>
    </x-back.new-nav-link-dropdown>

    <x-back.new-nav-link fa_icon="fa-comments" title="Comments" route="admin.comments.index"></x-back.new-nav-link>

    <x-back.new-nav-link fa_icon="fa-tag" title="Tags" route="admin.tags.index"></x-back.new-nav-link>

    <br>
    <br>

</ul>
