<?php

use yii\helpers\Url;


$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
?>


<?= $this->render('banners/fijo', ['titulo' => 'Quienes Somos']) ?>



    <div class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="subtitle">QUIENES SOMOS</h2>
                    <p>

                        Somos una empresa dedicada a la importación de artículos de cotillón y juguetes, con un servicio de distribución  por mayor y por menor en varias ciudades del país, ofrecemos una bonita experiencia a la hora de organizar un evento

                    </p>
                    <BR>

                </div><!-- End .col-lg-7 -->


                <div class="col-lg-7">




                    <h3 class="subtitle">NUESTRA MISIÓN</h3>
                    <p>
                        Ser proveedores de accesorios de cotillón en todos los niveles, ofreciendo la mejor experiencia de compra y mejorando y modernizando constantemente nuestros servicios.


                    </p>



                    <h3 class="subtitle">NUESTRA VISIÓN</h3>
                    <p>

                        Somos una empresa moderna adecuada a las necesidades de nuestros clientes, brindamos un servicio amigable y de calidad, nos hacemos parte responsable de la celebraciones poniendo empeño máximo en la perfeccion de los detalles lo que nos hace especiales y preferidos en nuestro rubro.

                    </p>

                </div>
                <div class="col-lg-5">


                    <h2 class="subtitle">TESTIMONIOS DE CLIENTES</h2>

                    <?= $this->render('widgets/testimonios') ?>

                </div>


            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .about-section -->









