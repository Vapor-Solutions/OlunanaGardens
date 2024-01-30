@extends('errors::minimal')

@section('title', __('Maintenance Mode'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'The Site is currently on Maintenance'))
