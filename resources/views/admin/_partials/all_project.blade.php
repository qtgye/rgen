<tr class="list-header">
    <!-- header -->
    <th class="">Title</th>
    <th class=""> Image</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="center-text">{{ $item->title }}</td>
    <td class="center-text wide">        
        @if ( $item->image )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->image }}" alt="">
        @endif
    </td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-success" href="/admin/project/{{ $item->id }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     
