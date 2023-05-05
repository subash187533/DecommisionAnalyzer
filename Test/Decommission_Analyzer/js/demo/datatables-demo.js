// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("body").tooltip({ selector: "[data-toggle=tooltip]" });

  $("#dataTable").DataTable({
    dom: "Bfrtip",
    buttons: [
      {
        extend: "csv",
        text: "Download",
        titleAttr: "Download the table data as CSV",
        title: "Applications",
        className: "btn btn-outline-success btn-sm",
        exportOptions: {
          columns: ":not(.notexport)",
        },
        init: function (api, node, config) {
          $(node).removeClass("dt-button");
        },
      },
    ],
  });

  $("#inboundTable").DataTable({
    dom: "Bfrtip",
    buttons: [
      {
        extend: "csv",
        text: "Download",
        titleAttr: "Download the table data as CSV",
        title: "Applications",
        className: "btn btn-outline-success btn-sm",
        exportOptions: {
          columns: ":not(.notexport)",
        },
        init: function (api, node, config) {
          $(node).removeClass("dt-button");
        },
      },
    ],
  });

  $("#outboundTable").DataTable({
    dom: "Bfrtip",
    buttons: [
      {
        extend: "csv",
        text: "Download",
        titleAttr: "Download the table data as CSV",
        title: "Applications",
        className: "btn btn-outline-success btn-sm",
        exportOptions: {
          columns: ":not(.notexport)",
        },
        init: function (api, node, config) {
          $(node).removeClass("dt-button");
        },
      },
    ],
  });

  // $("#dataTable_filter").css("display", "none");
});
