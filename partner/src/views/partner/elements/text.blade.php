<head>
    <script src='//cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: 'textarea', // change this value according to your HTML
            plugin: 'a_tinymce_plugin',
            a_plugin_option: true,
            a_configuration_option: 400
        });

    </script>
</head>

<!-- SAMPLE NAME -->
<div class="form-group">

     <?php $partner_title = @$request->get('partner_title') ? @$request->get('partner_title') : @$partner->partner_title ?>
    {!! Form::label($title, trans('partner::partner_admin.title').':') !!}
    {!! Form::text($title, $partner_title, ['class' => 'form-control', 'placeholder' => trans('partner::partner_admin.title').'']) !!}   

    <?php $partner_name = @$request->get('partner_name') ? @$request->get('partner_name') : @$partner->partner_name ?>
    {!! Form::label($name, trans('partner::partner_admin.name').':') !!}
    {!! Form::text($name, $partner_name, ['class' => 'form-control', 'placeholder' => trans('partner::partner_admin.name').'']) !!}

    <?php $partner_img = @$request->get('partner_img') ? @$request->get('partner_img') : @$partner->partner_img ?>
    {!! Form::label($img, trans('partner::partner_admin.img').':') !!}
    {!! Form::textarea($img, $partner_img, ['class' => 'form-control', 'placeholder' => trans('partner::partner_admin.img').'']) !!}   


   
</div>
<!-- /SAMPLE NAME -->