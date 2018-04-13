<!-- Code blocks where I added to or replaced Brett's code is set off with comments containing my initials: "JGC start" and "JGC end" -->
<!-- The rest was code Brett uploaded -->

<!-- Other files can be considered new except inventory.css, where I just added the final piece bit for text_area formatting -->

<html lang="en">
    <head>
        <link rel="shortcut icon" type="image/png" href="../assets/img/logo-owl-color.png"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../favicon.ico">
        
        <title>FAUOWLS</title>
        
        <!-- Bootstrap core CSS -->
        <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        
	   <!-- Bootgrid CSS -->
	   <link href="../jquery.bootgrid-1.3.1/jquery.bootgrid.min.css" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="inventory.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" id="navbar-header"><img src="../assets/img/logo-owl-color.svg" width="45" height="25"/></a>
                    <a class="navbar-brand" href="#" id="navbar-header" style="color: #428bca">FAUOWLS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" style="color:#428bca">Dashboard</a></li>
                        <li><a href="#" style="color:#428bca">Settings</a></li>
                        <li><a href="#" style="color:#428bca">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar"  style="background-color:#036">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Inventory <span class="sr-only">(current)</span></a></li>
                        <li><a href="images.php">Images</a></li>
                        <li><a href="#">Back-End</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="">Should</a></li>
                        <li><a href="">Go</a></li>
                        <li><a href="">Here</a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h1 class="page-header">Inventory</h1>
                    
                    <div class="row placeholders">
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <form class="navbar-form navbar-left" method="POST">
                                <input type="text" class="form-control" placeholder="Enter Part #" name="search">
                                <input type="SUBMIT" name="submit" value="Search" />
                            </form>
                        </div>
                        <div class="well clearfix">
                            <div class="pull-right">
                                <button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
                                    <span class="glyphicon glyphicon-plus"></span>Add new item
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- JGC start -->
					
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th data-column-id="perry_part_num" data-identifier="true">Perry's part number</th>
                                    <th data-column-id="short_description">Short description</th>
                                    <th data-column-id="long_description">Long description</th>
                                    <th data-column-id="quantity">Quantity (#)</th>
                                    <th data-column-id="purchase_or_rent">Purchase/Rent</th>
                                    <th data-column-id="retail_price">Retail price (USD)</th>
                                    <th data-column-id="retail_price_promo">Retail promo price (USD)</th>
                                    <th data-column-id="retail_markup">Retail markup (USD)</th>
                                    <th data-column-id="jobber_price">Jobber price (USD)</th>
                                    <th data-column-id="jobber_markup">Jobber markup (%)</th>
                                    <th data-column-id="bulk_price">Bulk price (USD)</th>
                                    <th data-column-id="bulk_markup">Bulk markup (%)</th>
                                    <th data-column-id="cost_to_replace">Cost to replace (USD)</th>
									<th data-column-id="cost_avg">Average cost (USD)</th>
                                    <th data-column-id="category_code">Category code (#)</th>
                                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
					
					<!-- JGC end -->
					
                </div>
            </div>
        </div>
		
		<!-- JGC start -->
		
        <div id="add_modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add New Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frm_add">
                            <input type="hidden" value="add" name="action" id="action"/>
                            <div class="form-group">
                                <label for="perry_part_num" class="control-label">Perry's part number:</label>
                                <input type="text" class="form-control" id="perry_part_num" name="perry_part_num"/>
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="control-label">Short description:</label>
                                <input type="text" class="form-control" id="short_description" name="short_description"/>
                            </div>
                            <div class="form-group">
                                <label for="long_description" class="control-label">Long description:</label>
                                <!--<input type="text" class="form-control" id="long_description" name="long_description"/>-->
                                <textarea name="long_description" cols="85" rows="20"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="control-label">Quantity (#):</label>
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity"/>
                            </div>
                            <div class="form-group">
                                <label for="purchase_or_rent" class="control-label">Purchase/rent:</label>
                                <input type="text" class="form-control" id="purchase_or_rent" name="purchase_or_rent"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_price" class="control-label">Retail price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="retail_price" name="retail_price"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_price_promo" class="control-label">Retail promo price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="retail_price_promo" name="retail_price_promo"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_markup" class="control-label">Retail markup (%):</label>
                                <input type="number" step="0.0001" class="form-control" id="retail_markup" name="retail_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="jobber_price" class="control-label">Jobber price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="jobber_price" name="jobber_price"/>
                            </div>
                            <div class="form-group">
                                <label for="jobber_markup" class="control-label">Jobber markup (%):</label>
                                <input type="number" step="0.0001" class="form-control" id="jobber_markup" name="jobber_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="bulk_price" class="control-label">Bulk price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="bulk_price" name="bulk_price"/>
                            </div>
                            <div class="form-group">
                                <label for="bulk_markup" class="control-label">Bulk markup (%):</label>
                                <input type="number" step="0.0001" class="form-control" id="bulk_markup" name="bulk_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="cost_to_replace" class="control-label">Cost to replace (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="cost_to_replace" name="cost_to_replace"/>
                            </div>
							<div class="form-group">
                                <label for="cost_avg" class="control-label">Average cost (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="cost_avg" name="cost_avg"/>
                            </div>
							<div class="form-group">
                                <label for="category_code" class="control-label">Category code (#):</label>
                                <input type="number"  min="0" class="form-control" id="category_code" name="category_code"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="btn_add" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
        <div id="edit_modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Item</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frm_edit">
                            <input type="hidden" value="edit" name="action" id="action">
                            <input type="hidden" value="0" name="edit_perry_part_num" id="edit_perry_part_num">
                            <div class="form-group">
                                <label for="short_description" class="control-label">Short description:</label>
                                <input type="text" class="form-control" id="edit_short_description" name="edit_short_description"/>
                            </div>
                            <div class="form-group">
                                <label for="long_description" class="control-label">Long description:</label>
                                <input type="text" class="form-control" id="edit_long_description" name="edit_long_description"/>
                                <!-- <textarea name="edit_long_description" cols="85" rows="20"></textarea> -->
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="control-label">Quantity (#):</label>
                                <input type="number" min="0" class="form-control" id="edit_quantity" name="edit_quantity"/>
                            </div>
                            <div class="form-group">
                                <label for="purchase_or_rent" class="control-label">Purchase/rent:</label>
                                <input type="text" class="form-control" id="edit_purchase_or_rent" name="edit_purchase_or_rent"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_price" class="control-label">Retail price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="edit_retail_price" name="edit_retail_price"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_price_promo" class="control-label">Retail promo price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="edit_retail_price_promo" name="edit_retail_price_promo"/>
                            </div>
                            <div class="form-group">
                                <label for="retail_markup" class="control-label">Retail markup (%):</label>
                                <input type="number" step="0.0001" class="form-control" id="edit_retail_markup" name="edit_retail_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="jobber_price" class="control-label">Jobber price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="edit_jobber_price" name="edit_jobber_price"/>
                            </div>
                            <div class="form-group">
                                <label for="jobber_markup" class="control-label">Jobber markup (%):</label>
                                <input type="number" step="0.0001" class="form-control" id="edit_jobber_markup" name="edit_jobber_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="bulk_price" class="control-label">Bulk price (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="edit_bulk_price" name="edit_bulk_price"/>
                            </div>
                            <div class="form-group">
                                <label for="bulk_markup" class="control-label">Bulk markup (USD):</label>
                                <input type="number" step="0.0001" class="form-control" id="edit_bulk_markup" name="edit_bulk_markup"/>
                            </div>
                            <div class="form-group">
                                <label for="cost_to_replace" class="control-label">Cost to replace (USD):</label>
                                <input type="number" step="0.0001" min="0.000" class="form-control" id="edit_cost_to_replace" name="edit_cost_to_replace"/>
                            </div>
							<input type="hidden" value="0" name="edit_cost_avg" id="edit_cost_avg">
							<div class="form-group">
                                <label for="category_code" class="control-label">Category code (#):</label>
                                <input type="number" min="0" class="form-control" id="edit_category_code" name="edit_category_code"/>
                            </div>       
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- JGC end -->
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>'</script>
        <script src="../dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="../assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
		
		<!--JGC start-->
		
        <!-- Bootgrid -->
        <script src="../jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>
        <script src="../jquery.bootgrid-1.3.1/jquery.bootgrid.fa.min.js"></script>
        <!-- Response to Edit, Add, Delete actions -->
        <script src="../bootgrid-php-mysql-serverside-code/response.js" type="text/javascript"></script>
		
		<!-- JGC end -->
        
    </body>
</html>