@layout('base')

@section('title')
	/{{ $board->directory }}/ - {{ $board->description }}
@endsection

@section('content')
	@include('board/assets/header')

	@include('board/assets/post-form')

	@include('board/assets/post-area')

	@include('board/assets/post-extras')
@endsection