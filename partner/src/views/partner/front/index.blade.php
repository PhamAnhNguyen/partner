<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="{{asset("foostart/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
        <script src="{{asset("foostart/js/jquery-2.1.4.min.js")}}" rel="stylesheet" type="text/javascript"></script>
        <script src="{{asset("foostart/js/bootstrap.js")}}" rel="stylesheet" type="text/javascript"></script>



        <?php
        if (!class_exists('lessc')) {
            include ('foostart/libs/lessc.inc.php');
        }
        $less = new lessc;
        $less->compileFile('foostart/less/peopleShow-less.less', 'foostart/css/peopleShow-css.css');
        ?>
        <script src="{{asset("foostart/js/bootstrap.min.js")}}" rel="stylesheet" type="text/javascript"></script>
        <script src="{{asset("foostart/js/peopleShow-js.js")}}" rel="stylesheet" type="text/javascript"></script>
        <script src="{{asset("foostart/js/front.js")}}" rel="stylesheet" type="text/javascript"></script>
        <link href="{{asset("foostart/css/custom-css.css")}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset("foostart/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset("foostart/css/peopleShow-css.css")}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset("foostart/css/front.css")}}" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <!---------------END LOGO SHOW----------------------->
        <div class="type">
            <section>
                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="chu" style="text-align: center;padding: 55px;font-size: 50px;">
                                    informations
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title bariol-thin">
                                            <i class="fa fa-search">
                                            </i><?php echo trans('partner::partner_admin.page_search') ?></h3>
                                    </div>
                                    <div class="panel-body">

                                        {!! Form::open(['route' => 'admin_partner','method' => 'get']) !!}

                                        <!--TITLE-->
                                        <div class="form-group">
                                            {!! Form::label('partner_name', trans('partner::partner_admin.partner_name_label')) !!}
                                            {!! Form::text('partner_name', @$params['partner_name'], ['class' => 'form-control', 'placeholder' => trans('partner::partner_admin.partner_name_placeholder')]) !!}

                                        </div>
                                        <!--/END TITLE-->

                                        {!! Form::submit(trans('partner::partner_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="myBtnAdd" class="btn" style="margin-right:3%;float: right;background:#d9534f;">Add</button>
                    </div>
                    <div class="row">

                        <?php foreach ($partners as $partner): ?>
                            <div class="col-md-4">
                                <span class="fa-stack fa-4x">

                                </span>
                                <h4 class="text-heading"><?php echo $partner['partner_img'] ?></h4> 
                                <img src="../foostart/images/logo-1-1.jpg" alt=""/>                             
                                <p class="text-muted"><b><?php echo $partner['partner_title'] ?></b></p>
                                <p class="text-muted"><b><?php echo $partner['partner_name'] ?></b></p>
                                <div class="text-center">
                                    <a href="{!! URL::route('partner.delete',['id' => $partner->partner_id, '_token' => csrf_token()]) !!}"
                                       class="btn btn-danger pull-right margin-left-5 delete">
                                        Delete </a>

                                    <a href="{!! URL::route('partner.edit',['id' => $partner->partner_id, '_token' => csrf_token()]) !!}"
                                       class="btn btn-danger pull-right margin-left-5 edit" style="background:#5bc0de;">
                                        Edit </a>
                                </div>
                            </div>
                        <?php endforeach; ?>      
                    </div>
                </div>   
            </section>
        </div>


        <!---------------LOGO SHOW----------------------->
        <!-- Trigger/Open The Modal -->

        <!-- The Modal -->
        <div id="myModalAdd" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p style="text-align: center;">HAVE YOU THINK BEFORE YOU DO ?</p>
                {!! Form::open([ 'method' => 'post',
                'route' => 'partner',
                'id' => @$partner->partner_id,
                'files'=>true])!!}
                <!-- SAMPLE NAME TEXT-->
                @include('partner::partner.elements.text', ['name' => 'partner_name','title' => 'partner_title','img' => 'partner_img'])
                <!-- /END SAMPLE NAME TEXT -->
                {!! Form::hidden('id',@$partner->partner_id) !!}
                SAVE BUTTON 
                {!! Form::submit('Save', array("class"=>"btn btn-info pull-right ")) !!}
                <!--                             /SAVE BUTTON -->
                {!! Form::close()!!};
            </div>
        </div>
        <script src='//cloud.tinymce.com/stable/tinymce.min.js'></script>

    </body>
</html>