<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 4:33 PM
 */

namespace Service\Request;

/**
 * Class AddRequest
 * @package Service\Request
 */
class AddRequest
{
    /**
     *
     *
    {"Id":"V0tMRjZGQlNEbXA5ZW1zMVo=","Cpuinfo":"TDIuMA==","Load":"MA==",
     * "Freemen":"MA==","Freecipan":"OTk0",
     * "Freeswap":"MA==","Idcpu":"MA==","Tvar_free":"MEUrMDA=",
     * "Rvar_free":"MA==","Build_num":"70"}
     */

    public $Id;
    public $Cpuinfo = "TDIuMA==";
    public $Load = "MA==";
    public $Freemen = "MA==";
    public $Freecipan = 3988689;
    public $Freeswap = "MA==";
    public $Idcpu = "MA==";
    public $Tvar_free;
    public $Rvar_free = "MA==";
    public $Build_num="70";

}