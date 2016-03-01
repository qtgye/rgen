<thead>
    <tr class="list-header">
        <th class="">Name</th>
        <th class="">Product Image</th>
        <th class=""></th>
    </tr>    
</thead>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">        
    <td class="wide center-text">{{ $item->name }}</td>
    <td class="center-text">        
        @if ( $item->image )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->image }}" alt="">
        @endif
    </td>
    <!-- <td class="center-text">{{ implode(',',$item->getCategoriesText()) }}</td>       -->
    @include('admin._partials.form-actions')                           
</tr>                           
@endforeach     
