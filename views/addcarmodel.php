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
                <div class="col-sm-12 col-lg-3 col-md-2"></div>
                <div class="col-sm-12 col-lg-6 col-md-8">
                    <h3 class="text-center">Add car model.</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="alert"></div>
                        <div class="panel-body">
                            <form  name="addCarModelForm" id="addCarModelForm" enctype="multipart/form-data">
                                <div class="form-group"> 
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="car_model_name" name="car_model_name" placeholder="Enter model name.."  maxlength="50"  required="">
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <select class="form-control" id="manufacturer_name" name="manufacturer_name" required="">
                                                        <option value="">Select manufacturer</option>
                                                        <?php foreach ($this->allManufact as $manufacturer) { ?>
                                                            <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['manufacturer_name']; ?></option>
                                                        <?php } ?>
                                                    </select>   
                                                </div>
                                            </div>

                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <input type="text" class="form-control" id="car_color" name="car_color" placeholder="Enter car color.." maxlength="50" required="">

                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <select class="form-control" id="manufacturing_year" name="manufacturing_year" required="">
                                                        <option value="">Select manufacturing year</option>
                                                        <?php for ($i = date('Y'); $i >= 1900; $i--) { ?>
                                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <input required="" type="text" class="form-control" style='text-transform:uppercase' maxlength="15" id="car_registration_number" name="car_registration_number" placeholder="Enter car registration number..">

                                                </div>
                                            </div>

                                        </div> 
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <textarea  rows="6" class="form-control" id="note" name="note" placeholder="Add a note.." maxlength="500" ></textarea>

                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="vertical-gap20"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="control-group form-group">
                                                <div class="controls">
                                                    <label >Upload car images</label>
                                                    <input type="file" id="car_imgs" multiple="" accept=".png,.jpg,.jpeg" name="car_imgs[]">

                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default btn-block btn-primary"  id="addcmodel">Add car model</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3 col-md-2"></div>
            </div>
        </div>
        <div class="vertical-gap30"></div>
        <?php $this->render('templates/footer'); ?>
    </body>
</html>
<script>
    $(document).ready(function () {
        ajaxHttpRequest('click', 'button#addcmodel', '/carmodel/addCarModel');
    });
</script>
