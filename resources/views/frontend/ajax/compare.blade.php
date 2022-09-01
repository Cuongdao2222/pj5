
@if(!empty($data))

@foreach($data as $datas)
<a href="javascript:void(0)" class="js-compare-item position-relative" data-id="39839">
    <span class="remove-compare js-remove-compare" onclick="removeCompare(this)"></span>
    <img src="{{ asset($datas->Image) }}">
    <span>{{ $datas->Name }}</span>
</a>
@endforeach
@endif