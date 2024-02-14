<small>
    @for ($i = 0; $i < $count; $i++)
        @if ($count >= $i && $count < $i + 1)
            <i class="star"></i>
        @else
            <i class="star-rating"></i>
        @endif
    @endfor

</small>
