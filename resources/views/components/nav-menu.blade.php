<nav class="side-nav">
    @if (auth()->user()->role === 'hc')
        <p class="nav-label">HUMAN CAPITAL</p>
        <a class="{{ request()->routeIs('hc.dashboard') ? 'active' : '' }}" href="{{ route('hc.dashboard') }}">▦
            Dashboard</a>
        <a class="{{ request()->routeIs('hc.reviews') ? 'active' : '' }}" href="{{ route('hc.reviews') }}">◎ Performance
            Review</a>
        <a class="{{ request()->routeIs('hc.programs') ? 'active' : '' }}" href="{{ route('hc.programs') }}">▣ Development
            Program</a>
        <a href="{{ route('hc.dashboard') }}#employees">♙ Employee</a>
        <a href="{{ route('hc.dashboard') }}#gaps">◈ IDP Monitoring</a>
    @else
        <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">▦ Dashboard</a>
        <a class="{{ request()->routeIs('career') ? 'active' : '' }}" href="{{ route('career') }}">◉ Career
            Profile &amp; Review</a>
        @if (auth()->user()->managedEmployees()->exists())
            <a class="{{ request()->routeIs('team*') ? 'active' : '' }}" href="{{ route('team') }}">♙ Employee &amp; Review</a>
        @endif
        <a class="{{ request()->routeIs('competencies') ? 'active' : '' }}" href="{{ route('competencies') }}">◈
            Aspirasi &amp; Gap</a>
        <a class="{{ request()->routeIs('plan') ? 'active' : '' }}" href="{{ route('plan') }}">✓ Development Program</a>
        <a class="{{ request()->routeIs('history') || request()->routeIs('progress') ? 'active' : '' }}" href="{{ route('history') }}">↗ Histori kegiatan</a>
    @endif
</nav>
