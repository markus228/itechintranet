<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 28.12.15
 * Time: 17:02
 */

namespace userdb;


class User
{
    private $id;
    private $username;
    private $vorname;
    private $nachname;
    private $anschrift;
    private $telefonDurchwahl;
    private $telefonPrivat;
    private $telefonMobil;

    /**
     * User constructor.
     * @param $vorname
     * @param $telefonMobil
     * @param $telefonPrivat
     * @param $telefonDurchwahl
     * @param $anschrift
     * @param $nachname
     */
    public function __construct($id, $username, $vorname, $nachname, $anschrift, $telefonDurchwahl,  $telefonPrivat, $telefonMobil)
    {
        $this->id = $id;
        $this->username = $username;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->telefonMobil = $telefonMobil;
        $this->telefonPrivat = $telefonPrivat;
        $this->telefonDurchwahl = $telefonDurchwahl;
        $this->anschrift = $anschrift;
        $this->nachname = $nachname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * @param mixed $vorname
     * @return User
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefonMobil()
    {
        return $this->telefonMobil;
    }

    /**
     * @param mixed $telefonMobil
     * @return User
     */
    public function setTelefonMobil($telefonMobil)
    {
        $this->telefonMobil = $telefonMobil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefonPrivat()
    {
        return $this->telefonPrivat;
    }

    /**
     * @param mixed $telefonPrivat
     * @return User
     */
    public function setTelefonPrivat($telefonPrivat)
    {
        $this->telefonPrivat = $telefonPrivat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefonDurchwahl()
    {
        return $this->telefonDurchwahl;
    }

    /**
     * @param mixed $telefonDurchwahl
     * @return User
     */
    public function setTelefonDurchwahl($telefonDurchwahl)
    {
        $this->telefonDurchwahl = $telefonDurchwahl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnschrift()
    {
        return $this->anschrift;
    }

    /**
     * @param mixed $anschrift
     * @return User
     */
    public function setAnschrift($anschrift)
    {
        $this->anschrift = $anschrift;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * @param mixed $nachname
     * @return User
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;
        return $this;
    }





}