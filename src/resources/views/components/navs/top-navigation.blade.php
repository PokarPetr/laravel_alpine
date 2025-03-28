<nav class="top-navigation">
    <a href="{{ route('home')}}" class="logo">
        <span><!-- SVG --></span>        
        <span>TicketBooking</span>
    </a>
    {{-- <a href="#"></a>
    @if($user)
        <a href="/profile" class="nav-link">{{ $user->name }}</a>
    @else 
        <a href="/login" class="nav-link">Login</a>
    @endif
    <a href="{{ route('flight-available-list') }}" class="nav-link">Support</a> --}}
</nav>

<style>
    .top-navigation {
        display: grid;
        grid-template-columns: 150px 1fr repeat(3, 80px);
        gap: 3px;
        align-items: center;
        padding: 0 15px;
        margin-top: 7px;
        margin-bottom: 15px;
    }

    .logo span:first-child {
    }

    .nav-link {
        text-decoration: none;
        color: inherit; 
    }

    .nav-link:hover {
        text-decoration: underline;
    }
</style>
