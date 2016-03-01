<thead>
    <tr class="list-header">
        <!-- header -->
        <th class="">Title</th>
        <th class=""> Image</th>
        <th class=""></th>
    </tr>
</thead>
@foreach ($items as $key => $item)
<tr class="list-row" data-item-id="{{ $item->id }}">    
    <td class="center-text wide">{{ $item->title }}</td>
    <td class="center-text">        
        @if ( $item->image )
            <img class="list-thumbnail js-zoomable" src="/uploads/{{ $item->image }}" alt="">
        @endif
    </td>
    @include('admin._partials.form-actions')                                    
</tr>                           
@endforeach     
