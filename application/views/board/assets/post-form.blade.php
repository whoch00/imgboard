<div class="post-form">
	{{ Form::open_for_files('post') }}
	<table>
		@if (Session::has('errors'))
		<tr>
			<td colspan="2" class="alert alert-error">
				{{ HTML::ul($errors); }}
			</td>
		@endif
		<tr>
			<th>{{ Form::label('name', 'Nome:') }}</th>
			<td>{{ Form::text('name') }}</td>
		</tr>
		<tr>
			<th>{{ Form::label('email', 'E-Mail:') }}</th>
			<td>{{ Form::text('email') }}</td>
		</tr>
		<tr>
			<th>{{ Form::label('subject', 'Assunto:') }}</th>
			<td>{{ Form::text('subject') }} {{ Form::submit('Enviar') }}</td>
		</tr>
		<tr>
			<th>{{ Form::label('message', 'Menssagem:') }}</th>
			<td>{{ Form::textarea('message', '', array('rows' => 5, 'cols' => 50)) }}</td>
		</tr>
		<tr>
			<th>{{ Form::label('file', 'Arquivo:') }}</th>
			<td>{{ Form::file('file') }}</td>
		</tr>
		<tr>
			<th>{{ Form::label('password', 'Senha:') }}</th>
			<td>{{ Form::password('password') }}</td>
		</tr>
	</table>
	{{ Form::hidden('board_id', 1) }}
	{{ Form::hidden('parent_id', 0) }}
	{{ Form::token() }}
	{{ Form::close() }}
</div>