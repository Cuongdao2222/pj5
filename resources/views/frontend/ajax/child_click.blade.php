@if(isset($data))
     <?php $data_active = []; ?>


    @foreach($data as $datas)

        <?php 

         if(!empty(json_decode($datas->product_id))&&in_array($id, json_decode($datas->product_id))){

                array_push($data_active, $value->id);

            }

            $child_pa = App\Models\groupProduct::where('parent_id',  $datas->id)->where('level', $datas->level+1)->get()->toArray();

        ?>

                  
        <li class="paren1">
            <input type="checkbox" id="select{{ $datas->id }}" name="sale" onclick="selected('{{ $datas->id }}')"><a href="javascript:void(0)" class="click1" data-id="{{ $datas->id }}">{{ $datas->name }}</a>  @if(isset($child_pa))<span class="clicks{{ $datas->id }}" onclick="showChild('sub{{ $datas->id }}', 'clicks{{ $datas->id }}')">+</span>@endif            
            
        </li>
        <ul class="sub-menu sub{{ $datas->id }}" style="display: none;"></ul>
    
    @endforeach
   
@endif   

