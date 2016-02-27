<!-- CATEGORY -->
<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
    <label class="control-label col-lg-2" for="category_faq">Category <span class="required">*</span></label>
    <div class="col-lg-10">
        {!! Form::select('category', [
            'fast' => 'FAST',
            'stm' => 'STM',
        ], isset($faq) ? $faq->category : '' , [
            'class' => 'form-control m-bot15',
            'id' => 'category_faq'
        ]) !!}
    </div>
</div>

<!-- QUESTION -->
<div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
  <label class="col-sm-2 control-label" for="faq_question">Question <span class="required">*</span></label>
  <div class="col-sm-10">
      {!! Form::textarea('question', null, [
            'class' => 'form-control',
            'id' => 'faq_question',
            'rows' => 2
      ]) !!}
  </div>
</div>

<!-- ANSWER -->
<div class="form-group {{ $errors->has('answer') ? 'has-error' : '' }}">
  <label class="col-sm-2 control-label" for="faq_answer">Answer <span class="required">*</span></label>
  <div class="col-sm-10">
      {!! Form::textarea('answer', null, [
            'class' => 'form-control',
            'id' => 'faq_answer',
            'rows' => 4
      ]) !!}
  </div>
</div>