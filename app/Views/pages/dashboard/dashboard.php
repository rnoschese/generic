<div id="main-content">
    <div class="container">
        <div class="row">
            <div id="content" class="col-lg-12">
                <!-- PAGE HEADER-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <!-- STYLER -->

                            <!-- /STYLER -->
                            <!-- BREADCRUMBS -->
                            <ul class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i>
                                    <a href="/dashboard">Home</a>
                                </li>
                                <?php if (!empty($breadcrumb)) {
                                    foreach ($breadcrumb as $bread):?>
                                        <li><?= $bread ?></li>
                                    <?php endforeach;
                                } ?>
                            </ul>
                            <!-- /BREADCRUMBS -->
                            <div class="clearfix">
                                <h3 class="content-title pull-left"><?= $title ?></h3>
                            </div>
                            <div class="description"><?= $description ?></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        $data = array(
                                'indirizzi' =>
                                array(
                                        'indirizzo_abitazione' =>
                                        array(
                                            'tipo' => 'Abitazione',
                                            'default' => true,
                                            'indirizzo_completo' => 'xxx',
                                            'via' => 'xxx',
                                            'civico' => 'xxx',
                                            'comune' => 'xxx',
                                            'cap' => 'xxx',
                                            'provincia' => 'xxx',
                                            'regione' => 'xxx',
                                        )
                                )
                        )

                        ?>
                    </div>
                </div>
                <!-- /PAGE HEADER -->
            </div><!-- /CONTENT-->
        </div>
    </div>
</div>