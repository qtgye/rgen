<tr class="list-header">
    <!-- header -->
    <th class=""><!-- Thumnbnail --></th>
    <th class="">Title</th>
    <th class="">Type</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">
    <td class="center-text">        
        @if ( $item->file_type == 'image' )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->file_name }}" title="{{ $item->title }}" alt="">
        @elseif ( ! $item->file_type )
            <img class="list-thumbnail thumbnail-small" src="/back/images/other.png" title="{{ $item->title }}" alt="">
        @else
            <img class="list-thumbnail thumbnail-small"src="/back/images/{{ $item->file_type }}.png" title="{{ $item->title }}" alt="">
        @endif
    </td>
    <td class="text-overflow">{{ $item->title }}</td>
    <td class="">{{ $item->file_type }}</td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     
