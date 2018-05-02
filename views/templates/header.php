
<nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Car Inventory System</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="<?php echo activeLink('manufacturer'); ?>"><a href="<?php echo _BASE_URL_; ?>manufacturer">Add manufacturer</a></li>
                    <li class="<?php echo activeLink('carmodel'); ?>"><a href="<?php echo _BASE_URL_; ?>carmodel">Add car model</a></li>
                    <li class="<?php echo activeLink('viewinventory'); ?>"><a href="<?php echo _BASE_URL_; ?>viewinventory">View Inventories</a></li>
                </ul>
            </div>
        </nav>
