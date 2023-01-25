<div>
    @if (auth()->user()->role == 'administrator')
        {{-- maintance --}}


    @else
        {{-- Production --}}


    @endif
</div>
