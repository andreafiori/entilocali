<?php

namespace Admin\Model\Posts;

/**
 * Container with Posts status
 * 
 * @author Andrea Fiori
 * @since  28 May 2014
 */
class PostsUtils
{
    const STATE_ACTIVE = 'attivo';
    
    const STATE_PENDING = 'sospeso';
    
    /**
     * @param type $tipo
     */
    public static function getModuleIdFromTipo($tipo)
    {
        $mapType = array(
            'blog'    => 1,
            'content' => 4,
            'foto'    => 6,
        );
        
        if (isset($mapType[$tipo])) {
            return $mapType[$tipo];
        }
    }
}