@extends('layouts.app')

@section('content')

<style type="text/css">
    
    .paren1 span{
        cursor: pointer;
    }
</style>

<?php 

    $GLOBALS['id'] = $id;

    
    function data_active_show(){

        $data = App\Models\groupProduct::select('product_id', 'id')->get();

        $product_id =  $GLOBALS['id'];

        $data_active = [];


        if(isset($data)){

            foreach ($data as $value) {



                if(!empty(json_decode($value->product_id))&&in_array($product_id, json_decode($value->product_id))){

                    array_push($data_active, $value->id);

                }
                
            }

        }

        return $data_active;

    }

?>

<?php 

    $name_product = App\Models\product::find($id);
?>

<h2>Sửa danh mục cho sản phẩm {{ $name_product->Name }}</h2>


<?php 


    function get_child_of_Parent($parent){

        $count_child   = App\Models\groupProduct::where('parent_id', $parent)->get();

        $ar_child = [];

        if(count($count_child)>0){

            for ($i=0; $i < count($count_child); $i++) { 

                $find = $i==0?$parent:$childs->id;
                
                $childs = App\Models\groupProduct::where('parent_id',  $find)->first();

                $ar_child[$i] = $childs->id;

            }

            return $ar_child;

        }

    }



?>

<div class="table-responsive">
   <!--  <div>
        <button class="groupProduct">Xem toàn bộ danh mục liên quan</button>

    </div> -->

    <?php  

         $groupProductss = App\Models\groupProduct::get();

         $groupProducts = App\Models\groupProduct::get();


         

        function recursiveMenu($data, $parent_id=0, $sub=true, $level=0){

            $data_active = data_active_show();

            if($level==0||$level==1){
                 $levelcheck = $parent_id;

            }
            else{
                 $levelcheck ='';
            }
            echo $sub ? '<ul>':'<ul class="sub-menu sub'.$levelcheck.'">';
            foreach ($data as $key => $item) {

                $all_prent = App\Models\groupProduct::where('parent_id', $item['id'])->get();
                if($item['group_product_id'] == $parent_id){
                    unset($data[$key]);
                ?>    
             <li class="paren1">



            

              <input type="checkbox" id="select{{ $item['id'] }}" name="sale" onclick="selected({{ $item['id'] }})" {{ in_array($item['id'], $data_active)?'checked':''}}><a href="javascript:void(0)"  class="click1" data-id="{{ $item['id'] }}"><?php echo $item['name']?></a>  @if($item['level']<count($all_prent))<span class="clicks{{ $item['id'] }}" onclick="showChild('sub{{ $item['id'] }}', 'clicks{{ $item['id'] }}')">+</span>@endif
              
              <?php recursiveMenu($data, $item['id'], false, $item['level'], $data_active); ?>
             </li>
                <?php }} 
             echo "</ul>";
        }

        
        

    ?>
   <!--  <table class="table" id="groupProducts-table">
        <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groupProducts as $groupProduct)
            <tr>
                <td>{{ $groupProduct->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['groupProducts.destroy', $groupProduct->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('groupProducts.show', [$groupProduct->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('groupProducts.edit', [$groupProduct->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                         <a href="{{ route('filters.create') }}?groupid={{ $groupProduct->id }}"
                           class='btn btn-default btn-xs'>
                            <i class="fa fa-filter"></i>
                        </a>
                       


                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table> -->

    <?php recursiveMenu($groupProductss);  ?>

    <?php unset($GLOBALS['id']); ?>

   



    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                     <a href="" class="sua">Sửa</a>
                     <br>
                     <!-- <a href="" class="xoa">Xóa</a> -->

                </div>
                
            </div>
        </div>
    </div>

   

    <script type="text/javascript">
        $('.groupProduct').click(function () {
           
           $('#modals-product').modal('show');

        })




        $('.sub-menu').hide();

        // $('.parent').click(function () {
           
        //     parent = $(this).parents().find('li').attr('class');

        //     alert(parent);
        // })

        $('.click1').dblclick(function(){

            dataId = $(this).attr('data-id');

            $('.sua').attr('href', '{{env("APP_URL")}}/admins/groupProducts/'+dataId+'/edit');

            $('#info-modal').modal('show');


        })

        function showChild(id, classs) {

            if($('.'+id).is(":visible") ){
                 $('.'+id).hide();
                 $('.'+classs).text('+');
            }
            else{
                $('.'+id).show();
                $('.'+classs).text('-');
            }

        
        }

        function selected(id) {

             var checked = $('#select'+id).is(':checked'); 


            var active = 0;

            if(checked == true){
                active = 1;
            }


            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('add-group-product') }}",
                data: {
                    id: id,
                    product_id:{{ $product_id }},
                    active:active,
                },
               
                success: function(result){

                    console.log(result)
                   

                }
            });

        }

    </script>
</div>

@endsection
