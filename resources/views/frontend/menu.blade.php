@if(!empty($menu)  && $menu->count()>0)

<?php 

    $menu_lv_1 = $menu->where('level', 0)->where('active', 1)->where('parent_id', 0);
?>

@foreach($menu_lv_1 as $val)
<li class="child" data-id="danh-muc{{ $val->id }}">
    <a class="list-mn" href="{{route('details', $val->link)}}">
    <i class="fa-regular fa-refrigerator"></i>
    <span>{{ $val->name??'' }}</span>
    </a>

    <?php 

        $menu_level_2 = $menu->where('active', 1)->where('parent_id', $val->id);

    ?>
     @if(!empty($menu_level_2)  && $menu_level_2->count()>0)
    <div class="navmwg accessories danh-muc{{ $val->id }}" style="display: none;">
        @foreach($menu_level_2 as $val2) 

        <?php 

            $menu_level_3 = $menu->where('active', 1)->where('parent_id', $val2->id);

        ?>
        <div class="sub-cate">
            <div class="PKLT">
               
                <a href="{{ route('details', $val2->link) }}"><strong>{{ $val2->name??'' }}</strong></a>
                @if(!empty($menu_level_3)  && $menu_level_3->count()>0)
                @foreach($menu_level_3 as $val_3)
                <a href="{{ route('details', $val_3->link) }}">
                    <h3>{{ $val_3->name??'' }}</h3>
                </a>
                @endforeach
                @endif


            </div>
        </div>

        @endforeach
        
    </div>
    @endif
</li>
@endforeach

@endif