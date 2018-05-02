<!DOCTYPE html>
<html lang="en">
    <?php $this->render('templates/head'); ?>
    <body>
        <style>
            .vertical-gap30{
                height: 30px !important;
            }
            .vertical-gap20{
                height: 20px !important;
            }
        </style>
        <?php $this->render('templates/header'); ?>
        <div class="container main-body-container">
            <div class="row">
                <div class="col-sm-12 col-lg-1 col-md-12"></div>
                <div class="col-sm-12 col-lg-10 col-md-12 table-responsive">
                    <h3 class="text-center">Inventories</h3>
                    <table id="example" class="table table-striped table-bordered " style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Manufacturer name</th>
                                <th>Car model name</th>
                                <th>Car registration number</th>
                                <th>Manufacturing year</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                        <script> var data =<?php echo json_encode($this->inventory); ?></script>
                        <?php
                        $i = 1;
                        foreach ($this->inventory as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['manufacturer_name']; ?></td>
                                <td><?php echo $value['car_model_name']; ?></td>
                                <td><?php echo $value['car_regis_number']; ?></td>
                                <td><?php echo $value['manufacturing_year']; ?></td>
                                <td><button class="btn btn-info" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value['car_model_id']; ?>" data-records=<?php echo json_encode($value); ?> id="fullDetails">View Details</button></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </table>
                </div>
                <div class="col-sm-12 col-lg-1 col-md-12"></div>
            </div>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <style>
                        .table>tbody>tr>th{
                            width: 40% !important;
                        }
                    </style>
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Inventory Details</h4>
                            <div id="alert"></div>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">          
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Manufacturer name</th> <td id="manuf_name"></td>
                                        </tr>
                                        <tr>
                                            <th>Car color</th>  <td id="car_model_name"></td>
                                        </tr>
                                        <tr>
                                            <th>Car registration number</th> <td id="car_reg_num"></td>
                                        </tr> <tr>
                                            <th>Manufacturing year</th><td id="manuf_year"></td>
                                        </tr>
                                        <tr>
                                            <th>Car color</th> <td id="car_col"></td>
                                        </tr>
                                        <tr>
                                            <th>Car note</th> <td id="car_note"></td>
                                        </tr>
                                        <tr>
                                            <th>Uploaded Images</th><td id="images">
                                                <img src="" id="images1" style="height:100px"/>
                                                <img src="" id="images2" style="height:100px"/>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteInv">
                                <input id="car_model_id" name="car_model_id" value="" type="hidden" />
                                  <button type="button" class="btn btn-warning" id="delete_carmodel">Sold</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                             
                          
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="vertical-gap30"></div>
        <?php $this->render('templates/footer'); ?>
    </body>
</html>



<script>
                            $(document).ready(function () {
                                var fulldata = '';
                                $('button#fullDetails').click(function () {
                                    var id = $(this).attr('data-id');
                                    $.each(data, function (index, value) {
                                        if (id == value.car_model_id) {
                                            fulldata = value;
                                        }
                                    });
                                    //console.log(JSON.stringify(fulldata));
                                    $('#manuf_name').html(fulldata.manufacturer_name);
                                    $('#car_model_name').html(fulldata.car_model_name);
                                    $('#car_reg_num').html(fulldata.car_regis_number);
                                    $('#manuf_year').html(fulldata.manufacturing_year);
                                    $('#car_col').html(fulldata.car_color);
                                    $('#images1').attr('src', base_url() + '/'+fulldata.images[0]);
                                    $('#images2').attr('src', base_url() +  '/'+fulldata.images[1]);
                                    $('#car_note').html(fulldata.car_note);
                                     $('#car_model_id').val(fulldata.car_model_id);
                                });
                               
                               var res=ajaxHttpRequest('click', 'button#delete_carmodel', '/carmodel/delCarModel');
                               console.log(res);
                              /// setTimeout("window.location.href='viewinventory';",5000);
                              
                            });
</script>
