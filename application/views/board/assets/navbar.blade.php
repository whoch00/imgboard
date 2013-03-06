<div class="navbar">
	<span class="float-right">
		[ {{ HTML::link('/', 'Inicio') }} 
		@if (Auth::check()) 
			/
			{{ HTML::link_to_route('manage', 'Manage') }} /
			Denuncias (2) / 
			{{ HTML::link_to_route('logout', 'Logout') }}
		@endif
		]
	</span>
	<span>
	<?php 
		$boards = Board::all();
	?>
	[
	@foreach ($boards as $board)
		{{ HTML::link_to_route('board', $board->directory, array($board->directory)) }}
	@endforeach
	]
	</span>
</div>