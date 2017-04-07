<?php namespace Foostart\Partner\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
/**
 * Validators
 */

class PartnerController extends Controller {

    public $data_view = array();

    private $obj_validator = NULL;

    public function __construct() {
    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash('message', trans('partner::partner.message_add_successfully'));
    }

}