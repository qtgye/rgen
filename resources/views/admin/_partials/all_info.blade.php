<tr class="list-header">
    <!-- header -->
    <th class="">Name</th>
    <th class="">Value</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td>{{ $item->name }}</td>
    <td class="wide">        
        @if ( $item->value_type == 'image' )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->value }}" alt="">
        @else
            {!! $item->value !!}
        @endif
    </td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-success" href="/admin/info/{{ $item->id }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     
