<?php

$configuracion = \app\models\Configuracion::find()->one();
$this->render('../widgets/metatags', ['model' => $configuracion]);
?>
<?= $this->render('banners/fijo', ['titulo' => 'Formas de Pago']) ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 top-spacing4">
            <h3 class="text-ailerol34">FORMAS DE PAGO</h3><br><br>
            <p class="text-ailerol13 text-gray2 text-justify">
                Todos los precios llevan aplicado un descuento del 2,5% válido en forma de pago por transferencia,
                ingreso en cuenta y contrareembolso.
            </p><br>
            <ul id="lista4">
                <li><span class="text-aileronr16">Transferencias / Ingreso en cuenta:</span><br><br>
                    <p class="text-ailerol1315 text-gray text-justify">Si elige como forma de pago transferencia previa
                        (o ingreso en cuenta) se le proporcionarán nuestros números de cuenta para hacer el pago. Puede
                        realizar una transferencia bancaria desde su banco o caja habitual o, si lo prefiere, efectuar
                        un ingreso en cuenta en una sucursal. Una vez recibido el pago se enviará su pedido por
                        transporte urgente. Si transcurridos 7 días hábiles (sin contar fines de semana) no se ha
                        recibido el pago el pedido será cancelado. Esta forma de pago está disponible para España
                        (península y Baleares), Canarias, Ceuta y Melilla y destinos internacionales.</p>
                    <p class="text-ailerol13 text-gray"><span class="text-black">Nuestros números de cuenta para recibir pagos son:</span><br>
                        <span class="text-black">Titular: Maquillalia SL.</span><br>
                        <span class="text-black">Banco Santander:</span> ES66 0049 1769 2425 1000 7276<br>
                        <span class="text-black">Banco Sabadell:</span> ES83 0081 7447 3800 0140 5548<br>
                        <span class="text-black">Bankia:</span> ES59 2038 9775 2760 0038 8022<br>
                        <span class="text-black">Para pagos internacionales:</span> IBAN ES66 0049 1769 2425 1000 7276
                        SWIFT: BSCHESMMXXX
                    </p><br>
                </li>
                <li><span class="text-aileronr16">Contra Reembolso:</span><br><br>
                    <p class="text-ailerol1315 text-gray text-justify">En los envíos contra reembolso usted pagará su
                        pedido al mensajero (únicamente en metálico) en el momento de la entrega. La empresa de
                        transporte cobra una comisión del 3% + IVA con un mínimo de 3 Euros por pedido por realizar este
                        servicio. Esta forma de pago solamente está disponible para España (sólo en la península), para
                        los envios por MRW y CHRONOEXPRESS y es indispensable facilitar un número de teléfono de
                        contacto.</p><br>
                </li>
                <li><span class="text-aileronr16">Tarjeta de Crédito:</span><br><br>
                    <p class="text-ailerol1315 text-gray text-justify">Puede pagar con su tarjeta Visa, Visa Electron,
                        Maestro y Mastercard a través de la pasarela de pago seguro.</p><br>
                </li>
                <li><span class="text-aileronr16">Paypal:</span><br><br>
                    <p class="text-ailerol1315 text-gray text-justify">Puede realizar el pago mediante el metodo seguro
                        de pago Paypal.</p><br>
                </li>
            </ul>
            <p class="text-ailerol1315 text-gray">
                <span class="text-aileronr16 text-black">Importante:</span>&nbsp;&nbsp;Si el pedido, una vez confirmado
                y enviado, no es aceptado por el cliente éste deberá hacerse cargo de los gastos ocasionados. Recibirá
                una factura o justificante de compra por correo postal y/o correo electrónico. Todos los pedidos falsos,
                o intentos de fraude, serán denunciados ante las autoridades competentes. Se proporcionará toda la
                información necesaria para colaborar con la investigación.
            </p>
        </div>
    </div>
    <div class="row"><br><br><br><br><br><br></div>
</div>