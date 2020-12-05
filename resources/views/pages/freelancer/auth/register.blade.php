@extends('layouts.auth')

@section('title')
    {{ trans('texts.auth.sign-in-freelancer-page-title') }}
@endsection

@section('auth-content')
    <x-forms.auth.sign-up-freelancer/>

    <br>
    <p>
        {{ trans('texts.auth.already-have-account') }}
        <a href="{{ route('freelancer.auth.login') }}">{{ trans('texts.auth.sign-in-base') }}</a>
    </p>
@overwrite
