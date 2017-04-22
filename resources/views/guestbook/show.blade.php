@extends('app')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        
        <div class="mb-2x">
            
            @include('general.error')
            
            <h3><i class="fa fa-pencil"></i> @lang('keys.addMessage')</h3>
            
            <form action="/guestbook/add" method="post" class="form-horizontal">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label">@lang('keys.name')</label>

                    <div class="col-md-6">
                        <input type="text" name="name" placeholder="Your name" size="30" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">@lang('keys.phoneNumber')</label>

                    <div class="col-md-6">
                        <input type="text" name="phoneNumber" placeholder="Your phone number" size="30" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">@lang('keys.message')</label>

                    <div class="col-md-6">
                        <textarea name="message" cols="40"  rows="5" placeholder="Your message here..." required></textarea>
                        <div class="small mb-2x">
                            @lang('keys.allowedTags', ['tags' => '&ltb&gt, &lti&gt, &ltu&gt, &ltbr&gt'])
                        </div>
                    </div>
                </div>
                
                <div class="form-group text-center">
                    <input type="submit" name="send" value="Add message" class="btn btn-primary" />    
                </div>
                
            </form>
        </div>
        
        <hr>
        
        <h3><i class="fa fa-book"></i> @lang('keys.guestbook')</h3>
        
        @if( ! empty($list['data']) )
            <table class="table table-striped table-responsive">
                <thead>
                </thead>
                <tbody>
                    @foreach( $list['data'] as $item )
                        <tr>
                            <td style="width: 30%;">
                                <strong>{{ $item['name'] }}</strong> <br><span style="font-size: 80%;">{{ $item['created_at'] }}</span>
                            </td>
                            <td style="width: 70%;">{!! html_entity_decode($item['message']) !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @lang('keys.noEntries')
        @endif
        
    </div>
</div>

@endsection