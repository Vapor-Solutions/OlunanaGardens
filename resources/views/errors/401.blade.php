@extends('errors::layout')

@section('title', 'Unauthorized')
@section('code', '401')
@section('illustration', '🔐')
@section('subtitle', 'Authentication required')
@section('message', 'You need to be logged in to access this page. Please log in with your credentials to continue.')
