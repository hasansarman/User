@extends('layouts.master')

@section('content-header')
<h1>
    {{ trans('user::users.title.edit-user') }} <small>{{ $user->present()->fullname() }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li class=""><a href="{{ URL::route('admin.user.user.index') }}">{{ trans('user::users.breadcrumb.users') }}</a></li>
    <li class="active">{{ trans('user::users.breadcrumb.edit-user') }}</li>
</ol>
@stop

@section('content')
{!! Form::open(['route' => ['admin.user.user.update', $user->ID], 'method' => 'put']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">{{ trans('user::users.tabs.data') }}</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">{{ trans('user::users.tabs.roles') }}</a></li>
                <li class=""><a href="#tab_3-3" data-toggle="tab">{{ trans('user::users.tabs.permissions') }}</a></li>
                <li class=""><a href="#password_tab" data-toggle="tab">{{ trans('user::users.tabs.new password') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('FIRST_NAME') ? ' has-error' : '' }}">
                                    {!! Form::label('FIRST_NAME', trans('user::users.form.first-name')) !!}
                                    {!! Form::text('FIRST_NAME', Input::old('first_name', $user->FIRST_NAME), ['class' => 'form-control', 'placeholder' => trans('user::users.form.first-name')]) !!}
                                    {!! $errors->first('FIRST_NAME', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('LAST_NAME') ? ' has-error' : '' }}">
                                    {!! Form::label('LAST_NAME', trans('user::users.form.last-name')) !!}
                                    {!! Form::text('LAST_NAME', Input::old('last_name', $user->LAST_NAME), ['class' => 'form-control', 'placeholder' => trans('user::users.form.last-name')]) !!}
                                    {!! $errors->first('LAST_NAME', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group{{ $errors->has('EMAIL') ? ' has-error' : '' }}">
                                    {!! Form::label('EMAIL', trans('user::users.form.email')) !!}
                                    {!! Form::email('EMAIL', Input::old('email', $user->EMAIL), ['class' => 'form-control', 'placeholder' => trans('user::users.form.email')]) !!}
                                    {!! $errors->first('EMAIL', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="checkbox{{ $errors->has('ACTIVATED') ? ' has-error' : '' }}">
                                    <input type="hidden" value="{{ $user->ID === $currentUser->ID ? '1' : '0' }}" name="ACTIVATED"/>
                                    <?php $oldValue = (bool) $user->isActivated() ? 'checked' : ''; ?>
                                    <label for="ACTIVATED">
                                        <input id="ACTIVATED"
                                               name="ACTIVATED"
                                               type="checkbox"
                                               class="flat-blue"
                                               {{ $user->ID === $currentUser->ID ? 'disabled' : '' }}
                                               {{ Input::old('ACTIVATED', $oldValue) }}
                                               value="1" />
                                        {{ trans('user::users.form.is activated') }}
                                        {!! $errors->first('activated', '<span class="help-block">:message</span>') !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('user::users.tabs.roles') }}</label>
                                <select multiple="" class="form-control" name="roles[]">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="{{ $role->id }}" <?php echo $user->hasRoleId($role->ID) ? 'selected' : '' ?>>{{ $role->NAME }}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3-3">
                    @include('user::admin.partials.permissions', ['model' => $user])
                </div>
                <div class="tab-pane" id="password_tab">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{ trans('user::users.new password setup') }}</h4>
                                <div class="form-group{{ $errors->has('PASSWORD') ? ' has-error' : '' }}">
                                    {!! Form::label('PASSWORD', trans('user::users.form.new password')) !!}
                                    {!! Form::input('PASSWORD', 'PASSWORD', '', ['class' => 'form-control']) !!}
                                    {!! $errors->first('PASSWORD', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group{{ $errors->has('PASSWORD_CONFIRMATION') ? ' has-error' : '' }}">
                                    {!! Form::label('PASSWORD_CONFIRMATION', trans('user::users.form.new password confirmation')) !!}
                                    {!! Form::input('PASSWORD', 'PASSWORD_CONFIRMATION', '', ['class' => 'form-control']) !!}
                                    {!! $errors->first('PASSWORD_CONFIRMATION', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>{{ trans('user::users.tabs.or send reset password mail') }}</h4>
                                <a href="{{ route("admin.user.user.sendResetPassword", $user->id) }}" class="btn btn-flat bg-maroon">
                                    {{ trans('user::users.send reset password email') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('user::button.update') }}</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">{{ trans('core::core.button.reset') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.user.user.index')}}"><i class="fa fa-times"></i> {{ trans('user::button.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('user::users.navigation.back to index') }}</dd>
    </dl>
@stop
@section('scripts')
<script>
$( document ).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    $(document).keypressAction({
        actions: [
            { key: 'b', route: "<?= route('admin.user.role.index') ?>" }
        ]
    });
    $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });
});
</script>
@stop
