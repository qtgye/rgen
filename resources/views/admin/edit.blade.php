@extends('admin._layouts.page')

@section('content')
    <div class="col-sm-12">

      @if ( isset($errors) && $errors->any() )
        <div class="alert alert-block alert-danger fade in">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      @endif

      @if (session()->has('success'))
        <div class="alert alert-block alert-success fade in">
          {{ session()->get('success') }}
        </div>
      @endif

      <section class="panel form-panel">
          <header class="panel-heading form-panel-heading">
            Edit {{ $page_title }}
          </header>
          <div class="form-panel-body">
              {!! 
                  Form::model( isset($$model_name) ? $$model_name : null, [
                    'url' => 'admin/' . $model_name . '/' . (isset($$model_name) ? $$model_name->id : ''),
                    'class'  => 'form-horizontal' ,
                    'files'=> 'true'
                  ])
              !!}
                  @include('admin/_partials/form_'.$page)

                  @if ( !is_null($submit_text) )
                    <div class="form-group submit-block">
                      <div class="col-lg-offset-2 col-lg-10">
                          <button type="submit" class="btn btn-primary">{{ $submit_text }}</button>
                      </div>
                    </div>
                  @endif
                  
              {!! Form::close() !!}
              </form>
          </div>
      </section>
      
      @if ( $has_image_modal )
        @include('admin._partials.form-image-input-modal')
      @endif
      

  </div>
@stop