<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Astro Space</title>

    <!-- Bootstrap -->
    @if (Auth::check())
      {{ HTML::style('css/bootstrap-'.Auth::user()->theme.'.min.css') }}
    @else
      {{ HTML::style('css/bootstrap-default.min.css') }}
    @endif
    {{ HTML::style('css/starter-template.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('js/jquery.js') }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('js/bootstrap.min.js') }}
    
    @yield('header')
  </head>

	<body>
		<hr/>
		<small>No ads. Advertise with us?</small>
	</body>
</html>