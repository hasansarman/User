@extends('layouts.account')
@section('title')
    {{ trans('user::auth.register') }} | @parent
@stop

@section('content')
    <div class="register-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">{{ trans('user::auth.register') }}</p>

        {!! Form::open(['route' => 'register.post']) !!}
            <div class="form-group has-feedback {{ $errors->has('EMAIL') ? ' has-error has-feedback' : '' }}">
                <input type="EMAIL" name="EMAIL" class="form-control" autofocus
                       placeholder="{{ trans('user::auth.email') }}" value="{{ old('EMAIL') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('EMAIL', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('PASSWORD') ? ' has-error has-feedback' : '' }}">
                <input type="PASSWORD" name="PASSWORD" class="form-control" placeholder="{{ trans('user::auth.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                {!! $errors->first('PASSWORD', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group has-feedback {{ $errors->has('PASSWORD_CONFIRMATION') ? ' has-error has-feedback' : '' }}">
                <input type="PASSWORD" name="PASSWORD_CONFIRMATION" class="form-control" placeholder="{{ trans('user::auth.password confirmation') }}">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                {!! $errors->first('PASSWORD_CONFIRMATION', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('user::auth.register me') }}</button>
                </div>
            </div>
        {!! Form::close() !!}

        <a href="{{ route('login') }}" class="text-center">{{ trans('user::auth.I already have a membership') }}</a>
    </div>
@stop
