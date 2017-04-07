<?php

namespace Foostart\Partner\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;
use Foostart\Partner\Models\Partners;
use Foostart\Partner\Validators\PartnerAdminValidator;

class PartnerFrontController extends Controller {

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

        $partners = $this->obj_partner->get_partners($params);


        $this->data_view = array_merge($this->data_view, array(
            'partners' => $partners,
            'request' => $request,
           
        ));

        return view('partner::partner.front.index', $this->data_view);
    }

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

        return Redirect::route("partner");
    }

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
        return view('partner::partner.front.edit', $this->data_view);
    }
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
                    return Redirect::route("partner", ["id" => $partner->partner_id]);
                } else {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_update_unsuccessfully'));
                }
            } else {

                $partner = $this->obj_partner->add_partner($input);

                if (!empty($partner)) {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_add_successfully'));
                    return Redirect::route("partner", ["id" => $partner->partner_id]);
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

        return view('partner::partner.front.index', $this->data_view);
    }
    
    public function add(Request $request) {
       // $partner = null;
        $partner = new Partners();
        $partner = $partner->get();
        $input = $request->all();
        
        
        $partner_id = $this->obj_partner->add_partner($input);
        $this->data_view = array(
            'partner' => $partner,
            'request' => $request
        );
        //Message
            
        return Redirect::route("partner");
    }

}
