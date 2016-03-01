@extends('admin._layouts.page')

@section('content')
	<div class="col-lg-12 c-list js-list" data-model="{{ $model_name }}">
            
      @if ( session()->has('success') )
        <div class="alert alert-block alert-success fade in">
          {{ session()->get('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      @endif       
      

      @if ( count($items) > 0 )
        
        <section class="panel form-panel">

          <header class="panel-heading form-panel-heading">
              All {{ $model_plural }}
          </header>
          
          <div class="form-panel-body">
            {!! Form::open() !!}
              <table class="table table-advance list-table">
                 <tbody>      
                    @include('admin._partials.all_'.$model_name)
                 </tbody>
              </table>
            {!! Form::close()!!}            
          </div>
          
        </section>

      @else
        
        <blockquote>
          <p>
            You have no entry here yet.
          </p>
          <p>
            <a class="btn btn-primary" href="/admin/{{ $model_name }}/new">Add your first {{ $page_title }}</a>
          </p>
        </blockquote>

      @endif

      
  </div>

  <!-- confirm modal -->
  <div class="js-modal modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-type="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirm Item Delete</h4>
            </div>
            <div class="modal-body">

              Are you sure to delete this item?

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default js-cancel-btn" type="button">Cancel</button>
                <button data-dismiss="modal" class="btn btn-success js-confirm-btn" type="button">Confirm</button>
            </div>
        </div>
    </div>
  </div>
@stop