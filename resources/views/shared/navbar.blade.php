<nav>
	<ul>
		<li>
			<a href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
		</li>
		<li>
			<a href="{{ route('search-form') }}"><i class="fa fa-search"></i>Search</a>
		</li>
		<li>
			<span><i class="fa fa-user-circle"></i>Artists</span>
			<ul>
				<li>
					<a href="{{ route('artist.index') }}"><i class="fa fa-list"></i>All artists</a>
				</li>
				<li>
					<a href="{{ route('search-form', ['subject' => 'artists']) }}"><i class="fa fa-search"></i>Search artist</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href="{{ route('artist.create') }}"><i class="fa fa-plus"></i>Add artist</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li>
			<span><i class="fa fa-user-o"></i>People</span>
			<ul>
				<li>
					<a href="{{ route('person.index') }}"><i class="fa fa-list"></i>All people</a>
				</li>
				<li>
					<a href="{{ route('search-form', ['subject' => 'people']) }}"><i class="fa fa-search"></i>Search person</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href="{{ route('person.create') }}"><i class="fa fa-plus"></i>Add person</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-music"></i>Songs</span>
		  <ul>
				<li>
					<a href="{{ route('song.index') }}"><i class="fa fa-list"></i>All songs</a>
				</li>
				<li>
					<a href="{{ route('search-form', ['subject' => 'songs']) }}"><i class="fa fa-search"></i>Search song</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href="{{ route('song.create') }}"><i class="fa fa-plus"></i>Add song</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-cd"></i>Albums</span>
		  <ul>
				<li>
					<a href><i class="fa fa-list"></i>All albums</a>
				</li>
				<li>
					<a href="{{ route('search-form', ['subject' => 'albums']) }}"><i class="fa fa-search"></i>Search album</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href><i class="fa fa-plus"></i>Add album</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li class="d-none">
		  <span><i class="fa fa-bar-chart"></i>Charts</span>
		  <ul>
				<li>
					<a href><i class="fa fa-list"></i>List</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href><i class="fa fa-plus"></i>Create a chart</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-medium"></i>Manage media</span>
		  <ul>
				<li>
					<a href="{{ route('mediumtypes.index') }}"><i class="fa fa-list"></i>All media</a>
				</li>
        @if(Auth::check())
  				<li>
  					<a href="{{ route('mediumtypes.create') }}"><i class="fa fa-plus"></i>Add medium</a>
  				</li>
        @endif
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-user"></i>Account</span>
		  <ul>
			@if(Auth::check())
				<li>
  				<form action="{{ route('logout') }}" method="POST">
  					{{ csrf_field() }}
  					<button type="submit"><i class="fa fa-sign-out"></i>Logout</button>
  				</form>
				</li>
			@else
				<li>
					<a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>Login</a>
				</li>
				<li>
					<a href="{{ route('register') }}"><i class="fa fa-user-plus"></i>Register</a>
				</li>
			@endif
			</ul>
		</li>
		<li>
			<a href><i class="fa fa-info"></i>Contact</a>
		</li>
	</ul>
</nav>