<div class="table-responsive">
    <div>
        <button class="groupProduct">Xem toàn bộ danh mục liên quan</button>

    </div>

    <?php  

        function recursiveMenu($data, $parent_id=0, $sub=true){
            echo $sub ? '<ul>': '<ul class="sub-menu">';
            foreach ($data as $key => $item) {
                 if($item['group_product_id'] == $parent_id){
                    unset($data[$key]);
                  ?>    
             <li>
              <a href="<?php echo $item['slug']?>"><?php echo $item['name']?></a>
              
              <?php recursiveMenu($data, $item['id'], false); ?>
             </li>
                <?php }} 
             echo "</ul>";
        }

        
        

    ?>
    <table class="table" id="groupProducts-table">
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
    </table>

    <div class="modal fade" id="modals-product" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nhóm danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                     <?php   recursiveMenu($groupProducts); ?>

                </div>
                
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.groupProduct').click(function () {
           
           $('#modals-product').modal('show');

        })

    </script>
</div>
