<nav class="fancy-scroll">
	<ul>
		<li>
			<a href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
		</li>
		<li>
			<span><i class="fa fa-user-circle"></i>Artists</span>
			<ul>
				<li>
					<a href="{{ route('artist.index') }}"><i class="fa fa-list"></i>All artists</a>
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
          <a href="{{ route('profile.likes') }}"><i class="fa fa-heart"></i>Likes</a>
        </li>
        <li>
          <a href="{{ route('profile.index') }}"><i class="fa fa-user-o"></i>Profile</a>
        </li>
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
			<a href="{{ route('about.index') }}"><i class="fa fa-info"></i>About/Contact</a>
		</li>
		<li>
			<a href="{{ route('about.api') }}"><i class="fa fa-code"></i>API access</a>
		</li>
	</ul>
</nav>