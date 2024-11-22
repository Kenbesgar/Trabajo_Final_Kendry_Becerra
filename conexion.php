<?php
/*
    private $con;
    private $dbequipo = 'localhost';
    private $dbusuario = 'root';
    private $dbclave = '';
    private $dbnombre = 'reservasb192';

    */

    private $con;
    private $dbequipo = 'sql104.infinityfree.com';
    private $dbusuario = 'if0_37540439';
    private $dbclave = '4NfiRCmcrnvaPs';
    private $dbnombre = 'if0_37540439_venta_ropa';

    // Constructor
    public function __construct() {
        $this->conectar();
    }

    // Método para conectarse a la base de datos
    public function conectar() {
        $this->con = mysqli_connect($this->dbequipo, $this->dbusuario, $this->dbclave, $this->dbnombre);

        if (!$this->con) {
            die("Error: No se pudo conectar a la base de datos: " . mysqli_connect_error());
        }
    }
?>
