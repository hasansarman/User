@extends('layouts.account')

@section('title')
    {{ trans('user::auth.reset password') }} | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ setting('core::site-name') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ trans('user::auth.to reset password complete this form') }}</p>
        @include('flash::message')

        {!! Form::open(['route' => 'reset.post']) !!}
            <div class="form-group has-feedback {{ $errors->has('EMAIL') ? ' has-error' : '' }}">
                <input type="EMAIL" class="form-control" autofocus
                       name="EMAIL" placeholder="{{ trans('user::auth.email') }}" value="{{ old('EMAIL')}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                {!! $errors->first('EMAIL', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">
                        {{ trans('user::auth.reset password') }}
                    </button>
                </div>
            </div>
        {!! Form::close() !!}

        <a href="{{ route('login') }}" class="text-center">{{ trans('user::auth.I remembered my password') }}</a>
    </div>
@stop
