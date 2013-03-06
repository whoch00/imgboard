<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>@yield('title')</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		{{ Asset::styles() }}

	</head>
	<body>
		<div class="container wrapper">

			@include('board/assets/navbar')

			@yield('content')

			@include('board/assets/footer')

		</div>

		{{ Asset::scripts() }}
	</body>
</html>
@if (Auth::check())
	{{ Anbu::render() }}
@endif