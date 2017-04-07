
@if( ! $partners->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('partner::partner_admin.order') }}</td>
            <th style='width:10%'>Partner ID</th>
            <th style='width:30%'>Partner Name</th>
            <th style='width:50%'>Partner Images</th>
             <th style='width:50%'>Partner Title</th>
            

            <th style='width:20%'>{{ trans('partner::partner_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nav = $partners->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($partners as $partner)
        <tr>
            <td>
                <?php echo $counter;
                $counter++ ?>
            </td>
            <td>{!! $partner->partner_id !!}</td>
            <td>{!! $partner->partner_name !!}</td>
            <td>{!! $partner->partner_img !!}</td>
            <td>{!! $partner->partner_title !!}</td>
            
            <td>
                <a href="{!! URL::route('admin_partner.edit', ['id' => $partner->partner_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_partner.delete',['id' =>  $partner->partner_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<span class="text-warning">
    <h5>
        {{ trans('partner::partner_admin.message_find_failed') }}
    </h5>
</span>
@endif
<div class="paginator">
    {!! $partners->appends($request->except(['page']) )->render() !!}
</div>