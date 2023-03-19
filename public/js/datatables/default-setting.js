var dataTableDefSetting = {
  "dom": "<'row mb-3'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 col-md-4 col-lg-4 datatable-menu'l><'col-sm-12 col-md-4 col-lg-4 datatable-info'i><'col-sm-12 col-md-4 col-lg-4 datatable-paging'p>>",
  'scrollY': '450px',
  'scrollCollapse': false,
  "processing": true,
  /*目前所屬資訊*/
  "info": true,
  /*排序功能*/
  "ordering": true,
  /*搜尋功能*/
  "searching": true,
  /*頁碼功能*/
  "paging": true,
  /**
   *頁碼顯示類型
   * numbers, simple, simple_numbers, full, full_numbers, first_last_numbers
   */
  "pagingType": "full_numbers",
  /*顯示資料筆數選擇器*/
  "lengthMenu": [
    [10, 25, 50, 100, 500],
    [10, 25, 50, 100, 500]
  ],
  "language": {
    "lengthMenu": "一頁顯示 _MENU_ 筆",
    "zeroRecords": "查無資料",
    "sInfo": "顯示資料 _PAGE_ of _PAGES_, 共 _TOTAL_ 筆",
    "infoEmpty": "查無資料",
    "infoFiltered": "(從 _MAX_ 筆資料搜尋)",
    "search": "搜尋：",
    "searchPlaceholder": "查詢關鍵字",
    "oPaginate": {
      "sFirst": "最前頁",
      "sPrevious": '<span aria-hidden="true">&laquo;</span>',
      "sNext": '<span aria-hidden="true">&raquo;</span>',
      "sLast": "最末頁"
    }
  }
};
