<li class='nav-item'>
    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href='{{ route('home') }}'>Home </a>
</li>
<li class='nav-item'>
    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
</li>
{{-- <li class='nav-item'>
            <a class="nav-link {{ Request::is('/garden-sections') ? 'active' : '' }}" href='{{ route('garden-sections') }}'>
                Garden Sections
            </a>
        </li> --}}
<li class='nav-item'>
    <a class="nav-link {{ Request::is('restaurant') ? 'active' : '' }}" href="{{ route('restaurant') }}">Restaurant</a>
</li>
<li class='nav-item'>
    <a class="nav-link {{ Request::is('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Our Blog</a>
</li>
<li class='nav-item'>
    <a class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}" href="{{ route('contact-us') }}">Contact Us</a>
</li>
