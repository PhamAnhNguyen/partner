{!! Form::open(['route'=>['partner.post', 'id' => @$partner->partner_id],  'files'=>true, 'method' => 'post'])  !!}
<!--END POST ID  -->
<!-- SAMPLE NAME TEXT-->
@include('partner::partner.elements.text', ['title' => 'partner_title',
'img' => 'partner_img','name' => 'partner_name'])
<!-- /END SAMPLE NAME TEXT -->
{!! Form::hidden('id',@$partner->partner_id) !!}

<!-- DELETE BUTTON -->

<!-- DELETE BUTTON -->

<!-- SAVE BUTTON -->
{!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
<!-- /SAVE BUTTON -->

{!! Form::close() !!}