<nav class="cappa-menu">
    <ul>
        <li class=''>
            <a class="{{ Request::is('/') ? 'active' : '' }}" href='{{ route('home') }}'>Home </a>
        </li>
        <li class=''>
            <a class="{{ Request::is('/about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
        </li>
        <li class=''>
            <a class="{{ Request::is('/garden-sections') ? 'active' : '' }}" href='{{ route('garden-sections') }}'>
                Garden Sections
            </a>
        </li>
        <li class=''>
            <a class="{{ Request::is('/restaurant') ? 'active' : '' }}" href="{{ route('restaurant') }}">Restaurant</a>
        </li>
        <li class=''>
            <a class="{{ Request::is('/blog') ? 'active' : '' }}" href="{{ route('blog') }}">Our Blog</a>
        </li>
        <li class=''>
            <a class="{{ Request::is('/contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Our Blog</a>
        </li>

    </ul>
</nav>
