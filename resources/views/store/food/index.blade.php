@extends("layouts/layout")

@push('links')
<link href="{{ asset('css/datatables/1.12.1/datatables.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/datatables/custom.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="row mb-3">
  <div class="col-12">
    <a href="{{ $previous_url }}">
      <i class="fa-solid fa-arrow-left"></i>&ensp;<b>返回</b>
    </a>
  </div>
</div>
<div class="row justify-content-between">
  <div class="col-lg-6 col-md-12">
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12">
    <div class="input-group mb-3">
      <input class="form-control border-end-0 border datatable-search" type="text" aria-label="Search" placeholder="名稱" />
      <span class="input-group-append">
        <button class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5" type="button">
          <span class="fa fa-search"></span>
        </button>
      </span>
    </div>
  </div>
</div>

<!-- 資料表格 -->
<div class="row mb-3">
  <div class="col position-relative">
    <table class="table table-striped table-hover steps-datatable" id="dataTable">
      <thead>
        <tr>
          <th>名稱</th>
          <th>價格</th>
          <th>備註</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
@endsection

{{-- META --}}
@push('meta')
  <meta name="datatable-url" content='{{ $datatable_url }}'>
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('js/datatables/1.12.1/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables/default-setting.js') }}"></script>
<script type="text/javascript">
  let table = $("#dataTable").DataTable( Object.assign(dataTableDefSetting, {
    serverSide: true,
    stateSave: true,
    stateSaveParams: function(settings, data) {
    },
    stateLoadParams: function(settings, data) {
      $(".datatable-search").val(data.search.search);
    },
    ajax: {
      url: $('meta[name="datatable-url"]').attr('content'),
      type: 'POST',
      data: function(data) {
        data._token = $('meta[name="csrf-token"]').attr('content');
      }
    },

    /**
    * 預設排序
    */
    "order": [
      ["0", "asc"]
    ],

    /**
    * targets: int
    * orderable: boolean 排序
    * orderData: array 複數排序
    * searchable: boolean 查詢
    * visible: boolean 顯示
    */
    "columnDefs": [
      { "targets": 0, 'orderable': true, 'searchable': true },
      { "targets": 1, 'orderable': false, 'searchable': false },
      { "targets": 2, 'orderable': false, 'searchable': false },
      { "targets": 3, 'orderable': false, 'searchable': false }
    ]
  }));

  $(".datatable-search").bind('input propertychange', function() {
    table.search($(this).val()).draw();
  });

</script>
@endpush
