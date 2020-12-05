@extends('layouts.auth')

@section('title')
    {{ trans('texts.auth.sign-up-page-title') }}
@endsection

@section('auth-content')
    <x-forms.auth.sign-up-client/>

    <br>
    <p>
        {{ trans('texts.auth.already-have-account') }}
        <a href="{{ route('customer.auth.login') }}">{{ trans('texts.auth.sign-in-base') }}</a>
    </p>
@overwrite
