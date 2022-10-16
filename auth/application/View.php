<?php
class View {
    private $_controlador;
    private $_js;
    private $_css;
    private $_jsAll;
    private $_cssPublic;

    public
    function __construct( Request $peticion ) {
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();
        $this->_css = array();
        $this->_jsAll = array();
        $this->_cssPublic = array();
    }

    public
    function renderizar( $vista, $item = false ) {


        $js = array();
        $css = array();
        $jsAll = array();
        $cssPublic = array();

        if ( count( $this->_js ) ) {
            $js = $this->_js;
        }
        if ( count( $this->_css ) ) {
            $css = $this->_css;
        }
        if ( count( $this->_jsAll ) ) {
            $jsAll = $this->_jsAll;
        }
        if ( count( $this->_cssPublic ) ) {
            $cssPublic = $this->_cssPublic;
        }
        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'js' => $js,
            'css' => $css,
            'jsAll' => $jsAll,
            'cssPublic' => $cssPublic
        );

        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

        if ( is_readable( $rutaView ) ) {
            if ( !$item ) {
                include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
                include_once $rutaView;
                include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
            } else
                include_once $rutaView;
        } else {
            throw new Exception( 'Error de vista' );
        }
    }

    public
    function setCssPublic( array $cssPublic ) {
        if ( is_array( $cssPublic ) && count( $cssPublic ) ) {
            for ( $i = 0; $i < count( $cssPublic ); $i++ ) {
                $this->_cssPublic[] = BASE_URL . 'public/' . $cssPublic[ $i ] . '.css';
            }
        } else {
            throw new Exception( 'Error al cargar archivo de Public' );
        }
    }
    public
    function setJs( array $js ) {
        if ( is_array( $js ) && count( $js ) ) {
            for ( $i = 0; $i < count( $js ); $i++ ) {
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[ $i ] . '.js';
            }
        } else {
            throw new Exception( 'Error de js' );
        }
    }
    public
    function setCss( array $css ) {
        if ( is_array( $css ) && count( $css ) ) {
            for ( $i = 0; $i < count( $css ); $i++ ) {
                $this->_css[] = BASE_URL . 'views/' . $this->_controlador . '/css/' . $css[ $i ] . '.css';
            }
        } else {
            throw new Exception( 'Error de js' );
        }
    }
    public
    function setJsAll( array $jsAll ) {
        if ( is_array( $jsAll ) && count( $jsAll ) ) {
            for ( $i = 0; $i < count( $jsAll ); $i++ ) {
                $this->_jsAll[] = BASE_URL . 'public/js/' . $jsAll[ $i ] . '.js';
            }
        } else {
            throw new Exception( 'Error de js' );
        }
    }

}
