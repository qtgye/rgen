<tr class="list-header">
    <!-- header -->
    <th class="">Category</th>
    <th class="">Question</th>
    <th class="">Answer</th>
    <th class=""><em>Action</em></--></th>
</tr>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="">{{ strtoupper($item->category) }}</td>
    <td class="canter-text wide">        
        {{ $item->question }}
    </td>
    <td class="canter-text wide">
        {{ $item->answer }}
    </td>
    <td class="">
        <div class="btn-group">
            <a class="btn btn-success" href="/admin/faq/{{ $item->id }}"><i class="fa fa-edit"></i></a>
            <a class="btn btn-danger js-item-delete" data-toggle="modal" href="#confirmModal"><i class="fa fa-times"></i></a>
        </div>
    </td>                            
</tr>                           
@endforeach     
