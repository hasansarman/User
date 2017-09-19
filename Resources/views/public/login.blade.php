@extends('layouts.account')

@section('title')
    {{ trans('user::auth.login') }} | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('user::auth.sign in welcome message') }}</p>
        @include('flash::message')

        {!! Form::open(['route' => 'login.post']) !!}
            <div class="form-group has-feedback {{ $errors->has('EMAIL') ? ' has-error' : '' }}">
                <input type="EMAIL" class="form-control" autofocus
                       name="EMAIL" placeholder="{{ trans('user::auth.email') }}" value="{{ old('EMAIL')}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('EMAIL', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('PASSWORD') ? ' has-error' : '' }}">
                <input type="PASSWORD" class="form-control"
                       name="PASSWORD" placeholder="{{ trans('user::auth.password') }}" value="{{ old('PASSWORD')}}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('PASSWORD', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> {{ trans('user::auth.remember me') }}
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        {{ trans('user::auth.login') }}
                    </button>
                </div>
            </div>
        </form>

        <a href="{{ route('reset')}}">{{ trans('user::auth.forgot password') }}</a><br>
        @if (config('asgard.user.users.allow_user_registration'))
            <a href="{{ route('register')}}" class="text-center">{{ trans('user::auth.register')}}</a>
        @endif
    </div>
@stop
