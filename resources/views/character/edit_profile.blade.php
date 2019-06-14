@extends('character.layout')

@section('profile-title') Editing {{ $character->fullName }}'s Profile @endsection

@section('profile-content')
{!! breadcrumbs(['Masterlist' => 'masterlist', $character->fullName => $character->url, 'Editing Profile' => $character->url . '/profile/edit']) !!}

@include('character._header', ['character' => $character])

@if($character->user_id != Auth::user()->id)
    <div class="alert alert-warning">
        You are editing this character as a staff member.
    </div>
@endif

{!! Form::open(['url' => $character->url . '/profile/edit']) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $character->name, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('text', 'Profile Content') !!}
    {!! Form::textarea('text', $character->profile->text, ['class' => 'wysiwyg form-control']) !!}
</div>

@if($character->user_id == Auth::user()->id)
    <div class="form-group">
        {!! Form::checkbox('is_gift_art_allowed', 1, $character->is_gift_art_allowed, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
        {!! Form::label('is_gift_art_allowed', 'Allow Gift Art', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This will place the character on the list of characters that can be drawn for gift art. This does not have any other functionality, but allow users looking for characters to draw to find your character easily.') !!}
    </div>
    <div class="form-group">
        {!! Form::checkbox('is_trading', 1, $character->is_trading, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
        {!! Form::label('is_trading', 'Up For Trade', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This will place the character on the list of characters that are currently up for trade. This does not have any other functionality, but allow users looking for trades to find your character easily.') !!}
    </div>
@endif
@if($character->user_id != Auth::user()->id)
    <div class="form-group">
        {!! Form::checkbox('alert_user', 1, true, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'data-onstyle' => 'danger']) !!}
        {!! Form::label('alert_user', 'Notify User', ['class' => 'form-check-label ml-3']) !!} {!! add_help('This will send a notification to the user that their character profile has been edited. A notification will not be sent if the character is not visible.') !!}
    </div>
@endif
<div class="text-right">
    {!! Form::submit('Edit Profile', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@endsection