@extends('app')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        
        <div class="mb-2x">
            
            @include('general.error')
            
            <h3 class="mb-2x">@lang('keys.about')</h3>
            
            <div>
                <ul class="about-list">
                    <li>The target is to implement a simple guest book on one page, that consists of a form and a table.</li>
                    <li>In the form, the user should fill his name, phone number and the message.</li>
                    <li>Phone number has to be valid Slovak phone number.</li>
                    <li>After the submit, the message is recorded into database with the current date.</li>
                    <li>All inputs should be validated so the guest book can be used in the external environment.</li>
                </ul>
            </div>
            
        </div>
        
    </div>
</div>

@endsection