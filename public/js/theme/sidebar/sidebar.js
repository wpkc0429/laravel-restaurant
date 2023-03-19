var sidebarIsOpen;
const openSidebarOnLoad = false;
if (localStorage.getItem('SIDEBAR_STATUS') === null) {
  sidebarIsOpen = openSidebarOnLoad;
} else {
  if (localStorage.getItem('SIDEBAR_STATUS') === 'opened') {
    sidebarIsOpen = true;
  } else {
    sidebarIsOpen = false;
  }
}
if (sidebarIsOpen) {
  $("#left").addClass('sideExpand');
}
$("#menu").on("click", function() {
  if(!$("#left").hasClass('animation')) {
    $("#left").addClass('animation');
  }
  $("#left").toggleClass("sideExpand");
  let isSidebarCollapse = $("#left").hasClass("sideExpand");
  if(isSidebarCollapse) {
    localStorage.setItem('SIDEBAR_STATUS', 'opened');
  } else {
    localStorage.setItem('SIDEBAR_STATUS', 'closed');
  }

  if (typeof(table) === 'object') {
    table.draw('page');
  }
});
