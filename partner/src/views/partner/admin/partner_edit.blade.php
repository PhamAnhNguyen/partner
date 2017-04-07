@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: {{ trans('partner::partner_admin.page_edit') }}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!! !empty($partner->partner_id) ? '<i class="fa fa-pencil"></i>'.trans('partner::partner_admin.form_edit') : '<i class="fa fa-users"></i>'.trans('partner::partner_admin.form_add') !!}
                    </h3>
                </div>

                {{-- model general errors from the form --}}
                @if($errors->has('partner_img') )
                <div class="alert alert-danger">{!! $errors->first('partner_img') !!}</div>
                @endif
                @if($errors->has('partner_name') )
                <div class="alert alert-danger">{!! $errors->first('partner_name') !!}</div>
                @endif
                
                @if($errors->has('partner_title') )
                <div class="alert alert-danger">{!! $errors->first('partner_title') !!}</div>
                @endif

                @if($errors->has('img_unvalid_length') )
                <div class="alert alert-danger">{!! $errors->first('img_unvalid_length') !!}</div>
                @endif

                {{-- successful message --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{{$message}}</div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <h4>{!! trans('partner::partner_admin.form_heading') !!}</h4>
                            {!! Form::open(['route'=>['admin_partner.post', 'id' => @$partner->partner_id],  'files'=>true, 'method' => 'post'])  !!}


                            <!-- SAMPLE NAME TEXT-->
                            @include('partner::partner.elements.text', ['img' => 'partner_img','name' => 'partner_name','title' => 'partner_title'])
                            <!-- /END SAMPLE NAME TEXT -->
                            {!! Form::hidden('id',@$partner->partner_id) !!}

                            <!-- DELETE BUTTON -->
                            <a href="{!! URL::route('admin_partner.delete',['id' => @$partner->id, '_token' => csrf_token()]) !!}"
                               class="btn btn-danger pull-right margin-left-5 delete">
                                Delete
                            </a>
                            <!-- DELETE BUTTON -->

                            <!-- SAVE BUTTON -->
                            {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                            <!-- /SAVE BUTTON -->

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop