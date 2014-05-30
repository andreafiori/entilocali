<?php

namespace Admin\Model\Utenti;

use Zend\Form\Annotation;

/**
 * @author samsonasik
 * @since  13 May 2013
 * 
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Name("User")
 */
class UserFormAuthentication
{
    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Email o nome utente:"})
     * @Annotation\Attributes({"placeholder":"Email o nome utente"})
     */
    public $username;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Required({"required":"true" })
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Options({"label":"Password:"})
     * @Annotation\Attributes({"placeholder":"Password"})
     */
    public $password;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Options({"label":"Remember Me ?:"})
     */
    public $rememberme;
    
    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"value":"Submit"})
     */
    public $submit;
}