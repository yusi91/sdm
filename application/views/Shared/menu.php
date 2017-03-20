<!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <li class="nav-item start" id="Home">
                    <a href="<?php echo base_url()?>Home" class="nav-link nav-toggle" >
                        <i class="icon-home"></i>
                        <span class="title" >Home</span>
                        <span class='selected' id="Home_selected" hidden="true"></span>
                        <span></span>
                    </a>
                </li>
                <li class="heading">
                    <h3 class="uppercase">Fitur</h3>
                </li>
                <li class="nav-item  " id="Dashboard">
                    <a href="javascript:;" class="nav-link nav-toggle" >
                        <i class="icon-bar-chart"></i>
                        <span class="title">Dashboard</span>
                        <span class='selected' id="Dashboard_selected" hidden="true"></span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item" id="Realisasi_Target">
                            <a href="<?php echo base_url()?>Dashboard/Index?db=Realisasi_Target" class="nav-link " >
                                <span class="title">Realisasi & Target</span>
                            </a>
                        </li>
                        <li class="nav-item" id="Realisasi_Per_Site">
                            <a href="<?php echo base_url()?>Dashboard/Index?db=Realisasi_Per_Site" class="nav-link " >
                                <span class="title">Realisasi Per Site</span>
                            </a>
                        </li>
                        <li class="nav-item" id="Realisasi_Per_Jenis_Semen">
                            <a href="<?php echo base_url()?>Dashboard/Index?db=Realisasi_Per_Jenis_Semen" class="nav-link " >
                                <span class="title">Realisasi Per Jenis Semen</span>
                            </a>
                        </li>
                        <li class="nav-item" id="Peta_Pasar">
                            <a href="<?php echo base_url()?>Dashboard/Index?db=Peta_Pasar" class="nav-link " >
                                <span class="title">Peta Pasar</span>
                            </a>
                        </li>
                    </ul>                             
                </li>
                <li class="nav-item  " id="Data">
                    <a href="javascript:;" class="nav-link nav-toggle" >
                        <i class="fa fa-sticky-note-o"></i>
                        <span class="title">Data</span>
                        <span class='selected' id="Data_selected" hidden="true"></span>
                        <span class="arrow"></span>
                    </a>

                    <ul class="sub-menu">
                        <li class="nav-item" id="Saldo">
                            <a href="<?php echo base_url()?>Saldo" class="nav-link " >
                                <span class="title">Saldo</span>
                            </a>
                        </li>
                        <li class="nav-item" id="PembayaranFaktur">
                            <a href="<?php echo base_url()?>PembayaranFaktur" class="nav-link " >
                                <span class="title">Pembayaran Faktur</span>
                            </a>
                        </li>
                        <li class="nav-item" id="Faktur">
                            <a href="<?php echo base_url()?>Faktur" class="nav-link " >
                                <span class="title">Faktur</span>
                            </a>
                        </li>
                        <li class="nav-item" id="Setoran">
                            <a href="<?php echo base_url()?>Setoran" class="nav-link " >
                                <span class="title">Setoran</span>
                            </a>
                        </li> 
                        <li class="nav-item" id="Order">
                            <a href="<?php echo base_url()?>Order" class="nav-link " >
                                <span class="title">Order</span>
                            </a>
                        </li>  
                    </ul>                  
                </li>

                <?php 
                    if(strtoupper($_SESSION["userinfo"]["level_jabatan"]) == "0"){
                        ?>          
                            <li class="nav-item  " id="Admin">
                                <a href="javascript:;" class="nav-link nav-toggle" >
                                    <i class="fa fa-eye"></i>
                                    <span class="title">Admin</span>
                                    <span class='selected' id="Data_selected" hidden="true"></span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item" id="User">
                                        <a href="<?php echo base_url()?>User" class="nav-link " >
                                            <span class="title">User</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" id="UserRating">
                                        <a href="<?php echo base_url()?>UserLog/UserRating" class="nav-link " >
                                            <span class="title">User Rating</span>
                                        </a>
                                    </li>
                                </ul>                  
                            </li>
                        <?php
                    }
                ?>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->