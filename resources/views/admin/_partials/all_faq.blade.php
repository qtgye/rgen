<thead>
    <tr class="list-header">
        <th class="">Category</th>
        <th class="">Question</th>
        <th class="">Answer</th>
        <th class=""></th>
    </tr>    
</thead>

@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="">{{ strtoupper($item->category) }}</td>
    <td class="canter-text wide">        
        {{ $item->question }}
    </td>
    <td class="canter-text wide">
        {{ $item->answer }}
    </td>
    @include('admin._partials.form-actions')                                
</tr>                           
@endforeach     
