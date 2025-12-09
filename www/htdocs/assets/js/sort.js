$('.master_list_table tbody').sortable({
    containment: ".master_list_table",
    axis: "y",
    handle: ".fa-sort",
    helper: helper1,
    sort: function(event, ui)
    {

    },
    stop: function(event, ui ){
        var data_sort_array = [];
        $(".fa-sort").each(function(){
            data_sort_array.push($(this).attr("data-id"));
        });

        data_sort_array = data_sort_array.join(",");

        $("#sort_num").val(data_sort_array);
    }
});


//$('#button').on('click', function() {
//    $.ajax({
//        type:"POST",
//        url:"/api/del_master_data",
//        cache: false,
//        data:{
//            'dataid':
//        },
//    timeout: 10000
//    }).done(function(data) {
//
//    });
//});

function helper1(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width()+20);
        $(this).css("background", "#001537");
    });
    return $helper;
}