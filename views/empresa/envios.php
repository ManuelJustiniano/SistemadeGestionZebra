<?php

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
?>
<?= $this->render('banners/fijo', ['titulo' => 'Envios']) ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 top-spacing4">
            <h3 class="text-ailerol34">ENVIOS</h3><br><br>
            <p class="text-ailerol13 text-gray2 text-justify">
                Escoge el servicio que más se adecue a tus necesidades, envía tu paquete, haz su seguimiento y ahorra
                dinero!
            </p><br>
            <ul id="lista4">
                <li><span class="text-ailerol13 text-gray2">Con Packlink dispondrás de las más reconocidas empresas de mensajería para hacer envíos de paquetes al mejor precio.</span><br><br><br>
                </li>
                <li><span class="text-ailerol13 text-gray2">Packlink es un comparador de envíos de mensajería que compara precios entre más de 300 servicios de paquetería tanto para envíos en España como en el extranjero.</span><br><br><br>
                </li>
                <li><span class="text-ailerol13 text-gray2">Gracias al volumen de envíos que manejamos, somos capaces de ofrecer servicios de mensajería urgente con descuentos de hasta 50% en envíos nacionales y 70% en envíos internacionales.</span><br><br><br>
                </li>
                <li><span class="text-ailerol1315 text-gray2 text-justify">Para enviar paquetes a través de nuestro comparador de envíos tan sólo tienes que introducir las medidas y peso del paquete en nuestro buscador, así como el código postal de origen y de destino del paquete. En seguida te enseñaremos todos             	          los servicios de mensajería que tenemos disponibles para tu envío con el detalle de precio y tiempos de entrega para que puedas contratar el que mejor se adapte a tus necesidades, y siempre, al mejor precio.</span><br><br><br>
                </li>
                <li><span class="text-ailerol1315 text-gray2 text-justify">En Packlink trabajamos con las empresas de paquetería más reconocidas del mercado como Correos, Correos Express, SEUR, UPS, TNT y Envialia, entre otras. Todos nuestros transportistas son de confianza y disponen de servicios eficientes y 	         fiables. La mayoría de los servicios de transporte que ofrecemos son puerta a puerta, lo que quiere decir que el transportista recogerá tus paquetes en la dirección que nos indiques y los entregará en el destino que tú elijas. Sin embargo, si te es  	         más cómodo dejar tus paquetes en un punto de recogida o que el destinatario los recoja en otro punto, disponemos también de servicios de drop-off (punto de entrega) y pick-up (punto de recogida) que normalmente suelen ser incluso más económicos.</span><br><br><br>
                </li>
            </ul>
            <p class="text-ailerol1315 text-gray2">
                <span class="text-aileronr16 text-black">Nota Importante:</span><br><br><br><br>Contratar en nuestra web
                un envío de paquete barato es fácil y rápido y podrás hacerlo con total confianza. Recuerda solamente
                que es importante que el paquete esté correctamente embalado para asegurarnos de que llega a su destino
                en perfectas condiciones. Te sugerimos que leas nuestras preguntas frecuentes y nuestras recomendaciones
                de embalaje.
            </p>
        </div>
    </div>
    <div class="row"><br><br><br><br><br><br></div>
</div>