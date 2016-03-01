@extends('admin._layouts.page')

@section('content')
	<div class="col-sm-12">

      @if ( isset($errors) && $errors->any() )
        <ul class="alert alert-block alert-danger fade in">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <section class="panel form-panel">
          <header class="panel-heading form-panel-heading">
            New {{ $page_title }}
          </header>
          <div class="form-panel-body">
              {!! 
                  Form::open( [
                    'url' => 'admin/' . $model_name,
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