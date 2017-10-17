<nav>
	<ul>
		<li>
			<a href="{{ route('home.index') }}"><i class="fa fa-home"></i>Home</a>
		</li>
		<li>
			<a href="{{ route('search-all') }}"><i class="fa fa-search"></i>Search</a>
		</li>
		<li>
			<span><i class="fa fa-user-circle"></i>Artists</span>
			<ul>
			<li>
				<a href="{{ route('artist.index') }}"><i class="fa fa-list"></i>All artists</a>
			</li>
			<li>
				<a href="{{ route('search-artist') }}"><i class="fa fa-search"></i>Search artist</a>
			</li>
			<li>
				<a href="{{ route('artist.create') }}"><i class="fa fa-plus"></i>Add artist</a>
			</li>
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-music"></i>Songs</span>
		  <ul>
			<li>
				<a href><i class="fa fa-list"></i>All songs</a>
			</li>
			<li>
				<a href="{{ route('search-song') }}"><i class="fa fa-search"></i>Search song</a>
			</li>
			<li>
				<a href><i class="fa fa-plus"></i>Add song</a>
			</li>
		  </ul>
		</li>
		<li>
		  <span><i class="fa fa-cd"></i>Albums</span>
		  <ul>
			<li>
				<a href><i class="fa fa-list"></i>All albums</a>
			</li>
			<li>
				<a href="{{ route('search-album') }}"><i class="fa fa-search"></i>Search album</a>
			</li>
			<li>
				<a href><i class="fa fa-plus"></i>Add album</a>
			</li>
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