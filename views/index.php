<!DOCTYPE html>

<html lang="en">
    <?php $this->render('templates/head'); ?>
    <body>
        <?php $this->render('templates/header'); ?>
        <div class="container main-body-container">
            <div class="row text-center">
                <div class="col-sm-2 col-lg-4 col-md-2"></div>
                <div class="col-sm-8 col-lg-4 col-md-8">
                    <h3>Add Manufacturer.</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading" id="alert"></div>
                        <div class="panel-body">
                            <form  name="addManufacturerForm" id="addManufacturerForm">
                                <div class="form-group">
                                    <div class="control-group form-group">
                                        <div class="controls">
                                            <input type="text"  maxlength="40" class="form-control" id="manufacturer_name" name="manufacturer_name" placeholder="Enter manufacturer name..">
                                            <input type="hidden" value="1" name="addmanuf"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default btn-block btn-primary"  id="addmanuf">Add manufacturer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-lg-4 col-md-2"></div>
            </div>
        </div>
        <?php $this->render('templates/footer'); ?>
    </body>
</html>
<script>
    $(document).ready(function () {
        ajaxHttpRequest('click', 'button#addmanuf', '/manufacturer/addManufacturer');
    });
</script>
