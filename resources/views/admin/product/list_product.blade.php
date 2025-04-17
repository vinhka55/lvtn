@extends("admin.admin_layout")
@section("admin_page")
<style>
    .toggle-button {
        display: inline-block;
        width: 60px;
        height: 30px;
        background: #ccc;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .toggle-button::before {
        content: "";
        position: absolute;
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: transform 0.3s;
    }
    
    .toggle-button.on {
        background: #4CAF50;
    }
    
    .toggle-button.on::before {
        transform: translateX(30px);
    }
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select id="filterCategory" class="input-sm form-control w-sm inline v-middle">
          <option value="all-sports">Tất cả môn</option>
          @foreach($category as $cate)
            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
          @endforeach
        </select>
        <a href="" class="btn btn-sm btn-default">Chọn</a>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" id="searchInput" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" id="searchButton" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Hình ảnh</td>
            <th>Thêm ảnh</td>
            <th>Tên sản phẩm</th>
            <th>Giá</th>           
            <th>Trạng thái</th>
            <th>Danh mục</th>
            <th>Còn lại</th>
            <th>Đã bán</th>           
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="productTableBody">                   
        @include('admin.product.ajax_product_table')        
        </tbody>
      </table>
    </div>
    <div class="text-center origin-panigation" id="paginationLinks">
      {{ $product->links() }}
    </div> 
  </div>
</div>
<script>
    function toggleButton(button, id) {
        button.classList.toggle("on");
        $.ajax({
            url: "{{route('edit_status_product')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: {id:id},
            success:function(data){
            toastr.success('Thay đổi tình trạng sản phẩm thành công', 'Thành công');         
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    }
    let currentCategoryId = null;
    $('#filterCategory').on('change', function() {
        currentCategoryId = $(this).val();
        // Cập nhật URL
        const url = new URL(window.location.href);
        url.searchParams.set('category_id', currentCategoryId);
        window.history.pushState({}, '', url);
        $.ajax({
            url: "{{ route('filter_product_by_category') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: {
                category_id: currentCategoryId
            },
            success: function(response) {
                $('#productTableBody').html(response.html);
                $('#paginationLinks').html(response.pagination);
                // ✅ Cập nhật URL khi chọn danh mục
                const url = new URL(window.location.href);
                url.searchParams.delete('page'); // khi chọn danh mục mới thì về page 1
                window.history.pushState({}, '', url);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
    // Bắt sự kiện click phân trang
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];

        if (currentCategoryId) {
          $.ajax({
              url: "{{ route('filter_product_by_category') }}?page=" + page,
              method: 'POST',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: { category_id: currentCategoryId },
              success: function(response) {
                  $('#productTableBody').html(response.html);
                  $('#paginationLinks').html(response.pagination);
                  const url = new URL(window.location.href);
                  url.searchParams.set('page', page);
                  window.history.pushState({}, '', url);
              }
          });
        }
        else if (currentSearchKeyword) {
          $.ajax({
              url: "{{ route('search_product_ajax') }}?page=" + page,
              method: 'POST',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: { keyword: currentSearchKeyword },
              success: function(response) {
                  $('#productTableBody').html(response.html);
                  $('#paginationLinks').html(response.pagination);

                  const url = new URL(window.location.href);
                  url.searchParams.set('search', currentSearchKeyword);
                  url.searchParams.set('page', page);
                  window.history.pushState({}, '', url);
              }
          });
        }
        else {
          $.ajax({
              url: "{{ route('list_product') }}?page=" + page,
              method: 'GET',
              success: function(response) {
                  $('#productTableBody').html(response.html);
                  $('#paginationLinks').html(response.pagination);
                  const url = new URL(window.location.href);
                  url.searchParams.set('page', page);
                  window.history.pushState({}, '', url);
              }
          });
        }
    });
    let currentSearchKeyword = '';

  $('#searchButton').on('click', function() {
      currentSearchKeyword = $('#searchInput').val();

      $.ajax({
          url: "{{ route('search_product_ajax') }}",
          method: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: { keyword: currentSearchKeyword },
          success: function(response) {
              $('#productTableBody').html(response.html);
              $('#paginationLinks').html(response.pagination);

              const url = new URL(window.location.href);
              url.searchParams.set('search', currentSearchKeyword);
              url.searchParams.delete('page');
              window.history.pushState({}, '', url);
          },
          error: function(xhr) {
              console.log(xhr.responseText);
          }
      });
  });
</script>
@stop