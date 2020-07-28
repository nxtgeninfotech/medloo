@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading bord-btm">
                <h3 class="panel-title">{{__('Create Custom Page')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="title">{{__('Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{__('Slug')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('your-slug')}}" id="slug" name="slug" class="form-control" required>
                            <small><code>http://domain.com/your-slug</code> Only a-z, numbers, hypen allowed</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="content">{{__('Content')}}</label>
                        <div class="col-sm-9">
                            <textarea class="editor" name="content" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="slug">{{__('Meta Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Meta Title')}}" id="meta_title" name="meta_title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_description">{{__('Meta Description')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Meta Description')}}" id="meta_description" name="meta_description" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="keywords">{{__('Keywords')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{__('Keywords')}}" id="keywords" name="keywords" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="meta_image">{{__('Meta Image')}} <small>(200x300)</small></label>
                        <div class="col-sm-9">
                            <input type="file" id="meta_image" name="meta_image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Add New')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>
</div>
@endsection
