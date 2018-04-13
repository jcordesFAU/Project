/*global $*/

$(document).ready(function () {
    "use strict";
	var grid = $("#inventory_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function () {
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "../bootgrid-php-mysql-serverside-code/response.php",
		formatters: {
            "commands": function (column, row) {
                command = "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"";
                command += row.id;
                command += "\"><span class=\"glyphicon glyphicon-edit\"></span></button> ";
                command += "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"";
                command += row.id;
                command += "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                return command;
            }
        }
	}).on("loaded.rs.jquery.bootgrid", function () {
		// Executes after data is loaded and rendered
		grid.find(".command-edit").on("click", function (e) {
			//alert("You clicked Edit on row " + $(this).data("row-id"));
			var ele = $(this).parent(),
                g_perry_part_num = $(this).parent().siblings(':first').html(),
                g_short_description = $(this).parent().siblings(':nth-of-type(2)').html();
			console.log(g_perry_part_num);
            console.log(g_short_description);
				
			//console.log(grid.data());
			$('#edit_modal').modal('show');
			if ($(this).data("row-id") > 0) {
				// collect the data
                $('#edit_perry_part_num').val(ele.siblings(':first').html()); //In case key is modified
                $('#edit_short_description').val(ele.siblings(':nth-of-type(2)').html());
                $('#edit_long_description').val(ele.siblings(':nth-of-type(3)').html());
                $('#edit_quantity').val(ele.siblings(':nth-of-type(4)').html());
				$('#edit_purchase_or_rent').val(ele.siblings(':nth-of-type(5)').html());
				$('#edit_retail_price').val(ele.siblings(':nth-of-type(6)').html());
				$('#edit_retail_price_promo').val(ele.siblings(':nth-of-type(7)').html());
				$('#edit_retail_markup').val(ele.siblings(':nth-of-type(8)').html());
				$('#edit_jobber_price').val(ele.siblings(':nth-of-type(9)').html());
				$('#edit_jobber_markup').val(ele.siblings(':nth-of-type(10)').html());
				$('#edit_bulk_price').val(ele.siblings(':nth-of-type(11)').html());
				$('#edit_bulk_markup').val(ele.siblings(':nth-of-type(12)').html());
				$('#edit_cost_to_replace').val(ele.siblings(':nth-of-type(13)').html());
				$('#edit_cost_avg').val(ele.siblings(':nth-of-type(14)').html()); //In case average cost is modified outside formula
				$('#edit_category_code').val(ele.siblings(':nth-of-type(15)').html());
			} else {
				alert('No row selected. First select a row, then click Edit.');
			}
		}).end().find(".command-delete").on("click", function (e) {
			var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
			alert(conf);
            if (conf) {
				$.post('response.php', {id: $(this).data("row-id"), action: 'delete'}, function () {
                    // when ajax returns (callback), 
					$("#inventory_grid").bootgrid('reload');
                });
				//$(this).parent('tr').remove();
				//$("#inventory_grid").bootgrid('remove', $(this).data("row-id"))
            }
		});
	});

    function ajaxAction(action) {
        data = $("#frm_" + action).serializeArray();
        $.ajax({
            type: "POST",
            url: "response.php",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#' + action + '_modal').modal('hide');
                $("#inventory_grid").bootgrid('reload');
            }
        });
    }
    
    $("#command-add").click(function () {
        $('#add_modal').modal('show');
    });
    $("#btn_add").click(function () {
        ajaxAction('add');
    });
    $("#btn_edit").click(function () {
        ajaxAction('edit');
    });
});