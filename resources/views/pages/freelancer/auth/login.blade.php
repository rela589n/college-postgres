@extends('layouts.auth')

@section('title')
    {{ trans('texts.auth.sign-in-page-title') }}
@endsection

@section('auth-content')
    <x-forms.auth.sign-in-freelancer/>

    <br>
    <p>
        {{ trans('texts.auth.have-no-account') }}
        <a href="{{ route('freelancer.auth.register') }}">{{ trans('texts.auth.sign-up-base') }}</a>
    </p>
@overwrite
