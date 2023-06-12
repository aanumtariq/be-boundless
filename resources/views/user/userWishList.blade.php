@extends('user.layout.master')
@section('css')
@endsection
@section('content')
<div class="mainTitle">
    <h3>My Wishlist</h3>
</div>
<div class="themeTable">
    <table>
        <thead>
            <tr>
                <th>S.no</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>                                                                
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($uWLDB as $i => $uWLDBItem)            
                <tr>
                    <td>{{ $i+1 }}</td>                                                            
                    <td>
                        <a style="padding: 0px;" href="{{ url('../single-product/'.$uWLDBItem->products->pSlug) }}">
                            <img src="{{ asset($uWLDBItem->products->pImage) }}" style="width: 50px; height:50px" alt="">      
                        </a>                
                    </td>
                    <td>{{ $uWLDBItem->products->pName }}</td>                    
                    @if ($uWLDBItem->products->discount > 0)
                        <td>
                            <label>&dollar;{{ App\Helpers\Helper::discountedValue($uWLDBItem->products->pPrice, $uWLDBItem->products->discount,true) }}</label><br>
                            <del style="text-decoration: line-through !important; color:gray;">{{ $uWLDBItem->products->pPrice }}</del>{{ '  -%'.$uWLDBItem->products->discount  }}
                        </td> 
                    @else
                        <td>
                            <label>{{ $uWLDBItem->products->pPrice  }}</label>
                        </td>
                    @endif                                   
                    <td><a class="btnAddToCart" name="{{ $uWLDBItem->products->Id  }}">Add to Cart</a></td>
                </tr>
            @endforeach           
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script type="text/javascript">

(() => {   

    $('.btnAddToCart').click(function(e){
        var proAddCartId = $('.btnAddToCart').attr('name');   
        var qtySelected = 1;
        console.log(qtySelected);
              e.preventDefault();             
              $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
              $.ajax({
                  url: '{{route('ecommerce.product.addcart')}}',
                  method: 'post',               
                  data: {
                   id : proAddCartId,
                   qty : qtySelected
                  },
                  success: function(result){
                    console.log(result);
                    generateNotification(result.status,result.data+' (View Cart)',"{{ route('ecommerce.product.cart') }}");
                   
                  },
           error: function(params) {
            console.log(params);
        }
                  
                  });
    });


})()
    




</script>
@endsection
