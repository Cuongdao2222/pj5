@if(!empty($data) && $data->count()>0)

	<?php 

		$i = 0;
	?>

	@foreach($data as  $datas)
	<?php 

		$i++;
	?>
    <td class="img{{ $i }} tdimg">
        <a href="javascript:void(0);" onclick="clicks('images', '{{ asset($datas->image) }}')"><img src="{{ asset($datas->image) }}" style="max-width:100px; max-height:130px" id="img0">
        </a>
    </td>
    @endforeach
	      
@endif