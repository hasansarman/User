@extends('layouts.account')

@section('title')
    {{ trans('user::auth.reset password') }} | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('user::auth.reset password') }}</p>
        @include('flash::message')

        {!! Form::open() !!}
        <div class="form-group has-feedback {{ $errors->has('PASSWORD') ? ' has-error' : '' }}">
            <input type="PASSWORD" class="form-control" autofocus
                   name="PASSWORD" placeholder="{{ trans('user::auth.password') }}">
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
                <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">
                    {{ trans('user::auth.reset password') }}
                </button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop
