var TableDatatablesResponsive = function() {
    var t = function() {
            var e = $(".datatable_basic");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                columnDefs: [{
                    className: "control",
                    orderable: true,
                    targets: 0
                }],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 5,
                pagingType: "bootstrap_extended"
            })
        },
        bo = function() {
            var e = $(".datatable_basic_order_2");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                columnDefs: [{
                    className: "control",
                    orderable: true,
                    targets: 0
                }],
                order: [
                    [1, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                pagingType: "bootstrap_extended"
            })
        },
        o = function() {
            var e = $(".datatable_button");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                }, {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "csv",
                    className: "btn default"
                }],
                colReorder: {
                    reorderCallback: function() {
                        console.log("callback")
                    }
                },
                rowReorder: {},
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
         a = function() {
            var e = $(".datatable_pdf_excel");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "pdf",
                    className: "btn red btn-outline",
                    exportOptions: {
                        columns:function(idx, data, node){
                            if(idx == 0){return false;}
                            else{return true;}
                        }
                    }
                }, {
                    extend: "excel",
                    className: "btn green btn-outline ",
                    exportOptions: {
                        columns:function(idx, data, node){
                            if(idx == 0){return false;}
                            else{return true;}
                        }
                    }
                }],
                responsive: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        s = function() {
            var e = $(".datatable_scroll");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                scrollY: 225,
                deferRender: !0,
                 "scrollX": true,
                scroller: !0,
                stateSave: !0,
                lengthMenu: [
                    [10, 15, 20, -1],
                    [10, 15, 20, "All"]
                ],
                pageLength: -1
            })
        },
        s2 = function() {
            var e = $(".datatable_scroll_2");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Total Entries : _TOTAL_ Data",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                columnDefs: [{
                    // className: "control",
                    // orderable: true,
                    // targets: 0
                    "type": "numeric", targets: 2
                }],
                order: [
                    [1, "asc"]
                ],
                scrollY: 225,
                "scrollX": true,
                deferRender: !0,
                scroller: !0,
                paging:true,
                
                aLengthMenu: [
                    [-1],
                    [ "All"]
                ],
                iDisplayLength: -1,
                pageLength: -1
            });   
        },
        dcr = function() {
            var e = $(".datatable_colReorder");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                responsive: !0,
                colReorder: {
                    reorderCallback: function() {
                        console.log("callback")
                    }
                },
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 5,
                pagingType: "bootstrap_extended"
            })
        },
         dt_m = function() {
            var e = $(".datatable_managed");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ records",
                    infoEmpty: "No records found",
                    infoFiltered: "(filtered1 from _MAX_ total records)",
                    lengthMenu: "Show _MENU_",
                    search: "Search:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        previous: "Prev",
                        next: "Next",
                        last: "Last",
                        first: "First"
                    }
                },
                bStateSave: !0,
                columnDefs: [{
                    targets: 0,
                    orderable: !1,
                    searchable: !1
                }],
                lengthMenu: [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"]
                ],
                pageLength: 5,
                pagingType: "bootstrap_extended",
                columnDefs: [{
                    orderable: !1,
                    targets: [0]
                }, {
                    searchable: !1,
                    targets: [0]
                }],
                order: [
                    [1, "asc"]
                ]
            });
            jQuery("#sample_1_wrapper");
            e.find(".group-checkable").change(function() {
                var e = jQuery(this).attr("data-set"),
                    t = jQuery(this).is(":checked");
                jQuery(e).each(function() {
                    t ? ($(this).prop("checked", !0), $(this).parents("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).parents("tr").removeClass("active"))
                })
            }), e.on("change", "tbody tr .checkboxes", function() {
                $(this).parents("tr").toggleClass("active")
            })
        }
        ;
    return {
        init: function() {
            jQuery().dataTable && (t(),o(),a(),s(),bo(),s2(),dcr(),dt_m())
        }
    }
}();
jQuery(document).ready(function() {
    // TableDatatablesResponsive.init()
});