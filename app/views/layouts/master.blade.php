<!DOCTYPE html>
<?php Session::put('current_url', URL::full()); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Astro Space</title>

    <!-- Bootstrap -->
    @if (Auth::check())
      {{ HTML::style('css/bootstrap-'.Auth::user()->theme.'.min.css', array('id'=>'theme_css')) }}
    @else
      {{ HTML::style('css/bootstrap-default.min.css', array('id'=>'theme_css')) }}
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
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ HTML::link('/', 'AstroSpaces', array('class' => 'navbar-brand')) }}
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
    			 	@if(Auth::check())
    				  <li>{{ HTML::link('spaces/'.Auth::user()->id, 'Home') }}</li>
              <li>{{ HTML::link('messages/', 'Messages') }}</li>
              <li>{{ HTML::link('notifications/', "Notifications")}} </li>
    				@endif
            <li>{{ HTML::link('users', 'Memberlist') }}</li>
				<li>{{ HTML::link('users/search', 'User Search')}}</li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>{{ HTML::link('themes/'.(Auth::user()->id).'/edit', "Edit themes") }}</li>
                  <li>{{ HTML::link('statistics/show', 'Show web statistic') }} </li>
						      <li>{{ HTML::link('users/changepassword', 'Change password') }}</li>
                  @if (Auth::user()->role == 'admin')
      						  <li>{{ HTML::link('admin/', 'Admin area') }} </li>
      					  @endif
                </ul>
              </li>
              <li>{{ HTML::link('users/logout', 'Log out '.e(Auth::user()->username))}}</li>
            @else
              <li>{{ HTML::link('users/register', 'Register') }} </li>
              <li>{{ HTML::link('users/login', 'Log in') }} </li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" style="margin-top:10px">
        <div class="row" id="messageDiv">
      @if(Session::has('message'))
          <p class="alert alert-info" id="messageP">{{ Session::get('message') }}</p>
      @endif
        </div>
        <div class="row" id="warningDiv">
      @if(Session::has('warning'))
          <p class="alert alert-danger" id="warningP">{{ Session::get('warning') }}</p>
      @endif
        </div>

      @yield('content')
    </div><!-- /.container -->
	
	@if( !isset($no_ads) || $no_ads == 0)
	<div id="astrospace_ads" class="container ads" style="overflow: hidden; width:800px; height:600px;">

		<iframe style="height:600px; width:800px" src="{{ URL::to('ads/bottom') }}" width="800" height="600" scrolling="no" frameborder="0" style="overflow: hidden;"></iframe>
	</div><!-- astrospace_ads -->
	@endif
  </body>
</html>
