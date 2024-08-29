@extends('frontend.layouts.app')
@section('content')
            <section id="form "><!--form-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="signup-form  account-form"><!--sign up form-->
                                <h2>User Update!</h2>
                                <form method="post" action="{{ route('account.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <input type="text" placeholder="Full Name" name="name" value="{{ Auth::user()->name }}"/>
                                    @error('name') {{ $message }} @enderror
                                    <input type="email" placeholder="Email Address" name="email" value="{{ Auth::user()->email }}"/>
                                    @error('email') {{ $message }} @enderror
                                    <input type="password" placeholder="Password" name="password" value="{{ old('password') }}"/>
                                    @error('password') {{ $message }} @enderror
                                    <!-- <input type="password" placeholder="Confirm Password" name="password_confirm"/> -->
                                    <input type="number" placeholder="Phone Number" name="phone" value="{{ Auth::user()->phone }}"/>
                                    @error('phone') {{ $message }} @enderror
                                    <select class="form-control form-control-line" name="select-country" id="select-country">
                                        @foreach ($country as $value)
                                        <option value="{{ $value->id }}" @if ($value->id == Auth::user()->id_country) selected @endif>
                                            {{ $value->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <input type="file" name="avatar" id="avatar">
                                    <button type="submit" class="btn btn-default">Save</button>
                                </form>
                            </div><!--/sign up form-->
                        </div>
                    </div>
                </div>
            </section><!--/form-->
@endsection