<nav class="cappa-menu">
    <ul>
        <li class='cappa-menu-sub'>
            <a class="{{ Request::is('/') ? 'active' : '' }}" href='{{ route('home') }}'>Home </a>
        </li>
        <li class='cappa-menu-sub'>
            <a class="{{ Request::is('/about') ? 'active' : '' }}" href="about.html">About</a>
        </li>
        <li class='cappa-menu-sub'>
            <a href='#'>Garden Sections </a>
        </li>
        <li>
            <a href="restaurant.html">Restaurant</a>
        </li>
        <li>
            <a href="spa-wellness.html">Spa Wellness</a>
        </li>
        <li class="cappa-menu-sub">
            <a href='#'>Pages </a>
        </li>
        <li class='cappa-menu-sub'>
            <a href='#'>News </a>
        </li>
        <li><a href="contact.html">Contact</a></li>
    </ul>
</nav>
