<?php

/**
 * Flash object helper - embeds Flash objects (files with the .swf extension)
 * 
 * Uses SWFObject
 * 
 * @param string $id - The ID of the div which will be replaced by flash movie
 * @param mixed  $options - Flash object options 
 * @see http://blog.deconcept.com/swfobject/
 *
 */

function flash_object( $id, array $options = array() )
{
    sfContext::getInstance()->getResponse()->addJavascript( sfConfig::get( 'app_sfswfobjecthelperplugin_web_dir', '' ) . '/js/swfobject' );

    use_helper( 'Javascript' );

    $options = _parse_attributes( $options );

    $absolute = false;
    if ( isset( $options[ 'absolute' ] ) )
    {
        unset( $options[ 'absolute' ] );
        $absolute = true;
    }

    if ( isset( $options[ 'size' ] ) )
    {
        list( $options[ 'width' ], $options[ 'height' ] ) = split( 'x', $options[ 'size' ], 2 );
        unset( $options[ 'size' ] );
    }

    if ( !isset( $options[ 'version' ] ) )
    {
        $options[ 'version' ] = '7';
    }

    // create various arrays defining all permitted parameters
    $constructor_required_parameters = array( 'movie', 'id', 'width', 'height', 'version', 'background_color' );
    $constructor_optional_parameters = array( 'use_express_install', 'quality', 'express_install_redirect_url', 'redirect_url', 'detect_key' );
    $constructor_parameters = array_merge( $constructor_required_parameters, $constructor_optional_parameters );
    $variable_parameters = array( 'params' => 'addParam', 'variables' => 'addVariable' );
    $additional_parameters = array( 'create_proxy' );
    $all_parameters = array_merge( $constructor_parameters, array_keys( $variable_parameters ), $additional_parameters );

    // check for unknown parameters
    $unknown_parameters = array_diff( array_keys( $options ), $all_parameters );

    if ( count( $unknown_parameters ) > 0 )
    {
        $unknown_parameter = array_shift( $unknown_parameters );
        throw new sfException( "{SWFObjectHelper} Unknown parameter \"{$unknown_parameter}\"." );
    }

    // check for required parameters
    $missing_required_parameters = array_diff( $constructor_required_parameters, array_keys( $options ) );

    if ( count( $missing_required_parameters ) > 0 )
    {
        $missing_required_parameter = array_shift( $missing_required_parameters );
        throw new sfException( "{SWFObjectHelper} Required parameter \"{$missing_required_parameter}\" is missing." );
    }

    // ensure $id does not equal $options[ 'id' ]
    if ( $id == $options[ 'id' ] )
    {
        throw new sfException( "{SWFObjectHelper} \$id cannot be the same value as \$options[ 'id' ]." );
    }

    // calculate path to flash movie
    $options[ 'movie' ] = flash_path( $options[ 'movie' ], $absolute );

    // calculate constructor variables
    $constructor_elements = array();
    foreach ( $constructor_required_parameters as $constructor_parameter )
    {
        $constructor_elements[ $constructor_parameter ] = _flash_convert_value( $options[ $constructor_parameter ] );
    }
    foreach ( $constructor_optional_parameters as $constructor_parameter )
    {
        if ( array_key_exists( $constructor_parameter, $options ) &&
             $options[ $constructor_parameter ] != '' )
        {
            $constructor_elements[ $constructor_parameter ] = _flash_convert_value( $options[ $constructor_parameter ] );
        }
    }
    $constructor = implode( ', ', $constructor_elements );

    $javascript = 'var so = new SWFObject(' . $constructor . ');' . "\n";

    // handle proxy creation
    if ( array_key_exists( 'create_proxy', $options ) &&
         (boolean) $options[ 'create_proxy' ] === true )
    {
        sfContext::getInstance()->getResponse()->addJavascript( sfConfig::get( 'app_sfswfobjecthelperplugin_web_dir', '' ) . '/js/JavaScriptFlashGateway' );

        $options[ 'variables' ][ 'lcId' ] = '_' . $options[ 'id' ] . '_uid';

        $proxy_flash_path = flash_path( sfConfig::get( 'app_sfswfobjecthelperplugin_web_dir', '' ) . '/swf/JavaScriptFlashGateway', false );

        $proxy_javascript = <<<EOT
var {$options[ 'id' ]}_uid = new Date().getTime();

var {$options[ 'id' ]}_Proxy = new FlashProxy({$options[ 'id' ]}_uid, '{$proxy_flash_path}');


EOT;

        $javascript = $proxy_javascript . $javascript;
    }

    // add params and variables
    foreach ( $variable_parameters as $type => $method )
    {
        if ( array_key_exists( $type, $options ) &&
             is_array( $options[ $type ] ) &&
             count( $options[ $type ] ) > 0 )
        {
            $additional_javascript = '';

            foreach( $options[ $type ] as $param => $value )
            {
                if ( $value != '' )
                {
                    $additional_javascript .= "so.{$method}('{$param}', " . _flash_convert_value( $value ) . ");\n";
                }
            }

            if ( $additional_javascript != '' )
            {
                $javascript .= "\n" . $additional_javascript;
            }
        }
    }

    // tell SWFObject to write out necessary tags.
    $javascript .= "\nso.write('{$id}');";

    return content_tag( 'div', 'This text is replaced by the Flash movie.', array( 'id' => $id ) ) . "\n\n" . javascript_tag( $javascript );
}

/**
 * Returns the path to a flash swf movie.
 *
 * <b>Example:</b>
 * <code>
 *  echo flash_path('mymovie');
 *    => /swf/mymovie.swf
 * </code>
 *
 * <b>Note:</b> The asset name can be supplied as a...
 * - full path, like "/swf/movie.swf"
 * - file name, like "movie.swf", that gets expanded to "/swf/movie.swf"
 * - file name without extension, like "movie", that gets expanded to "/swf/movie.swf"
 *
 * @param  string asset name
 * @param  bool return absolute path ?
 * @return string file path to the flash movie file
 *
 */
function flash_path( $source, $absolute = false )
{
    return _compute_public_path( $source, 'swf', 'swf', $absolute );
}

/**
 * Perform necessary conversions on data before constructing javascript
 *
 * @param  string value
 * @return string converted value
 *
 */
function _flash_convert_value( $value )
{
    switch ( true )
    {
        case is_null( $value ):
        {
            // Convert the string value '_null' to a javascript null rather than converting it to a string
            $value = 'null';

            break;
        }

        
        case substr( $value, 0, 1 ) == '_':
        {
            // Values prefixed with an '_' are considered to be javascript variables
            $value = substr( $value, 1 );

            break;
        }

        default:
        {
            $value = "'" . $value . "'";

            break;
        }
    }

    return $value;
}

?>
