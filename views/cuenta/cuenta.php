
        <div class="row top-spacing4 bottom-spacing3 navto">
            <div class="col-sm-4">
                <?= $this->render('menu') ?>
            </div>
            <div class="col-sm-8 pad50">

                <?php
                if (isset($render)) {
                    switch ($render) {
                        case 'datos':
                            echo $this->render('datos', ['model' => $model]);
                            break;
                        case 'deseos':
                            $this->render('deseos');
                            break;
                        case 'historial':
                            echo $this->render('historial', ['model' => $model]);
                            break;
                    }
                }
                ?>
                </div>
            </div>
        </div>
