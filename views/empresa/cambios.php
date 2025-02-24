<?php

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
?>
<?= $this->render('banners/fijo', ['titulo' => 'DEVOLUCIÓN & CAMBIOS']) ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 top-spacing3">
            <h3 class="text-ailerol34">DEVOLUCIÓN & CAMBIOS</h3><br>
            <p class="text-aileronr16">¿Deseas cambiar de talle, color o modelo?</p><br>
            <p class="text-aileronr16">Solicitalo</p>
        </div>
        <div class="col-md-12 top-spacing4">
            <p class="text-ailerol1315 text-gray2">En Priamo Italy es posible hacerlo de manera facil, simplemente te
                pones en contacto con nosotros al email ecommerce@priamoitaly.com informandonos el numero de tu orden de
                pedido y el nuevo talle, color o modelo por el cual deseas cambiar o el inconveniente que hayas tenido.
                Si no esta disponible en stock y es de linea nacional te lo podemos fabricar y tendra una espera de 10 a
                15 dias habiles. NO APLICA PARA OFERTAS DE OUTLET NI LINEA IMPORTADA.</p><br>
            <p class="text-ailerol1315 text-gray2">Cuando el nuevo talle, modelo o color este listo, deberas previamente
                enviar el producto de cambio asi podremos posterior a esto enviar el pedido de cambio. Podrás devolver
                el producto por cambio de talle o modelo enviándolo por la empresa de Correo de tu eleccion Correo
                Argentino, Andreani, OCA o empresas transportadoras que entreguen en domicilio no retiramos en
                sucursales ni en terminales de omnibus. Nuestra dirección es Salta 263 - Capital Federal-Buenos Aires-
                Argentina C1074AAE. El calzado debe ser devuelto en las mismas condiciones con la caja original para ser
                efectiva el cambio o la devolución.</p><br><br>
            <p class="text-ailerol1315 text-gray2">Tiempo establecido para solicitud de cambios 30 dias calendario
                unicamente, contados desde el dia de recepcion de su pedido inicial.</p><br>
            <p class="text-ailerol1315 text-gray2">Recuerda que también puedes hacer cambios en cualquiera de nuestras
                tiendas <a href="http://www.priamoitaly.com/tiendas.html" target="_blank" class="text-enlace3"><u>http://www.priamoitaly.com/tiendas.html</u></a>
            </p><br><br>
            <p class="text-ailerol13 text-black"><b>Nuestros productos cuentan con Garantía de Fábrica 180 Días.</b></p>
            <br>
        </div>
    </div>
    <div class="row"><br><br><br></div>
</div>