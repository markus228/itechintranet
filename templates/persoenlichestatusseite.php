<?php
/**
 * @var \view\PersoenlicheStatusseiteView $this
 */
?>

<div class="row">

    <div class="panel panel-primary">
        <div class="panel-heading">Persönliche Daten</div>
        <div class="panel-body">

            <div class ="row">

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Name</div>
                        <div class="panel-body">
                            <?=$this->getUser()->getVorname()?><br>
                            <?=$this->getUser()->getNachname()?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Anschrift</div>
                        <div class="panel-body">
                            <address>
                                Kaiserstraße 1<br>
                                12345 Musterstadt
                            </address>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Telefon</div>
                        <div class="panel-body">
                            <address>
                                Geschäftlich: 2539<br>
                                Privat: 0000000000<br>
                                Mobil:  0000000000
                            </address>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <button type="button" class="btn btn-success">
                        <span class="fa fa-edit"></span>
                        Bearbeiten
                    </button>
                </div>

            </div>

        </div>

    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">EMail-Konto</div>
        <div class="panel-body">

            <div class="row">

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">EMail-Adressen</div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">abc@sample.com</li>
                                <li class="list-group-item">acyz@sample.com</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Auto-Responder</div>
                        <div class="panel-body">
                            <span class="label label-danger">inaktiv</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6"></div>

            </div>

        </div>

    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">Windows AD-Konto</div>
        <div class="panel-body">

            <div class="row">

                <div class="col-lg-2">
                    <h4>Zugeh. Gruppen</h4>
                </div>

                <div class="col-lg-2">
                    <h4>Letzter Login</h4>
                </div>

            </div>

        </div>

    </div>

</div>

