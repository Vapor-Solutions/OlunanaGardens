@if (auth()->user()->is_admin)
    <x-back.admin-links></x-back.admin-links>
@elseif (auth()->user()->is_employee)
    <x-back.client-links></x-back.client-links>
@endif
<br>
<br>
<br>
<x-back.application-logo class="img-fluid w-50"/>
<br>
