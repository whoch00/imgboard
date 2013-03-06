@layout('base')

@section('title')
	Login
@endsection

@section('content')
	<div class="header">
		<h1>Login</h1>
	</div>
	<div class="post-form">
		{{ Form::open() }}
		<table>
			@if (Session::has('errors'))
				<tr>
					<td colspan="2" class="alert alert-error">
						{{ Session::get('errors') }}
					</td>
				</tr>
			@endif
			<tr>
				<th>{{ Form::label('user', 'Usuário:') }}</th>
				<td>{{ Form::text('username') }}
			</tr>
			<tr>
				<th>{{ Form::label('password', 'Senha:') }}</th>
				<td>{{ Form::password('password') }}
			</tr>
			<tr>
				<td colspan="2" class="center">
					{{ Form::token() }}
					{{ Form::submit('Login') }}
				</td>
			</tr>
		</table>
	</div>
@endsection