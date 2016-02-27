<tr class="list-header">
    <!-- header -->
    <th class="">Name</th>
    <th class="">Logo</th>
    <th class="">Website</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="center-text wide">{{ $item->name }}</td>
    <td class="center-text">        
        @if ( $item->image )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->image }}" alt="">
        @endif
    </td>
    <td class="wide center-text">{{ $item->url }}</td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-success" href="/admin/partner/{{ $item->id }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     
