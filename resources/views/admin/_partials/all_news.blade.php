<thead>
    <tr class="list-header">
        <th class="">Title</th>
        <th class=""></th>
    </tr>
</thead>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="text-center wide">{{ $item->title }}</td>
    @include('admin._partials.form-actions')                                 
</tr>                           
@endforeach     