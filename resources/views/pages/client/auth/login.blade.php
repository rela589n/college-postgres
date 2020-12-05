@extends('layouts.auth')

@section('title')
    {{ trans('texts.auth.sign-in-page-title') }}
@endsection

@section('auth-content')
    <x-forms.auth.sign-in-client/>

    <br>
    <p>
        {{ trans('texts.auth.have-no-account') }}
        <a href="{{ route('customer.auth.register') }}">{{ trans('texts.auth.sign-up-base') }}</a>
    </p>
@overwrite
