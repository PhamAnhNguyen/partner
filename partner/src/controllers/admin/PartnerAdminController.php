<?php

namespace Foostart\Partner\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Partner\Models\Partners;
/**
 * Validators
 */
use Foostart\Partner\Validators\PartnerAdminValidator;

class PartnerAdminController extends Controller {

    public $data_view = array();
    private $obj_partner = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_partner = new Partners();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {
        $params = $request->all();

        $list_partner = $this->obj_partner->get_partners($params);


        $this->data_view = array_merge($this->data_view, array(
            'partners' => $list_partner,
            'request' => $request,
            'params' => $params
        ));
        return view('partner::partner.admin.partner_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $partner = NULL;
        $partner_id = (int) $request->get('id');

        if (!empty($partner_id) && (is_int($partner_id))) {
            $partner = $this->obj_partner->find($partner_id);
        }

        $this->data_view = array_merge($this->data_view, array(
            'partner' => $partner,
            'request' => $request
        ));
        return view('partner::partner.admin.partner_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new PartnerAdminValidator();

        $input = $request->all();

        $partner_id = (int) $request->get('id');
        $partner = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($partner_id) && is_int($partner_id)) {

                $partner = $this->obj_partner->find($partner_id);
            }
        } else {
            if (!empty($partner_id) && is_int($partner_id)) {

                $partner = $this->obj_partner->find($partner_id);

                if (!empty($partner)) {

                    $input['partner_id'] = $partner_id;
                    $partner = $this->obj_partner->update_partner($input);

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_update_successfully'));
                    return Redirect::route("admin_partner.edit", ["id" => $partner->partner_id]);
                } else {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_update_unsuccessfully'));
                }
            } else {

                $partner = $this->obj_partner->add_partner($input);

                if (!empty($partner)) {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_add_successfully'));
                    return Redirect::route("admin_partner.edit", ["id" => $partner->partner_id]);
                } else {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'partner' => $partner,
            'request' => $request,
                ), $data);

        return view('partner::partner.admin.partner_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $partner = NULL;
        $partner_id = $request->get('id');

        if (!empty($partner_id)) {
            $partner = $this->obj_partner->find($partner_id);

            if (!empty($partner)) {
                //Message
                \Session::flash('message', trans('partner::partner_admin.message_delete_successfully'));

                $partner->delete();
            }
        } else {
            
        }

        $this->data_view = array_merge($this->data_view, array(
            'partner' => $partner,
        ));

        return Redirect::route("admin_partner");
    }

}
