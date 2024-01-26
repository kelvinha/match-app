<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Match Web App <small>v.1</small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('member/*')) ? 'active' : '' }}" href="{{ route('member.index') }}">Member</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('match/team/*')) ? 'active' : '' }}" href="{{ route('match.team.index') }}">Match Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('match/tunggal/*')) ? 'active' : '' }}" href="{{ route('match.individu.index') }}">Match Tunggal</a>
                </li>
            </ul>
        </div>
    </div>
</nav>