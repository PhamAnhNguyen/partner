<?php namespace Foostart\Partner\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Partner\Models\PartnersCategories;
/**
 * Validators
 */
use Foostart\Partner\Validators\PartnerCategoryAdminValidator;

class PartnerCategoryAdminController extends Controller {

    public $data_view = array();

    private $obj_partner_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_partner_category = new PartnersCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_partner_category = $this->obj_partner_category->get_partners_categories($params);

        $this->data_view = array_merge($this->data_view, array(
            'partners_categories' => $list_partner_category,
            'request' => $request,
            'params' => $params
        ));
        return view('partner::partner_category.admin.partner_category_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $partner = NULL;
        $partner_id = (int) $request->get('id');
        

        if (!empty($partner_id) && (is_int($partner_id))) {
            $partner = $this->obj_partner_category->find($partner_id);

        }

        $this->data_view = array_merge($this->data_view, array(
            'partner' => $partner,
            'request' => $request
        ));
        return view('partner::partner_category.admin.partner_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new PartnerCategoryAdminValidator();

        $input = $request->all();

        $partner_id = (int) $request->get('id');

        $partner = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($partner_id) && is_int($partner_id)) {

                $partner = $this->obj_partner_category->find($partner_id);
            }

        } else {
            if (!empty($partner_id) && is_int($partner_id)) {

                $partner = $this->obj_partner_category->find($partner_id);

                if (!empty($partner)) {

                    $input['partner_category_id'] = $partner_id;
                    $partner = $this->obj_partner_category->update_partner($input);

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_update_successfully'));
                    return Redirect::route("admin_partner_category.edit", ["id" => $partner->partner_id]);
                } else {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_update_unsuccessfully'));
                }
            } else {

                $partner = $this->obj_partner_category->add_partner($input);

                if (!empty($partner)) {

                    //Message
                    \Session::flash('message', trans('partner::partner_admin.message_add_successfully'));
                    return Redirect::route("admin_partner_category.edit", ["id" => $partner->partner_id]);
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

        return view('partner::partner_category.admin.partner_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $partner = NULL;
        $partner_id = $request->get('id');

        if (!empty($partner_id)) {
            $partner = $this->obj_partner_category->find($partner_id);

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

        return Redirect::route("admin_partner_category");
    }

}