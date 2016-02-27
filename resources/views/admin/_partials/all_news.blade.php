<tr class="list-header">
    <!-- header -->
    <th class="">Title</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="text-center wide">{{ $item->title }}</td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-success" href="/admin/news/{{ $item->id }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     