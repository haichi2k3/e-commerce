@extends('frontend.layouts.app')
@section('content')
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{ route('member.login') }}" method="post">
							
							@csrf
							<input type="email" placeholder="Email Address" name="email" />
							@error('email') {{ $message }} @enderror

							<input type="password" placeholder="Password" name="password"/>
							@error('password') {{ $message }} @enderror
							<br/>
							<span>
								<input type="checkbox" class="checkbox" name="remember_me"> 
								Keep me signed in
							</span>
							@if($errors->has('login')) <br/> {{ $errors->first('login') }} @endif
							<button type="submit" class="btn btn-default" name="login">Login</button>
						</form>  
					</div><!--/login form-->
				</div>
			</div>
		</div>
</section><!--/form-->
@endsection
