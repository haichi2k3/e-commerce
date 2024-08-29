@extends('frontend.layouts.app')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post" action="{{ route('member.create') }}" enctype="multipart/form-data">
						@csrf
							<input type="text" placeholder="Full Name" name="name"/>
							@error('name') {{ $message }} @enderror
							<input type="email" placeholder="Email Address" name="email"/>
							@error('email') {{ $message }} @enderror
							<input type="password" placeholder="Password" name="password"/>
                            <input type="password" placeholder="Confirm Password"  name="password_confirmation" >
							@error('password') {{ $message }} @enderror
							<!-- <input type="password" placeholder="Confirm Password" name="password_confirm"/> -->
							<input type="number" placeholder="Phone Number" name="phone"/>
							@error('phone') {{ $message }} @enderror
							<select class="form-control form-control-line" name="select-country" id="select-country">
								@foreach ($country as $value)
								<option value="{{ $value->id }}">
									{{ $value->name }}
								</option>
								@endforeach
							</select>
							@error('select-country') {{ $message }} @enderror
							<input type="file" name="avatar" id="avatar">
							@error('avatar') {{ $message }} @enderror
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection