@extends('errors::layout')

@section('title', 'Too Many Requests')
@section('code', '429')
@section('illustration', '⚡')
@section('subtitle', 'You\'ve made too many requests')
@section('message', 'You\'ve exceeded the rate limit for this resource. Please wait a moment and try again. This helps us maintain service quality for all users.')
