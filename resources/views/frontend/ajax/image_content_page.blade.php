@if(!empty($data) && $data->count()>0)

	<?php 

		$i = 0;
	?>

	@foreach($data as $key => $datas)
	<?php 

		$i++;
	?>
    <td class="img{{ $key }} tdimg">
        <a href="javascript:void(0);" onclick="click1('images{{ $key }}', '{{ asset("uploads/product/".$datas->image) }}')"><img src='{{ asset("uploads/product/".$datas->image) }}' style="max-width:100px; max-height:130px" id="img{{ $key }}">
        </a>
    </td>
    @endforeach
	      
@endif